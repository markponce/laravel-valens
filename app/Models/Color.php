<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    public function paintJobs() {

        return $this->hasMany('App\Models\PaintJob', 'target_color', 'id');

    }
}
