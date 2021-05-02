<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'link'];

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
