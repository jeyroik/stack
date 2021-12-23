<?php
namespace funcraft\stack\interfaces;

/**
 * Interface ISchemaManager
 * @package funcraft\stack\interfaces
 */
interface ISchemaManager
{
    /**
     * ISchemaManager constructor.
     *
     * @param string $name
     * @param array $config
     * @param IResultCollector $resultCollector
     */
    public function __construct(string $name, array $config, IResultCollector $resultCollector = null);

    /**
     * @param string $message
     * @param array $context
     *
     * @return bool
     * @throws \Exception
     */
    public function apply($message = '', $context = []): bool;

    /**
     * @param string $schemaName
     * @return bool
     */
    public static function isSchemaExist($schemaName): bool;

    /**
     * @return IResultCollector
     */
    public function getCollector();
}
