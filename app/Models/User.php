<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\RoleRequest;
use App\Models\Blog;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes;
    //  use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        ];
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }

    // public function payments() {
    //     return $this->hasMany(Payment::class);
    // }

    public function canDeleteUser(User $target) {

         // nobody deletes themselves
        if ($this->id === $target->id) {
            return false;
        }
        // superadmin deletes everone else except a superadmin
        if ($this->hasRole('superadmin')) {
            return !$target->hasRole('superadmin');
        }

        if ($this->hasRole('admin')) {
            return $target->hasAnyRole(['supervisor','user', 'editor', 'author']);
        }

        if ($this->hasRole('supervisor')) {
            return $target->hasAnyRole(['user', 'editor', 'author']);
        }

        return false;
    }

    public function roleRequests() {
        return $this->hasMany(RoleRequest::class);
    }

    public function blogs() {
        return $this->hasMany(Blog::class);
    }

    public function highestRole()
    {
        $hierarchy = [
            'superadmin',
            'admin',
            'supervisor',
            'editor',
            'author',
            'user'
        ];

        foreach ($hierarchy as $role) {
            if ($this->hasRole($role)) {
                return $role;
            }
        }

        return null;
    }

    public function canAssignRole($role)
    {
        if ($this->hasRole('superadmin')) {
            return true;
        }

        if ($this->hasRole('admin')) {
            return in_array($role, ['supervisor','editor','author','user']);
        }

        if ($this->hasRole('supervisor')) {
            return in_array($role, ['editor','author','user']);
        }

        return false;
    }
}
