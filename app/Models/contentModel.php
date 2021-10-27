<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class contentModel extends Model
{
    use HasFactory;

    public function get_data_content()
    {
        return DB::SELECT("SELECT * from dat_content");
    }
}
