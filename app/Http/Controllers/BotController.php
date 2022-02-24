<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram;

class BotController extends Controller
{
    private Telegram $bot;

    public function __construct()
    {
        $this->bot = new Telegram(env("TELEGRAM_TOKEN"));
    }

    public function index()
    {
        $this->bot->sendPhoto([
            "chat_id" => $this->bot->chatId(),
            "parse_mode" => "Markdown",
            "photo" => "https://picsum.photos/1600/900?" . uniqid(),
            "caption" => "[Hello World!](https://rp76.ir)"
        ]);
    }

    public function sendMessage($message)
    {
        $this->bot->sendMessage([
            "chat_id" => env("TELEGRAM_CHANNEL"),
            "parse_mode" => "Markdown",
            "text" => $message
        ]);
    }

    /**
     * @param object $post The object that contains the title,message,image and link.
     */
    public function sendPost(object $post): void
    {
        $caption = "[$post->title]($post->link)";
        $caption .= "\n$post->message";

        $this->bot->sendPhoto([
            "chat_id" => env("TELEGRAM_CHANNEL"),
            "parse_mode" => "Markdown",
            "photo" => $post->image,
            "caption" => $caption
        ]);
    }
}
