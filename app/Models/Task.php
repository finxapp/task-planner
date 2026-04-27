<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title','description','is_completed','user_id', 'status'];

    public const STATUS_DRAFT = 'draft';
    public const STATUS_PENDING = 'pending';
    public const STATUS_REVIEW = 'review';
    public const STATUS_APPROVED = 'approved';


    public function user() {
        return $this->belongsTo(User::class);
    }

    // public function payments() {
    //     return $this->hasMany(Payment::class);
    // }
}
