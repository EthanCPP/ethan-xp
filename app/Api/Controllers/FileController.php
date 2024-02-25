<?php

namespace App\Api\Controllers;

use App\Models\File;

class FileController extends Controller
{
    public function index()
    {
        $files = File::all();

        return $files;
    }

    public function locationIndex($location) {
        $files = File::where('location', $location)->get();

        return $files;
    }

    public function filesInFolder($id) {
        $files = File::where('parent_id', $id)->get();

        return $files;
    }
}
