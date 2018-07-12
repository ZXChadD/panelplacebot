<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Conversations\ExampleConversation;
use Illuminate\Support\Facades\DB;


class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('Hello', function ($bot, $limit) {
            $result = $this->getMembers($limit);
            $bot->reply('Hello');
        });

        // Fallback in case of wrong command
        $botman->fallback(function ($bot) {
            $bot->reply("Sorry, I did not understand these commands. Try: `cryptocompare 5`");
        });

        $botman->listen();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public function startConversation(BotMan $bot)
    {
        $bot->startConversation(new ExampleConversation());
    }

    protected function getMembers($limit)
    {
        $data = DB::table('members')->take($limit)->get();

        return $data;
    }
}
