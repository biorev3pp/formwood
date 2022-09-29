<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SheetTypes extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function status()
    {
        return $this->belongsTo(\App\Models\Statuses::class);
    }

    public function sizes()
    {
        return $this->hasMany(\App\Models\Sizes::class, 'sheet_type_id')->where('status_id', 1);
    }
}
