<?php

namespace App\Services;

use App\Models\Url;


class ArticleService
{
    public function storeArticles(Url $url, $data)
    {
        if($data->status){

            $url->update([
                'title' => $data->title,
                'status' => true,
            ]);

            foreach ($data->paragraph as $paragraph) {
                $url->articles()->create([
                    'status' => $data->status,
                    'text' => $paragraph,
                ]);
            }
        }else{
            if ($data->errorMessage === '') {
                $data->errorMessage = 'No error message was given!';
            }

            $url->update([
                'title' => $data->title,
                'status' => true
            ]);

            $url->articles()->create([
                'status' => $data->status,
                'text' => $data->errorMessage,
            ]);
        }


    }
}
