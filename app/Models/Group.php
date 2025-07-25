<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{


    /** @use HasFactory<\Database\Factories\GroupFactory> */
    use HasFactory;

    protected $fillable = ["name", "owner_id", "owner_type"];

    public function owner()
    {
        return $this->morphTo();
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
