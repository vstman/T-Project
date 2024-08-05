<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supervisor extends Model
{

    use SoftDeletes;

    use HasFactory;
    protected $table = 'supervisors';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'department',
        'supervisor_photo',
    ];

    protected $dates = ['deleted_at'];

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
