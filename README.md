##### Para la versión en español revisa [README_ESPAÑOL](README_ES.md)

# Webhook
The Webhook class is a PHP utility intended for use in PocketMine-MP (it can be used in other areas as well), allowing seamless message delivery to Discord webhooks. It enables you to create both simple messages and enriched embeds. To use it, simply follow the steps below.

## Setup
To set up the Webhook class in your PocketMine-MP project, follow these steps:
1. **Download the Release:** First, download the latest release from this repository. You will receive a compressed file containing all necessary files.
2. **Extract the Files:** Extract the contents of the downloaded release to the `src` directory of your PocketMine-MP project. It is recommended that the folder structure is at the same level as your author name to ensure proper organization. The structure should look like this
   ```scss
   YourPlugin/
      src/
        yourName/
          ...
        webhookpm/
          ...
   ```
3. **Including the Webhook Class:** In your project files, you can include the Webhook class using the appropriate namespace:
   ```php
   use webhookpm\kamy\Webhook;
   use webhookpm\kamy\WebhookType;
   ```

## Simple Webhook
To create a new instance of the webhook, use the create method. Here’s an example of a simple webhook:
```php
// Create a new instance of the webhook
$webhook = Webhook::create(WebhookType::TYPE_SIMPLE);

// Set the webhook URL
$webhook->setUrl('YOUR_WEBHOOK_URL');

// Set the message to send
$webhook->setMessage(['Hello world!']);

// Send the message
$webhook->send();
```
### Functions
1. **setUrl(string $url): void**
   - This method sets the URL of the webhook where the messages will be sent. You need to provide a valid webhook URL from Discord or a similar service.
   - **Example:**
     ```php
     $webhook->setUrl('YOUR_WEBHOOK_URL');
     ```
2. **setMessage(array $message): void**
   - This method sets the message that you want to send. The message can be an array of strings, which will be concatenated into a single message.
   - **Example:**
     ```php
     $webhook->setMessage(['Hello, this is a line 1 example', 'line 2 example']);
     ```
3. **send(): void**
   - This method sends the prepared message to the specified webhook URL. It constructs the payload and uses cURL to perform a POST request to the webhook URL. If an error occurs during the cURL request, it will log the error.
   - **Example:**
     ```php
     $webhook->send();
     ```

## Embed Webhook
The Embed Webhook functionality allows you to send enriched messages that include various fields and formatting options. This is useful for creating visually appealing messages on platforms like Discord.

To create an embed webhook, use the `create` method with the `WebhookType::TYPE_EMBED` type. Here’s an example of how to use the embed webhook:
```php
// Create a new instance of the webhook with embeds
$webhook = Webhook::create(WebhookType::TYPE_EMBED);

// Set the webhook URL
$webhook->setUrl('YOUR_WEBHOOK_URL');

// Set the embed details
$webhook->setTitle('Example Embed Title');
$webhook->setDescription(['This is the first line of the embed description.', 'This is the second line.']);
$webhook->setColor('#ff5733'); // Set the color of the embed using a hex value
$webhook->setFooter('Footer Text', null); // Optionally set a footer

// Add fields to the embed
$webhook->addField('Field 1', 'This is the value of field 1.');
$webhook->addField('Field 2', 'This is the value of field 2.');

// Send the embed message
$webhook->send();
```
### Functions
1. **setUrl(string $url): void**
   - This method sets the URL of the webhook where the messages will be sent. You need to provide a valid webhook URL from Discord or a similar service.
   - **Example:**
     ```php
     $webhook->setUrl('YOUR_WEBHOOK_URL');
     ```
3. **setMessage(array $message): void** `OPTIONAL`
   - This method sets the message that you want to send. The message can be an array of strings, which will be concatenated into a single message.
   - **Example:**
     ```php
     $webhook->setMessage(['Hello, this is a line 1 example', 'line 2 example']);
     ```
4. **setTitle(?string $title): void**
   - This method sets the title of the embed message. The title appears as a bold text at the top of the embed.
   - **Example:**
     ```php
     $webhook->setTitle('Example Embed Title');
     ```
5. **setDescription(array $description): void**
   - This method sets the description of the embed message. You can provide an array of strings, which will be concatenated into a single description.
   - **Example:**
     ```php
     $webhook->setDescription(['This is the first line of the embed description.', 'This is the second line.']);
     ```
6. **setColor(string $color): void**
   - This method sets the color of the embed. The color should be provided as a hex value (e.g., `#ff5733`).
   - **Example:**
     ```php
     $webhook->setColor('#ff5733');
     ```
7. **setFooter(string $footer, ?string $timestamp = null): void**
   - This method sets the footer text of the embed. You can optionally provide a timestamp that will be displayed alongside the footer.
   - **Example:**
     ```php
     $webhook->setFooter('Footer Text');
     ```
8. **addField(string $name, string $value): void**
   - This method adds a field to the embed. Each field has a name and a value, and fields can be made `inline` by setting inline to true.
   - **Example:**
     ```php
     $webhook->addField('Field 1', 'This is the value of field 1.');
     ```

# License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.
