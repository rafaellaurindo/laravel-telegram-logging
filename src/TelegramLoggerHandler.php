<?php

namespace RLaurindo\TelegramLogger;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

/**
 * Class TelegramHandler
 *
 * @package Rlaurindo\TelegramLogger
 */
class TelegramLoggerHandler extends AbstractProcessingHandler
{

    /**
     * Application name
     *
     * @var string
     */
    private $applicationName;

    /**
     * Application environment
     *
     * @var string
     */
    private $applicationEnvioronment;

    /**
     * Instance of TelegramService
     *
     * @var TelegramService
     */
    private $telegramService;

    /**
     * TelegramHandler constructor.
     *
     * @param string $logLevel
     */
    public function __construct(string $logLevel)
    {
        $monologLevel = Logger::toMonologLevel($logLevel);
        parent::__construct($monologLevel, true);

        $this->applicationName = config('app.name');
        $this->applicationEnvioronment = config('app.env');

        $this->telegramService = new TelegramService(config('telegram-logger.bot_token'), config('telegram-logger.chat_id'));
    }

    /**
     * Send log text to Telegram
     *
     * @param array $record
     * @return void
     */
    protected function write(array $record): void
    {
        $this->telegramService->sendMessage($this->formatLogText($record));
    }

    /**
     * Formart log text to send
     *
     * @var array $log
     * @return string
     */
    protected function formatLogText(array $log): string
    {
        $logText = '<b>Application:</b> ' . $this->applicationName . PHP_EOL;
        $logText .= '<b>Envioronment:</b> ' . $this->applicationEnvioronment . PHP_EOL;
        $logText .= '<b>Log Level:</b> <code>' . $log['level_name'] . '</code>' . PHP_EOL;

        if (!empty($log['extra'])) {
            $logText .= '<b>Extra:</b>' . PHP_EOL . '<code>' . json_encode($log['extra']) . '</code>' . PHP_EOL;
        }

        if (!empty($log['context'])) {
            $logText .= '<b>Context:</b>' . PHP_EOL . '<code>' . json_encode($log['context']) . '</code>' . PHP_EOL;
        }

        $logText .= '<b>Message:</b>' . PHP_EOL . '<pre>' . $log['message'] . '</pre>';

        return $logText;
    }
}
