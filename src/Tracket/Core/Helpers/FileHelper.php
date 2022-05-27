<?php

namespace Tracket\Core\Helpers;

class FileHelper
{
    public static function removeDirectory($directory): bool
    {
        if (is_dir($directory)) {
            $objects = scandir($directory);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($directory . DIRECTORY_SEPARATOR . $object) && !is_link($directory . DIRECTORY_SEPARATOR . $object)) {
                        static::removeDirectory($directory . DIRECTORY_SEPARATOR . $object);
                    } else {
                        unlink($directory . DIRECTORY_SEPARATOR . $object);
                    }
                }
            }

            rmdir($directory);
        }

        return true;
    }

    public static function createSymlink($fromDir, $toDir): bool
    {
        if (!file_exists($toDir)) {
            symlink($fromDir, $toDir);
        }
        return true;
    }

    public static function removeSymlink($directory): bool
    {
        return unlink($directory);
    }
}
