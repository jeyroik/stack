<?php
namespace funcraft\stack\components;

use funcraft\stack\interfaces\ISchemaManager;

/**
 * Class SchemaManagerAbstract
 * @package funcraft\stack\components
 */
abstract class SchemaManagerAbstract implements ISchemaManager
{
    protected $config = [];
    protected $name = '';
    protected $schema = [];

    /**
     * SchemaManagerAbstract constructor.
     *
     * @param string $name
     * @param array $config
     */
    public function __construct(string $name, array $config)
    {
        $this->config = $config;
        $this->name = $name;
    }
}
