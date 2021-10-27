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
    public function get_value_subtitle($id)
    {
        return DB::SELECT("SELECT dc_id, dc_subtitle from dat_content where dc_id = '$id'");
    }
    public function update_value_subtitle($id, $value)
    {
        return DB::UPDATE("UPDATE dat_content set dc_subtitle = '$value' where dc_id = '$id'");
    }
}
