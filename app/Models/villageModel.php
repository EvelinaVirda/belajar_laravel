<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class villageModel extends Model
{
    use HasFactory;

    public function get_list_village()
    {
        return DB::SELECT("SELECT * from villages limit 1000");
    }
}
