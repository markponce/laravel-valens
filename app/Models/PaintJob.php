<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaintJob extends Model
{
    protected $guarded = [];  
    use HasFactory;

    public function currentColor() {
        return $this->hasOne('App\Models\Color', 'id', 'current_color');

    }

    public function targetColor() {
        return $this->hasOne('App\Models\Color', 'id', 'target_color');

    }
}
