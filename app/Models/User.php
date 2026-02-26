<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'solde',
        'is_admin',
        'is_banned',
        'is_member',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'is_banned' => 'boolean',
            'is_member' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
        // return true;
    }
    public function isBanned(): bool
    {
        return $this->is_banned;
    }
    public function isMember(): bool
    {
        return $this->is_member;
    }

    public function colocations()
    {
        return $this->hasMany(Colocation::class, 'owner_id');
    }
    public function colocationUsers()
    {
        return $this->hasMany(ColocationUser::class);
    }
}
