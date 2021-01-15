<?php

namespace RLaurindo\TelegramLogger\Services;

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
            $responseStatusCode = $this->getResponseStatusCode($telegramApiSendMessageFullUrl . '?' . $requestQueryData);

            return $this->returnResponseOfApiByStatusCode($responseStatusCode);
        } catch (\Exception $exception) {}
    }

    private function prepareRequestQuery(string $messageText)
    {
        return http_build_query([
            'text' => $messageText,
            'chat_id' => $this->telegramChatId,
            'parse_mode' => 'html',
        ]);
    }

    private function returnResponseOfApiByStatusCode($responseStatusCode)
    {
        $responseMessages = [
            '200' => 'Message has been sent.',
            '400' => 'Chat ID is not valid.',
            '401' => 'Bot Token is not valid.',
            '404' => 'Bot Token is not valid.',
        ];

        return $responseMessages[$responseStatusCode] ?? null;
    }

    private function getResponseStatusCode(string $url): string
    {
        $requestHeaders = get_headers($url);
        $requestStatusCode = substr($requestHeaders[0], 9, 3);
        return $requestStatusCode;
    }
}
