<?php

declare(strict_types = 1);

namespace Compwright\ShipstationPhp\Webhook;

use Exception;

class ExpiredWebhookException extends Exception implements WebhookExceptionInterface
{
}
