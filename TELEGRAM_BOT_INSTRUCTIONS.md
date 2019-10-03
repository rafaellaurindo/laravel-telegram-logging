# Telegram Instructions

Instructions for creating a new Telegram Bot and getting chat_id from a particular group or chat.

## Creating a Bot

1. Go to [@BotFather](https://t.me/botfather) on Telegram.

2. Send `/newbot`, to start creating a new Bot.

   ![message](https://i.imgur.com/M2KEEp2.png)

3. Set the bot's username and username.

   ![defines-a-bot-name](https://i.imgur.com/ixpfVfQ.png)

4. Now you need to allow your Bot to send direct messages, so send `/setjoingroups` to @BotFather, select your Bot and click Enable:

   ![set-join-group](https://i.imgur.com/TCk4WkC.png)

5. Get the Bot token and add it to your .env file.

   ![get-bot-token](https://i.imgur.com/EwrhvmU.png)

   Bot Token in .env:

   ![token-in-env-file](https://i.imgur.com/SniTiQt.png)

## Getting a Telegram Chat ID

- If you want to send messages to a group:

  1. Add your Bot to a Telegram group.
  2. Send any message from another user to this group.

- If you want send direct messages to a user:

  1. Search for your bot name, and select the chat.
  2. Send `/start` to your Bot.

3. Visit the following link to get updates about your bot and get chat_id:

   https://api.telegram.org/botXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/getUpdates

Replace all **X** in the URL with your **Bot Token**.

4. Search for the chat that you want to send messages, and get the **chat->id**:

   ![get-a-chat-id](https://i.imgur.com/EJIVfWc.png)

5. Add it to your .env file:

   ![env](https://i.imgur.com/aqRdV1S.png)

---

Hope this helps you!
