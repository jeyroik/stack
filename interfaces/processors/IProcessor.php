<?php
namespace funcraft\stack\interfaces\processors;

use funcraft\stack\interfaces\records\IRecord;

/**
 * Interface IProcessor
 * @package funcraft\stack\interfaces\processors
 */
interface IProcessor
{
    /**
     * @param IRecord $record
     *
     * @return IRecord
     */
    public function __invoke(IRecord $record): IRecord;
}
