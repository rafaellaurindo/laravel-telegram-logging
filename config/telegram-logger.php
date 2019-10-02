<?php

return [
    /*
    |--------------------------------------------------------------------------
    | TELEGRAM BOT TOKEN
    |--------------------------------------------------------------------------
    |
    | Defines the token of your Telegram Bot that will send the messages.
    |
     */

    'bot_token' => env('TELEGRAM_BOT_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | TELEGRAM CHAT ID
    |--------------------------------------------------------------------------
    |
    | Defines the id of your Telegram group that will receive the messages.
    |
     */

    'chat_id' => env('TELEGRAM_CHAT_ID'),
];
