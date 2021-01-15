# Laravel Telegram Logging

Send Laravel logs to a Telegram chat via Telegram Bot.

[![Total Downloads](https://poser.pugx.org/rafaellaurindo/laravel-telegram-logging/downloads)](//packagist.org/packages/rafaellaurindo/laravel-telegram-logging)
[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LUAC5W7GF2BVW&source=url)
[![license](https://img.shields.io/github/license/rafaellaurindo/laravel-telegram-logging.svg)](https://github.com/rafaellaurindo/laravel-telegram-logging/blob/master/LICENSE)

## Installation

To install the package you can use [Composer](https://getcomposer.org/).

```bash
composer require rafaellaurindo/laravel-telegram-logging
```

Publish the package configuration file using the following artisan command:

```bash
php artisan vendor:publish --provider "RLaurindo\TelegramLogger\TelegramLoggerServiceProvider"
```

To send messages to your Telegram Chat, you first need a Telegram Bot. If you don't have one, see in this [Telegram Instructions](TELEGRAM_BOT_INSTRUCTIONS.md) how to create one.

Set your Bot Token and chat_id (user, channel or group that will receive log messages) and set as environment variable.

Add in your **.env**, the follows variables:

```bash
TELEGRAM_BOT_TOKEN=bot_token
TELEGRAM_CHAT_ID=chat_id
```

## Usage

Add the new Log Channel in **config/logging.php**:

```php
'telegram' => [
    'driver' => 'custom',
    'via'    => RLaurindo\TelegramLogger\TelegramLogger::class,
    'level'  => 'debug',
]
```

If you use the **stack channel** as default logger, you can just the telegram channel to your stack:

```php
'stack' => [
    'driver' => 'stack',
    'channels' => ['single', 'telegram'],
]
```

Or you can simply change the default logging channel in the .env file.

```bash
LOG_CHANNEL=telegram
```

Great! Your Laravel project can now send logs to your Telegram chat.

You can use **Laravel Log Facade** to send logs to your chat:

```php
// Use the Laravel Log Facade
use Illuminate\Support\Facades\Log;
...

// All Laravel log leves are avaiable
Log::channel('telegram')->emergency($message);
Log::channel('telegram')->alert($message);
Log::channel('telegram')->critical($message);
Log::channel('telegram')->error($message);
Log::channel('telegram')->warning($message);
Log::channel('telegram')->notice($message);
Log::channel('telegram')->info($message);
Log::channel('telegram')->debug($message);
```

## Telegram Instructions

To use this package, you need to create a Telegram bot to send messages to your chat.

If you need help, check out these [Telegram Instructions](TELEGRAM_BOT_INSTRUCTIONS.md) that I created for you.

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## Donations are welcome

If this project help you reduce time to develop, you can give me a cup of coffee :)

Donate with Paypal:

[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LUAC5W7GF2BVW&source=url)

## License

[MIT](https://github.com/rafaellaurindo/laravel-telegram-logging/blob/master/LICENSE)
