<?php
namespace funcraft\stack\components\handlers;

/**
 * Class HandlerEcho
 * @package funcraft\stack\components\handlers
 */
class HandlerEcho extends HandlerAbstract
{
    /**
     * @param array $record
     * @return bool
     */
    public function isHandling(array $record): bool
    {
        return true;
    }

    /**
     * @return HandlerEcho
     */
    protected function run(): self
    {
        echo 'Running handler ' . __CLASS__ . '...' . PHP_EOL;

        echo $this->record['echo'];

        $this->currentStackResult = 'Current result';

        return $this;
    }
}
