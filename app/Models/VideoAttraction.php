<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoAttraction extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $fillable = ['name', 'url'];
    protected $dates = ['deleted_at'];
    protected $casts = [
        'id' => 'string',
    ];

    public $incrementing = false;
}
