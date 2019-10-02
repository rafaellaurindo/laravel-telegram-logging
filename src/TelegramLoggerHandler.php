<?php

namespace RLaurindo\TelegramLogger;

use Exception;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use RLaurindo\TelegramService;

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
     */
    public function write(array $record)
    {
        try {
            $this->telegramService->sendMessage($this->formatLogText($record['formatted'], $record['level']));
        } catch (Exception $exception) {}
    }

    /**
     * Formart log text to send
     *
     * @var string $logText
     * @var string $logLevel
     *
     * @return string
     */
    private function formatLogText(string $logText, string $logLevel): string
    {
        return '<b>Application:</b> ' . $this->applicationName . PHP_EOL
        . '<b>Envioronment:</b> ' . $this->applicationEnvioronment . PHP_EOL
            . '<b>Log Level:</b> ' . $logLevel . PHP_EOL
            . '<b>Log:</b>' . PHP_EOL
            . '<code>' . $logText . '</code>';
    }
}
