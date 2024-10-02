<?php
declare(strict_types=1);

namespace webhookpm\kamy;

class Webhook
{
    private string $url;
    private ?string $message = null;
    private WebhookType $type;

    private ?string $author = null;
    private ?string $title = null;
    private ?string $description = null;
    private ?int $color = null;
    private array $fields = [];
    private ?string $footer = null;
    private string $timestamp;

    private function __construct(WebhookType $type)
    {
        $this->type = $type;
        $this->timestamp = date('c');
    }

    public static function create(WebhookType $type): self
    {
        return new self($type);
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setMessage(string $message): void
    {
        $this->message = str_replace('{line}', "\n", $message);
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = str_replace('{line}', "\n", $description);
    }

    public function setColor(string $color): void
    {
        $this->color = hexdec(ltrim($color, "#"));
    }

    public function addField(string $name, string $value): void
    {
        $this->fields[] = [
            "name" => $name,
            "value" => $value,
            "inline" => true
        ];
    }

    public function setFooter(string $footer, ?string $timestamp = null): void
    {
        $this->footer = $footer;
        $this->timestamp = $timestamp ?? $this->timestamp;
    }

    public function send(): void
    {
        $payload = $this->type === WebhookType::TYPE_SIMPLE
            ? json_encode(["content" => $this->message])
            : json_encode([
                "content" => $this->message,
                "embeds" => [[
                    "author" => $this->author ? ["name" => $this->author] : null,
                    "title" => $this->title,
                    "description" => $this->description,
                    "color" => $this->color,
                    "fields" => $this->fields,
                    "footer" => $this->footer ? ["text" => $this->footer] : null,
                    "timestamp" => $this->timestamp
                ]]
            ]);

        $ch = curl_init($this->url);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ]);

        if (curl_exec($ch) === false) {
            error_log("cURL error: " . curl_error($ch));
        }

        curl_close($ch);
    }
}
