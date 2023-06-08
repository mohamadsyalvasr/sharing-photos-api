<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait FileHandlingTraits
{
    /**
     * For Upload Images.
     * @param mixed $request
     * @param mixed $data
     * @param mixed $name
     * @param mixed|null $inputName
     * @return bool|string
     */
    public function uploadFile($request, $data, $pathToFile, $inputName = 'file'): bool|string
    {
        $requestFile = $request->file($inputName);
        try {
            $fileName = time().'.'.$requestFile->extension();
            $path = 'public/'.$pathToFile;

            if ($requestFile) {
                $img = Storage::putFileAs($path, $requestFile, $fileName);
                $data->update([
                    'path' => Storage::url($img)
                ]);
            }

            return true;
        } catch (\Throwable $th) {
            report($th);
            return $th->getMessage();
        }
    }

    // delete file
    public function deleteFile($pathToFile): bool|string
    {
        try {
            File::delete(public_path($pathToFile));

            return true;
        } catch (\Throwable $th) {
            report($th);
            return $th->getMessage();
        }
    }
}
