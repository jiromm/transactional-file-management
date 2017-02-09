<?php

namespace Transactica\Storage;

class Memory implements StorageInterface
{
    protected $memory = [];

    public function get($key)
    {
        if (isset($this->memory[$key])) {
            return $this->memory[$key];
        }
    }

    public function set($key, $value)
    {
        $this->memory[$key] = $value;
    }

    public function clear()
    {
        $this->memory = [];
    }
}
