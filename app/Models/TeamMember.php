<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TeamMember extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'team_members';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'position',
        'department',
    ];

    protected $dates = ['deleted_at'];

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
