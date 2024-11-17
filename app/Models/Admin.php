<?php

namespace App\Models;

use App\Enums\Admins\Type;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Pktharindu\NovaPermissions\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected string $guard = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'image' => 'array',
        'type' => Type::class,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_experts', 'expert_id', 'course_id');
    }

    // belongs to many courses

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => asset("storage/{$this->image}")
        );
    }
    public function scopeSearch($query)
    {
        return $query->where('name', 'like', "%" . request('search') . "%");
    }
}
