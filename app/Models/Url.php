<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'status',
        'crawler_job_id',
        'title',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'url_id');
    }
}
