<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $table = 'team_members';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'position',
        'department',
    ];

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
