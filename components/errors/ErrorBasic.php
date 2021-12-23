<?php
namespace funcraft\stack\components\errors;

use funcraft\stack\interfaces\errors\IError;

/**
 * Class ErrorBasic
 * @package funcraft\stack\components\errors
 */
class ErrorBasic extends \Exception implements IError
{
    /**
     * @var array
     */
    protected $arguments = [];

    /**
     * ErrorAbstract constructor.
     * @param string $message
     * @param array $arguments
     */
    public function __construct($message, $arguments = [])
    {
        $this->arguments = $arguments;

        parent::__construct($message, 500);
    }

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }
}
