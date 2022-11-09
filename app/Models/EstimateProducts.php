<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateProducts extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function specie()
    {
        return $this->belongsTo(\App\Models\Species::class, 'species_id');
    }

    public function cut()
    {
        return $this->belongsTo(\App\Models\Cuts::class, 'cut_id');
    }

    public function size()
    {
        return $this->belongsTo(\App\Models\Sizes::class, 'size_id');
    }

    public function quality()
    {
        return $this->belongsTo(\App\Models\Qualities::class, 'quality_id');
    }

    public function matching()
    {
        return $this->belongsTo(\App\Models\Matchings::class, 'matching_id');
    }

    public function backer()
    {
        return $this->belongsTo(\App\Models\Backers::class, 'backer_id');
    }

    public function thickness()
    {
        return $this->belongsTo(\App\Models\PanelThickness::class, 'thickness_id');
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\SheetTypes::class, 'sheet_type_id');
    }

    public function substrate()
    {
        return $this->belongsTo(\App\Models\PanelSubstrates::class, 'substrate_id');
    }
}
