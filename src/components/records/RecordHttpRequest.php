<?php
namespace funcraft\stack\components\records;

use funcraft\stack\components\contexts\ContextRequest;

use \Psr\Http\Message\ResponseInterface;
use \Psr\Http\Message\ServerRequestInterface;

/**
 * Class RecordRequest
 * @package funcraft\stack\components\records
 */
class RecordHttpRequest extends RecordAbstract
{
    /**
     * @param array $contextData
     *
     * @return RecordHttpRequest
     * @throws mixed
     */
    public function setContext(array $contextData): self
    {
        $context = new ContextRequest($contextData);

        if (!$context->isValid()) {
            throw array_shift($context->getErrors());
        }

        $this[static::FIELD__CONTEXT] = $context;

        return $this;
    }

    /**
     * @return ServerRequestInterface
     */
    public function getRequest()
    {
        return $this[static::FIELD__CONTEXT][ContextRequest::FIELD__REQUEST];
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this[static::FIELD__CONTEXT][ContextRequest::FIELD__RESPONSE];
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this[static::FIELD__CONTEXT][ContextRequest::FIELD__URI];
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this[static::FIELD__CONTEXT][ContextRequest::FIELD__PARAMETERS];
    }
}
