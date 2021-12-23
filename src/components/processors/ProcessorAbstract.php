<?php
namespace funcraft\stack\components\processors;

use funcraft\stack\interfaces\processors\IProcessor;
use funcraft\stack\interfaces\records\IRecord;

/**
 * Class ProcessorAbstract
 * @package funcraft\stack\components\processors
 */
abstract class ProcessorAbstract implements IProcessor
{
    /**
     * @var IRecord
     */
    protected $record = null;

    /**
     * @return $this
     */
    abstract protected function init();

    /**
     * @return $this
     */
    abstract protected function process();

    /**
     * @param IRecord $record
     *
     * @return IRecord
     */
    public function __invoke(IRecord $record): IRecord
    {
        $this->record = $record;

        $this->init()->process();

        return $this->record;
    }
}
