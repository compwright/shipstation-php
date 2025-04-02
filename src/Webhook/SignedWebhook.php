<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Webhook;

use Compwright\EasyWebhook\SignedWebhook as EasySignedWebhook;

class SignedWebhook extends EasySignedWebhook
{
    protected string $timestampHeader = 'x-shipengine-timestamp';
    protected string $signatureHeader = 'x-shipengine-rsa-sha256-signature';
    protected string $publicKeyIdHeader = 'x-shipengine-rsa-sha256-key-id';
}
