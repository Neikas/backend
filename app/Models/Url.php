<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'status',
        'crawler_job_id'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
