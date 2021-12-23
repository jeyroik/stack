<?php
namespace funcraft\stack\interfaces;

/**
 * Interface ISchemaManager
 * @package funcraft\stack\interfaces
 */
interface ISchemaManager
{
    /**
     * ISchemaManager constructor.
     * @param string $name
     * @param array $config
     */
    public function __construct(string $name, array $config);

    /**
     * @param string $message
     * @param array $context
     *
     * @return bool
     * @throws \Exception
     */
    public function apply($message = '', $context = []): bool;

    /**
     * @return bool
     */
    public static function isSchemaExist(): bool;
}
