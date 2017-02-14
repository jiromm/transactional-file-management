<?php

namespace Transactica;

require "../vendor/autoload.php";

$storage = new Storage\Memory();
$transactica = new Transaction($storage);

try {
    $transactica->beginTransaction();
    echo 'let\'s game begins 1' . PHP_EOL;

    try {
        $transactica->beginTransaction();
        echo 'let\'s game begins 2' . PHP_EOL;

        $transactica->getFileManager()->remove(__DIR__ . '/data/tempfile');

        $transactica->commitTransaction();
        echo 'commited 2' . PHP_EOL;
    } catch (\Exception $e) {
        $transactica->rollbackTransaction();
        echo 'rolled back 2: ' . $e->getMessage() . PHP_EOL;
    }

    $transactica->getFileManager()->remove(__DIR__ . '/data/tempdir2');
    throw new \Exception('break it down');

    $transactica->commitTransaction();
    echo 'commited 1' . PHP_EOL;
} catch (\Exception $e) {
    $transactica->rollbackTransaction();
    echo 'rolled back 1: ' . $e->getMessage() . PHP_EOL;
}
