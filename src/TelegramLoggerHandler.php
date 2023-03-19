<?php

namespace RLaurindo\TelegramLogger;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\LogRecord;
use RLaurindo\TelegramLogger\Services\TelegramService;

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
    private string $applicationName;

    /**
     * Application environment
     *
     * @var string
     */
    private string $applicationEnvironment;

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
        $this->applicationEnvironment = config('app.env');

        $this->telegramService = new TelegramService(config('telegram-logger.bot_token'), config('telegram-logger.chat_id'), config('telegram-logger.base_url'));
    }

    /**
     * Send log text to Telegram
     *
     * @param array $record
     * @return void
     */
    protected function write(LogRecord $record): void
    {
        $this->telegramService->sendMessage($this->formatLogText($record));
    }

    /**
     * Formart log text to send
     *
     * @var array $log
     * @return string
     */
    protected function formatLogText(LogRecord $log): string
    {
        $logText = '<b>Application:</b> ' . $this->applicationName . PHP_EOL;
        $logText .= '<b>Environment:</b> ' . $this->applicationEnvironment . PHP_EOL;
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
