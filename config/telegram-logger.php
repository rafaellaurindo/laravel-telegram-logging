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
    
    /*
    |--------------------------------------------------------------------------
    | TELEGRAM BASE URL
    |--------------------------------------------------------------------------
    |
    | Defines the base url of telegram. For countries block telegram servers, 
    | this create a bridge for sending message to telegram. for more info see:
    | https://github.com/AmirrezaNasiri/telegram-web-bridge
    |
     */

    'base_url' => env('TELEGRAM_BASE_URL', 'https://api.telegram.org/'),
];
