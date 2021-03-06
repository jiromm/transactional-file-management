<?php

namespace Transactica;

class FileManager
{
    protected $temp = [];

    public function apply()
    {
        foreach ($this->temp as $record) {
            $this->forceRemove($record);
        }
    }

    public function revert()
    {
        $this->temp = [];
    }

    public function remove($path)
    {
        array_push($this->temp, $path);
    }

    protected function forceRemove($record)
    {
        $this->temp = array_unique($this->temp);

        if (is_dir($record)) {
            $this->forceRemoveDir($record);
        } else {
            $this->forceRemoveFile($record);
        }
    }

    protected function forceRemoveDir($dir)
    {
        $di = new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS);
        $ri = new \RecursiveIteratorIterator($di, \RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($ri as $file) {
            $file->isDir() ?  rmdir($file) : unlink($file);
        }

        rmdir($dir);
    }

    protected function forceRemoveFile($file)
    {
        unlink($file);
    }
}
