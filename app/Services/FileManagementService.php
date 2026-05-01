<?php

namespace App\Services;

class FileManagementService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function saveFile($file, $folder)
    {
        return $file->store($folder, 'public');
    }
}
