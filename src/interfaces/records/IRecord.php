<?php
namespace funcraft\stack\interfaces\records;

use funcraft\stack\interfaces\stacks\IStack;

/**
 * Interface IRecord
 * @package funcraft\stack\interfaces\records
 */
interface IRecord extends \Iterator, \ArrayAccess
{
    public function __construct(IStack $stack);

    public function setData(array $data);
    public function setLevel(int $level);
    public function setMessage(string $message);
    public function setContext(array $context);

    public function getName();
    public function getData(): array;
}
