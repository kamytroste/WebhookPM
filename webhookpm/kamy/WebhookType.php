<?php
declare(strict_types=1);

namespace webhookpm\kamy;

enum WebhookType: string
{
    case TYPE_SIMPLE = 'simple';
    case TYPE_EMBED = 'embed';
}
