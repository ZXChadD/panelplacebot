<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Conversations\ExampleConversation;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('hello {limit}', function ($bot, $limit) {
            $results = $this->getMembers($limit);
            foreach($results as $result) {
                $bot->reply($result);
            }
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
        $data = [];
        $members = DB::table('members')->take($limit)->get();
        foreach ($members as $member){
            array_push($data, $member->firstName);
        }

        return $data;
    }
}
