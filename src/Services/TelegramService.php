<?php

namespace RLaurindo\TelegramLogger;

/**
 * Class TelegramService
 *
 * @package RLaurindo\TelegramLogger
 */
class TelegramService
{

    /**
     * Telegram base API URL
     *
     * @var string
     */
    private $telegramApiBaseUrl;

    /**
     * Endpoint of send message in Telegram API
     *
     * @var string
     */
    private $telegramApiSendMessageEndpoint;

    /**
     * Token of your Telegram Bot that will send the messages
     *
     * @var string
     */
    private $telegramBotToken;

    /**
     * ID of your Telegram group that will receive the messages.
     *
     * @var string
     */
    private $telegramChatId;

    public function __construct(string $telegramBotToken, string $telegramChatId)
    {
        $this->telegramApiBaseUrl = 'https://api.telegram.org/bot';
        $this->telegramApiSendMessageEndpoint = 'sendMessage';
        $this->telegramBotToken = $telegramBotToken;
        $this->telegramChatId = $telegramChatId;
    }

    public function sendMessage(string $messageText)
    {
        $telegramApiSendMessageFullUrl = $this->telegramApiBaseUrl . $this->telegramBotToken . '/' . $this->telegramApiSendMessageEndpoint;
        $requestQueryData = $this->prepareRequestQuery($messageText);

        try {
            file_get_contents($telegramApiSendMessageFullUrl . '?' . $requestQueryData);
        } catch (Exception $exception) {}
    }

    private function prepareRequestQuery(string $messageText)
    {
        return http_build_query([
            'text' => $messageText,
            'chat_id' => $this->telegramChatId,
            'parse_mode' => 'html',
        ]);
    }
}
