<?php

namespace App\Services;

use App\Models\Url;


class ArticleService
{
    public function storeArticles(Url $url, $data)
    {
        $url->update([
            'status' => $data->status
        ]);

        foreach ($data->paragraph as $paragraph) {
            $url->articles()->create([
                'title' => $data->title,
                'status' => $data->status,
                'text' => $paragraph,
            ]);
        }
    }

    public function storeFailedArticle(Url $url, $data)
    {
        if ($data->errorMessage === '') {
            $data->errorMessage = 'No error message was given!';
        }

        $url->update([
            'status' => $data->status
        ]);

        $url->articles()->create([
            'title' => $data->title,
            'status' => $data->status,
            'text' => $data->errorMessage,
        ]);
    }
}
