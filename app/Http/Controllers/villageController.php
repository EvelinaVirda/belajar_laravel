<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\villageModel;

class villageController extends Controller
{
    public function listVillage()
    {
        $village = new villageModel;
        $data['list_village'] = $village->get_list_village();
        return view('list_village', $data);
    }
}
