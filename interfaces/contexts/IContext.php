<?php
namespace funcraft\stack\interfaces\contexts;
use funcraft\stack\interfaces\errors\IError;

/**
 * Interface IContext
 * @package funcraft\stack\interfaces\contexts
 */
interface IContext extends \ArrayAccess, \Iterator
{
    /**
     * IContext constructor.
     * @param $data
     */
    public function __construct($data);

    /**
     * @return bool
     */
    public function isValid(): bool;

    /**
     * @return IError[]
     */
    public function getErrors(): array;
}
