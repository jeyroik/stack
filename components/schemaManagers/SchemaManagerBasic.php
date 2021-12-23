<?php
namespace funcraft\stack\components\schemaManagers;

use funcraft\stack\components\SchemaManagerAbstract;
use funcraft\stack\interfaces\stacks\IStack;

/**
 * Class SchemaManagerBasic
 * @package funcraft\stack\components\schemaManagers
 */
class SchemaManagerBasic extends SchemaManagerAbstract
{
    const CONFIG_FIELD__SCHEMA = 'schema';
    const CONFIG_FIELD__TYPE = 'type';
    const CONFIG_FIELD__KEY = 'key';
    const CONFIG_FIELD__CHILDREN = 'children';
    const CONFIG_FIELD__CLASS = 'class';
    const CONFIG_FIELD__PROCESSORS = 'processors';
    const CONFIG_FIELD__FORMATTERS = 'formatters';
    const CONFIG_FIELD__HANDLERS = 'handlers';
    const CONFIG_FIELD__RECORDS = 'records';

    const TYPE__CLASS = 'class';
    const TYPE__SCHEMA = 'schema';

    const SCHEMA_FIELD__STACKS = 'stacks';
    const SCHEMA_FIELD__PROCESSORS = 'processors';
    const SCHEMA_FIELD__FORMATTERS = 'formatters';
    const SCHEMA_FIELD__HANDLERS = 'handlers';
    const SCHEMA_FIELD__RECORDS = 'records';

    const ENV_FIELD__SCHEMA_LOCK_FILE_PATH = 'FUNCRAFT_STACK_SCHEMA_LOCK_FILE_PATH';

    protected $schema = [
        self::SCHEMA_FIELD__STACKS => [],
        self::SCHEMA_FIELD__FORMATTERS => [],
        self::SCHEMA_FIELD__HANDLERS => [],
        self::SCHEMA_FIELD__PROCESSORS => [],
        self::SCHEMA_FIELD__RECORDS => []
    ];

    /**
     * @return bool
     */
    public static function isSchemaExist(): bool
    {
        return is_file(self::getSchemaLockFilePath()) ? true : false;
    }

    /**
     * @return string
     */
    protected static function getSchemaLockFilePath()
    {
        return getenv(self::ENV_FIELD__SCHEMA_LOCK_FILE_PATH) ?: __DIR__ . '/../../schema.lock';
    }

    /**
     * @param string $message
     * @param array $context
     *
     * @return bool
     * @throws \Exception
     */
    public function apply($message = '', $context = []): bool
    {
        if (!self::isSchemaExist()) {
            $this->compileSchema(self::getSchemaLockFilePath());
        } else {
            $this->schema = json_decode(file_get_contents(self::getSchemaLockFilePath()), true);
        }

        $previousStackResult = null;

        foreach ($this->schema[static::SCHEMA_FIELD__STACKS] as $stackKey => $stackClass) {
            /**
             * @var IStack $stack
             */
            $stack = new $stackClass(
                $previousStackResult,
                $this->schema[static::SCHEMA_FIELD__HANDLERS][$stackKey],
                $this->schema[static::SCHEMA_FIELD__PROCESSORS][$stackKey],
                $this->schema[static::SCHEMA_FIELD__FORMATTERS][$stackKey],
                $this->schema[static::SCHEMA_FIELD__RECORDS][$stackKey]
            );
            $previousStackResult = $stack->run($message ?: 'init', $context);
        }

        return $previousStackResult ? true : false;
    }

    /**
     * @param string $schemaLockFilePath
     * @throws \Exception
     * @return bool
     */
    protected function compileSchema(string $schemaLockFilePath)
    {
        if (empty($this->config)) {
            throw new \Exception('Empty schema config');
        }

        if (isset($this->config[static::CONFIG_FIELD__SCHEMA])) {
            $schemaGlobalConfig = $this->config[static::CONFIG_FIELD__SCHEMA];
            $this->extractSchemaFromConfig($schemaGlobalConfig);
        } else {
            throw new \Exception('Missed "' . static::CONFIG_FIELD__SCHEMA . '" field in a schema config root');
        }

        file_put_contents($schemaLockFilePath, json_encode($this->schema));

        return true;
    }

    /**
     * @param array $schema
     *
     * @throws
     * @return bool
     *
     * schema => [
     *  [
     *      key => request
     *      type => class
     *      children => [
     *          [
     *              key => application
     *              type => schema
     *          ],
     *          [
     *              key => response
     *              type => class
     *          ]
     *      ]
     *  ]
     * ],
     *
     * request => [
     *  class => StackRequestREST::class,
     *  processors => [...],
     *  ...
     * ],
     * application => [
     *
     * ]
     */
    protected function extractSchemaFromConfig(array $schema)
    {
        if (empty($schema)) {
            return true;
        }

        if (!isset($schema[static::CONFIG_FIELD__KEY])) {
            $child = array_shift($schema);
        } else {
            $child = $schema;
        }


        $childKey = $child[static::CONFIG_FIELD__KEY];

        if (isset($this->config[$childKey])) {
            $childConfig = $this->config[$childKey];

            if ($child[static::CONFIG_FIELD__TYPE] == static::TYPE__CLASS) {
                $this->schema[static::SCHEMA_FIELD__STACKS][$childKey] = $childConfig[static::CONFIG_FIELD__CLASS];
                $this->schema[static::SCHEMA_FIELD__PROCESSORS][$childKey] = $childConfig[static::CONFIG_FIELD__PROCESSORS] ?? [];
                $this->schema[static::SCHEMA_FIELD__FORMATTERS][$childKey] = $childConfig[static::CONFIG_FIELD__FORMATTERS] ?? [];
                $this->schema[static::SCHEMA_FIELD__HANDLERS][$childKey] = $childConfig[static::CONFIG_FIELD__HANDLERS] ?? [];
                $this->schema[static::SCHEMA_FIELD__RECORDS][$childKey] = $childConfig[static::CONFIG_FIELD__RECORDS] ?? [];
            } elseif ($child[static::CONFIG_FIELD__TYPE] == static::TYPE__SCHEMA) {
                $this->extractSchemaFromConfig($childConfig);
            } else {
                throw new \Exception('Unknown schema node type: "' . $child[static::CONFIG_FIELD__TYPE] . '"');
            }

            if (isset($childConfig[static::CONFIG_FIELD__CHILDREN])) {
                $this->extractSchemaFromConfig($childConfig[static::CONFIG_FIELD__CHILDREN]);
            }
        } else {
            throw new \Exception('Missed "' . $childKey . '" key in a schema config root');
        }

        if (!isset($schema[static::CONFIG_FIELD__KEY])) {
            $this->extractSchemaFromConfig($schema);
        }

        return true;
    }
}
