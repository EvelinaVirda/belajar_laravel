<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contentModel;

class TesController extends Controller
{
    public function hello_world()
    {
        $contentModel = new contentModel;
        $data['data_content'] = $contentModel->get_data_content();
        return view('content/hello_world', $data);
    }
}
