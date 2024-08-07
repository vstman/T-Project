<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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
        'duration',
        'budget'
    ];

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $baseSlug = Str::slug($model->project_title, '-');
            $slug = $baseSlug;
            $count = 1;

            // Check if the slug already exists
            while (self::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count;
                $count++;
            }

            $model->slug = $slug;
        });
    }

    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class);
    }

    public function supervisors()
    {
        return $this->hasMany(Supervisor::class);
    }
}
