<?php

namespace RLaurindo\TelegramLogger;

use Illuminate\Support\ServiceProvider;

/**
 * Class TelegramLoggerServiceProvider
 *
 * @package RLaurindo\TelegramLogger
 */
class TelegramLoggerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap of Telegram Logger Package.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/telegram-logger.php' => config_path('telegram-logger.php')]);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/telegram-logger.php', 'telegram-logger');
    }
}
