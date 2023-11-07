<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'request_id',
        'type',
    ];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }
}
