<?php
namespace funcraft\stack\interfaces\errors;

/**
 * Interface IError
 * @package funcraft\stack\interfaces\errors
 */
interface IError extends \Throwable
{
    /**
     * IError constructor.
     * @param $message
     * @param array $arguments
     */
    public function __construct($message, $arguments = []);

    /**
     * @return array
     */
    public function getArguments(): array;
}
