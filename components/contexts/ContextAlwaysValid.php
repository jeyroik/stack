<?php
namespace funcraft\stack\components\contexts;

/**
 * Class ContextAlwaysValid
 * @package funcraft\stack\components\contexts
 */
class ContextAlwaysValid extends ContextAbstract
{
    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return true;
    }
}
