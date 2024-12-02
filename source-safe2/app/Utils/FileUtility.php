<?php

namespace App\Utils;

use Illuminate\Support\Facades\Storage;

class FileUtility
{
    /**
     * Store a file in the `storage/app/public` directory and return its path.
     *
     * @param \Illuminate\Http\UploadedFile $file The file to store.
     * @param string $directory The directory where the file will be stored inside `storage/app/public`.
     * @return string The relative path of the stored file.
     */
    public static function storeFile($file, $directory = 'uploads')
    {
        // Store the file in the specified directory under the `public` disk
        return $file->store($directory, 'public');
    }

    /**
     * Get the complete URL of a file stored in the `public` disk.
     *
     * @param string $filePath The relative path of the file.
     * @return string The complete URL of the file.
     */
    public static function getFileUrl($filePath)
    {
        // Generate and return the complete URL for the given file path
        return asset('storage/' . $filePath);
    }

    /**
     * Delete a file from the `public` disk.
     *
     * @param string $filePath The relative path of the file to delete.
     * @return bool True if the file was deleted, false otherwise.
     */
    public static function deleteFile($filePath)
    {
        // Check if the file exists in the `public` disk
        if (Storage::disk('public')->exists($filePath)) {
            // Delete the file
            return Storage::disk('public')->delete($filePath);
        }

        return false; // File does not exist
    }
}
