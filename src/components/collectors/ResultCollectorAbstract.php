<?php
namespace funcraft\stack\components\collectors;

use funcraft\stack\interfaces\IResultCollector;
use funcraft\stack\interfaces\stacks\IStack;

/**
 * Class ResultCollectorAbstract
 * @package funcraft\stack\components
 * @author Funcraft <what4me@yandex.ru>
 */
class ResultCollectorAbstract implements IResultCollector
{
    protected $config = null;
    protected $results = [];

    /**
     * ResultCollectorAbstract constructor.
     * @param null $config
     */
    public function __construct($config = null)
    {
        $this->config = $config;

        $this->init();
    }

    /**
     * @return $this
     */
    protected function init()
    {
        return $this;
    }

    /**
     * @param IStack $stack
     * @return $this
     */
    public function addResult(IStack $stack)
    {
        $this->results[get_class($stack)] = $stack;

        return $this;
    }

    /**
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param mixed $mark
     * @return null|mixed
     */
    public function getResult($mark)
    {
        return $this->results[$mark] ?? null;
    }
}
