<?php
namespace funcraft\stack\components\collectors;

use funcraft\stack\interfaces\stacks\IStack;

/**
 * Class ResultCollectorByStackAlias
 * @package funcraft\stack\components\collectors
 * @author Funcraft <what4me@yandex.ru>
 */
class ResultCollectorByStackAlias extends ResultCollectorAbstract
{
    public function addResult(IStack $stack, $alias = '')
    {
        $this->results[$alias] = $stack->getCurrentStackResult();

        return $this;
    }
}
