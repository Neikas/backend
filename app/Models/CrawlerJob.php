<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getAllCrawlerJobsWithStatusAttribute($status)
    {
        return $this->where('status', $status)->get();
    }

    public function setCrawlerJobRunTimeAttribute($id, $field)
    {
        return $this->findOrFail($id)->update([$field => Carbon::now()]);
    }

    public function setStatusDoneAttribute($id)
    {
        return $this->findOrFail($id)->update(['status' => 'Done']);
    }
}
