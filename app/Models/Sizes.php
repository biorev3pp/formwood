<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sizes extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function status()
    {
        return $this->belongsTo(\App\Models\Statuses::class);
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\SheetTypes::class, 'sheet_type_id');
    }
}
