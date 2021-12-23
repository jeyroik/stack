<?php
namespace funcraft\stack\components\contexts;

use funcraft\stack\components\ComponentArrayAccess;
use funcraft\stack\components\errors\ErrorBasic;
use funcraft\stack\interfaces\contexts\IContext;
use funcraft\stack\interfaces\errors\IError;

/**
 * Class ContextAbstract
 * @package funcraft\stack\components\contexts
 */
abstract class ContextAbstract extends ComponentArrayAccess implements IContext
{
    /**
     * @var IError[]
     */
    protected $errors = [];

    /**
     * ContextAbstract constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param $message
     * @param array $arguments
     *
     * @return $this
     */
    protected function addError($message, $arguments = [])
    {
        $this->errors[] = new ErrorBasic($message, $arguments);

        return $this;
    }
}
