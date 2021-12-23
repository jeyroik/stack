<?php
namespace funcraft\stack\interfaces;

use funcraft\stack\interfaces\stacks\IStack;

/**
 * Interface IResultCollector
 * @package funcraft\stack\interfaces
 * @author Funcraft <what4me@yandex.ru>
 */
interface IResultCollector
{
    /**
     * IResultCollector constructor.
     * @param \ArrayAccess|array $config
     */
    public function __construct($config = null);

    /**
     * @param IStack $stack
     * @return $this
     */
    public function addResult(IStack $stack);

    /**
     * @return array
     */
    public function getResults();

    /**
     * @param mixed $mark
     * @return mixed
     */
    public function getResult($mark);
}
