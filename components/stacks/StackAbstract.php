<?php
namespace funcraft\stack\components\stacks;

use funcraft\stack\interfaces\records\IRecord;
use funcraft\stack\interfaces\stacks\IStack;

use Monolog\Logger;

/**
 * Class StackAbstract
 * @package funcraft\stack\components\stacks
 */
class StackAbstract extends Logger implements IStack
{
    protected $name = '';

    /**
     * @var IRecord
     */
    protected $record = null;
    protected $formatters = [];
    protected $previousStackResult = null;
    protected $currentStackResult = null;

    /**
     * StackAbstract constructor.
     * @param null $previousStackResult
     * @param array $handlers
     * @param array $processors
     * @param array $formatters
     * @param array $records
     */
    public function __construct(
        $previousStackResult = null,
        array $handlers = [],
        array $processors = [],
        array $formatters = [],
        array $records = []
    )
    {
        $this->previousStackResult = $previousStackResult;
        $this->formatters = $formatters;

        foreach ($handlers as $index => $handlerClass) {
            $handlers[$index] = new $handlerClass($this);
        }

        foreach ($processors as $index => $processorClass) {
            $processors[$index] = new $processorClass($this);
        }

        parent::__construct($this->name, $handlers, $processors);

        $recordClass = array_shift($records);
        $this->record = new $recordClass($this);
    }

    /**
     * @return mixed
     */
    public function getPreviousStackResult()
    {
        return $this->previousStackResult;
    }

    /**
     * @param string $message
     * @param array $context
     *
     * @return mixed
     */
    public function run(string $message, array $context = [])
    {
        $this->addRecord(0, $message, $context);

        return $this->currentStackResult;
    }

    /**
     * Adds a log record.
     *
     * @param  int     $level   The logging level
     * @param  string  $message The log message
     * @param  array   $context The log context
     * @return Boolean Whether the record has been processed
     */
    public function addRecord($level, $message, array $context = []): bool
    {
        $this->record->setLevel($level)->setMessage($message)->setContext($context);

        // check if any handler will handle this message so we can return early and save cycles
        $handlerKey = null;
        foreach ($this->handlers as $key => $handler) {
            if ($handler->isHandling($this->record->getData())) {
                $handlerKey = $key;
                break;
            }
        }
        if (null === $handlerKey) {
            return false;
        }

        foreach ($this->processors as $processor) {
            $this->record = call_user_func($processor, $this->record);
        }
        // advance the array pointer to the first handler that will handle this record
        reset($this->handlers);
        while ($handlerKey !== key($this->handlers)) {
            next($this->handlers);
        }
        while ($handler = current($this->handlers)) {
            $handler->setRecord($this->record);
            if (true === $handler->handle($this->record->getData(), $this->currentStackResult)) {
                $this->currentStackResult = $handler->getResult();
                break;
            }
            $this->currentStackResult = $handler->getResult();
            next($this->handlers);
        }
        return true;
    }
}
