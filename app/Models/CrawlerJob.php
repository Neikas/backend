<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrawlerJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'status',
        'finished_at',
    ];
    public function articles()
    {
        return $this->hasMany(Article::class, 'job_id');
    }
}
