<?php
namespace funcraft\stack\interfaces\handlers;

use funcraft\stack\interfaces\records\IRecord;
use Monolog\Handler\HandlerInterface;

/**
 * Interface IHandler
 * @package funcraft\stack\interfaces\handlers
 */
interface IHandler extends HandlerInterface
{
    /**
     * @param array $record
     * @param mixed $currentStackResult
     *
     * @return bool
     */
    public function handle(array $record, $currentStackResult = null): bool;

    /**
     * @return mixed
     */
    public function getResult();

    /**
     * @param IRecord $record
     *
     * @return $this
     */
    public function setRecord(IRecord $record);
}
