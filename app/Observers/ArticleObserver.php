<?php

namespace App\Observers;

use App\Http\Controllers\BotController;
use App\Models\Article;

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     *
     * @param Article $article
     * @return void
     */
    public function created(Article $article)
    {
        $bot = new BotController();

        $data=[
            "title" => $article->type=="twit" ? "Rp76" : $article->title,
            "message" => strip_tags($article->summary == "" ? $article->content : $article->summary),
            "link" => $article->link,
            "image" => $article->type!="twit" ? $article->image : "https://source.unsplash.com/300x300/?minimal,social,game,animal,wood&random=" . uniqid()
        ];

        $bot->sendPost((object)$data);
    }

    /**
     * Handle the Article "updated" event.
     *
     * @param Article $article
     * @return void
     */
    public function updated(Article $article)
    {
        //
    }

    /**
     * Handle the Article "deleted" event.
     *
     * @param Article $article
     * @return void
     */
    public function deleted(Article $article)
    {
        //
    }

    /**
     * Handle the Article "restored" event.
     *
     * @param Article $article
     * @return void
     */
    public function restored(Article $article)
    {
        //
    }

    /**
     * Handle the Article "force deleted" event.
     *
     * @param Article $article
     * @return void
     */
    public function forceDeleted(Article $article)
    {
        //
    }
}
