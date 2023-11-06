<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'description',
        'has_manager_approved',
        'has_supervisor_approved',
        'urgency'
    ];

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
