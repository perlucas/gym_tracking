<?php

namespace Core\Utils;

class FilesCleaner
{
    const MAX_FILES = 10;

    /**
     * scans the files directory and removes the files if the max threshold is reached
     *
     * @return void
     */
    public static function scanAndCleanFiles() {
        $iterator = new \FilesystemIterator(FILES_DIR, \FilesystemIterator::SKIP_DOTS);

        if ( iterator_count($iterator) > static::MAX_FILES ) {
            for ($iterator->rewind(); $iterator->valid(); $iterator->next()) {
                \unlink($iterator->current());
            }
        }
    }
}