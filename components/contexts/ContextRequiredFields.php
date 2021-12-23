<?php
namespace funcraft\stack\components\contexts;

/**
 * Class ContextRequiredFields
 * @package funcraft\stack\components\contexts
 */
class ContextRequiredFields extends ContextAbstract
{
    /**
     * @var array
     */
    protected $requiredFields = [];

    /**
     * ContextRequiredFields constructor.
     * @param $data
     * @param array $requiredFields
     */
    public function __construct($data, $requiredFields = [])
    {
        parent::__construct($data);

        if (!empty($requiredFields)) {
            $this->requiredFields = $requiredFields;
        }
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        foreach ($this->requiredFields as $field => $canBeEmpty) {
            if (!isset($this->data[$field])) {
                $this->addError('Field "' . $field .  '" is missed on the current context');
            } else {
                if (empty($this->data[$field]) && !$canBeEmpty) {
                    $this->addError('Field "' . $field . '" can not be empty');
                }
            }
        }

        return count($this->getErrors()) ? false : true;
    }
}
