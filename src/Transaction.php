<?php

namespace Transactica;

use Transactica\Storage\StorageInterface;

class Transaction
{
    protected $storage;
    protected $counter = 0;
    protected $filemanager;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
        $this->filemanager = new FileManager();
    }

    public function beginTransaction()
    {
        $this->counter++;
    }

    public function commitTransaction()
    {
        $this->counter--;

        if (!$this->counter) {
            $this->filemanager->apply();
        }
    }

    public function rollbackTransaction()
    {
        if ($this->counter) {
            $this->filemanager->revert();
        }
    }

    public function getFileManager()
    {
        return $this->filemanager;
    }
}
