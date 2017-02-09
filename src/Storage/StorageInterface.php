<?php

namespace Transactica\Storage;

interface StorageInterface
{
    public function get($key);

    public function set($key, $value);

    public function clear();
}
