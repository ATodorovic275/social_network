<?php


namespace App\Services;


class UploadService
{

    public function upload($file, $path = null)
    {
        $alt = $file->getClientOriginalName();
        $fileName = time() . $alt;

        // dd($fileName);
        if ($path) {
            $file->move(\public_path() . "/img/$path", $fileName); //promeni putanju

        } else {
            $file->move(\public_path() . "/img", $fileName); //promeni putanju
        }

        return [
            'file_name' => $fileName,
            'alt' => $alt
        ];
    }
}
