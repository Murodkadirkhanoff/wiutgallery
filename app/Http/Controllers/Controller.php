<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $file;
    private $path;

    public function upload($file, $path)
    {
        $this->file = $file;
        $this->path = $path;

        return $this->moveFile();
    }

    private function moveFile()
    {
        $fileName = $this->getFileName();
        $res = $this->file->move(public_path('upload/' . $this->path), $fileName);
        return $this->path . '/' . $fileName;
    }

    private function getFileName()
    {
        return time() . '-' . $this->file->getClientOriginalName();
    }

    public function deleteFile($path)
    {
        if(File::exists(public_path("upload/$path"))){
            File::delete(public_path("upload/$path"));
        }
    }
}
