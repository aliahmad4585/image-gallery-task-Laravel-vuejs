<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Photo extends Model
{
    use HasFactory;

    /**
     * The attributes that are not in mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];


    
    /**
     * Get the users that owns the user.
     */
    public function user()
    {
        return $this->belongsToMany(User::class, 'photos_likes');
    }
}
