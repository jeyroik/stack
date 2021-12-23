<?php
namespace funcraft\stack\components\contexts;

/**
 * Class ContextRequest
 * @package funcraft\stack\components\contexts
 */
class ContextRequest extends ContextRequiredFields
{
    const FIELD__REQUEST = 'request';
    const FIELD__RESPONSE = 'response';
    const FIELD__URI = 'uri';
    const FIELD__PARAMETERS = 'params';

    /**
     * @var array
     */
    protected $requiredFields = [
        self::FIELD__REQUEST => false,
        self::FIELD__RESPONSE => false,
        self::FIELD__URI => false,
        self::FIELD__PARAMETERS => true
    ];
}
