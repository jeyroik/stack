<?php
namespace funcraft\stack\components;

/**
 * Class ComponentArrayAccess
 * @package funcraft\stack\components
 */
class ComponentArrayAccess implements \ArrayAccess, \Iterator
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var string
     */
    protected $currentKey = '';

    /**
     * @var int
     */
    protected $currentKeyIndex = 0;

    /**
     * @return mixed
     */
    public function current()
    {
        if (!empty($this->data)) {
            $currentData = $this->data;

            return $this->currentKey ? $this->data[$this->currentKey] : array_shift($currentData);
        }

        return null;
    }

    /**
     * @return string
     */
    public function key()
    {
        if (!empty($this->data)) {
            $currentData = $this->data;

            return $this->currentKey ?: array_shift(array_keys($currentData));
        }

        return null;
    }

    /**
     * @return void
     */
    public function next()
    {
        if (!empty($this->data)) {
            $currentData = $this->data;

            if ($this->currentKey) {
                $keys = array_keys($currentData);
                $nextKeyIndex = $this->currentKeyIndex + 1;
                $this->currentKeyIndex = $nextKeyIndex;
                if (isset($keys[$nextKeyIndex])) {
                    $this->currentKey = $keys[$nextKeyIndex];
                }
            } else {
                $this->currentKey = array_keys($currentData)[0];
                $this->currentKeyIndex = 0;
            }
        }
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->data[$offset] : null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    /**
     * @param mixed $offset
     * @throws \Exception
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * @return void
     */
    public function rewind()
    {
        if (!empty($this->data)) {
            $this->currentKey = array_keys($this->data)[0];
            $this->currentKeyIndex = 0;
        }
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return count($this->data) && isset(array_keys($this->data)[$this->currentKeyIndex]);
    }
}
