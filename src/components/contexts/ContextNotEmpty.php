<?php
namespace funcraft\stack\components\contexts;

/**
 * Class ContextNotEmpty
 * @package funcraft\stack\components\contexts
 */
class ContextNotEmpty extends ContextAbstract
{
    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return empty($this->data) && $this->addError('Can not be empty data') ? false : true;
    }
}
