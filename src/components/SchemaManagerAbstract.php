<?php
namespace funcraft\stack\components;

use funcraft\stack\interfaces\IResultCollector;
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
     * @var IResultCollector
     */
    protected $collector = null;

    /**
     * SchemaManagerAbstract constructor.
     *
     * @param string $name
     * @param array $config
     * @param IResultCollector $resultCollector
     */
    public function __construct(string $name, array $config, IResultCollector $resultCollector = null)
    {
        $this->config = $config;
        $this->name = $name;
        $this->collector = $resultCollector;
    }

    /**
     * @return IResultCollector
     */
    public function getCollector()
    {
        return $this->collector;
    }
}
