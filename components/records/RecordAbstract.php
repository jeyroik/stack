<?php
namespace funcraft\stack\components\records;

use funcraft\stack\components\ComponentArrayAccess;
use funcraft\stack\interfaces\records\IRecord;
use funcraft\stack\interfaces\stacks\IStack;

/**
 * Class RecordAbstract
 * @package funcraft\stack\components\records
 */
abstract class RecordAbstract extends ComponentArrayAccess implements IRecord
{
    const FIELD__LEVEL = 'level';
    const FIELD__MESSAGE = 'message';
    const FIELD__CONTEXT = 'context';

    protected $previousStackResult = null;
    protected $name = '';

    /**
     * RecordAbstract constructor.
     *
     * @param IStack $stack
     */
    public function __construct(IStack $stack)
    {
        $this->fetchStackData($stack);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $message
     *
     * @return RecordAbstract
     */
    public function setMessage(string $message)
    {
        $this->data[static::FIELD__MESSAGE] = $message;

        return $this;
    }

    /**
     * @param int $level
     *
     * @return RecordAbstract
     */
    public function setLevel(int $level)
    {
        $this->data[static::FIELD__LEVEL] = $level;

        return $this;
    }

    /**
     * @param array $context
     *
     * @return RecordAbstract
     */
    public function setContext(array $context)
    {
        $this->data[static::FIELD__CONTEXT] = $context;

        return $this;
    }

    /**
     * @param array $data
     *
     * @return RecordAbstract
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
      * @param mixed $offset
      * @throws \Exception
      */
     public function offsetUnset($offset)
     {
         throw new \Exception('Unset is restricted');
     }

     /**
      * @param IStack $stack
      *
      * @return RecordAbstract
      */
     protected function fetchStackData(IStack $stack)
     {
         $this->previousStackResult = $stack->getPreviousStackResult();

         return $this;
     }
}
