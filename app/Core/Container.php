<?php

namespace Core;

class Container implements \ArrayAccess
{
    public $items = [];
    public $cacheItems = [];

    public function __construct(array $offsets) {
        foreach($offsets as $key => $offset) {
            $this->items[$key] = $offset;
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        if(!($this->offsetExists($offset))) {
            return null;
        }
        if(isset($this->cacheItems[$offset])) {
            return $this->cacheItems[$offset];
        } else {
            $item = $this->items[$offset]($this);
            $this->cacheItems[$offset] = $item;
            return $item;
        }
    }

    public function offsetSet($offset, $value)
    {
        $this->items[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        if($this->offsetExists($offset)) {
            unset($this->items[$offset]);
            unset($this->cacheItems[$offset]);
        }
    }

    public function __get($property) {
        return $this->offsetGet($property);
    }
}