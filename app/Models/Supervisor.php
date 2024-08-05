<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;
    protected $table = 'supervisors';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'department',
        'supervisor_photo',
    ];

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
