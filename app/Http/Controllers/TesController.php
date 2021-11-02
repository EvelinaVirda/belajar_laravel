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

    public function get_value_subtitle(Request $request)
    {
        $contentModel = new contentModel;
        $id = $request->input('id_content');
        $result['value_subtitle'] = $contentModel->get_value_subtitle($id);
        return $result;
    }

    public function update_value_subtitle(Request $request)
    {
        $result = [];
        $contentModel = new contentModel;
        $id = $request->input('id_content');
        $value = $request->input('isi_subtitle');
        $update = $contentModel->update_value_subtitle($id, $value);
        if ($update) $result['success'] = false;
        else $result['success'] = true;
        return $result;
    }

    public function update_image(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->gambar->extension();

        $request->gambar->move(public_path('gambar'), $imageName);

        /* Store $imageName name in DATABASE from HERE */

        return back()
            ->with('success', 'You have successfully upload image.')
            ->with('image', $imageName);
    }
}
