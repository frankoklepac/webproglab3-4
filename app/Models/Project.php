<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'completed_projects',
        'start_date',
        'end_date',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    public function isOwner(User $user)
    {
        return $this->user_id === $user->id;
    }

    public function isMember(User $user)
    {
        return $this->members()->where('user_id', $user->id)->exists();
    }
}
