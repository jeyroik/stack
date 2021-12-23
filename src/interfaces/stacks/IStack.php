<?php
namespace funcraft\stack\interfaces\stacks;

use Psr\Log\LoggerInterface;

/**
 * Interface IStack
 * @package funcraft\stack\interfaces\stacks
 */
interface IStack extends LoggerInterface
{
    /**
     * IStack constructor.
     *
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
    );

    /**
     * @param string $message
     * @param array $context
     *
     * @return mixed
     */
    public function run(string $message, array $context = []);

    /**
     * @return mixed
     */
    public function getPreviousStackResult();

    /**
     * @return mixed
     */
    public function getCurrentStackResult();
}
