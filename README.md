# Transactica
Work with the file system transactionally

### Example

```php
<?php

namespace Transactica;

require __DIR__ . "/vendor/autoload.php";

$storage = new Storage\Memory();
$transactica = new Transaction($storage);

try {
    $transactica->beginTransaction();

    try {
        $transactica->beginTransaction();

        $transactica->getFileManager()->remove(__DIR__ . '/data/tempfile');

        $transactica->commitTransaction();
    } catch (\Exception $e) {
        $transactica->rollbackTransaction();
    }

    $transactica->getFileManager()->remove(__DIR__ . '/data/tempdir2');
    throw new \Exception('break it down');

    $transactica->commitTransaction();
} catch (\Exception $e) {
    $transactica->rollbackTransaction();
}
```
