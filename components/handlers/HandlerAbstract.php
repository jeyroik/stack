<?php
namespace funcraft\stack\components\handlers;

use funcraft\stack\interfaces\handlers\IHandler;
use funcraft\stack\interfaces\records\IRecord;
use Monolog\Handler\AbstractHandler;

/**
 * Class HandlerAbstract
 * @package funcraft\stack\components\handlers
 */
abstract class HandlerAbstract extends AbstractHandler implements IHandler
{
    /**
     * @var IRecord
     */
    protected $record = null;
    protected $currentStackResult = null;

    /**
     * @param array $recordData
     * @param mixed $currentStackResult
     *
     * @return bool
     */
    public function handle(array $recordData, $currentStackResult = null): bool
    {
        $this->currentStackResult = $currentStackResult;

        $this->run();

        return false;
    }

    /**
     * @param array $record
     * @return bool
     */
    public function isHandling(array $record): bool
    {
        return true;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->currentStackResult;
    }

    /**
     * @param IRecord $record
     *
     * @return $this
     */
    public function setRecord(IRecord $record)
    {
        $this->record = $record;

        return $this;
    }

    /**
     * @return $this
     */
    abstract protected function run();
}
