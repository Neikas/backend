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
        'started_at',
    ];

    public function urls()
    {
        return $this->hasMany(Url::class, 'crawler_job_id');
    }
}
