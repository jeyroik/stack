<?php
namespace funcraft\stack\components\processors;

/**
 * Class ProcessorEcho
 * @package funcraft\stack\components\processors
 */
class ProcessorEcho extends ProcessorAbstract
{
    /**
     * @return $this
     */
    protected function init()
    {
        echo 'Init processor ' . __CLASS__ . '...' . PHP_EOL;

        return $this;
    }

    /**
     * @return $this
     */
    protected function process()
    {
        $this->record->setData(['echo' => 'Processing with ' . __CLASS__ . '...' . PHP_EOL]);

        return $this;
    }
}
