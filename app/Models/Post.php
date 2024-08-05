<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'supporting_organization',
        'project_title',
        'project_code',
        'supervisor',
        'department',
        'duration',
        'budget'
    ];

    protected $dates = ['deleted_at'];
    
    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class);
    }

    

    public function supervisors()
    {
        return $this->hasMany(Supervisor::class);
    }
}
