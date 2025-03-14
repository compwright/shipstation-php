<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Webhook;

use DateTimeImmutable;

class WebhookVerifier
{
    public function __invoke(SignedWebhook $request, string $pem): void
    {
        // Prevent replay attacks
        $threshold = new DateTimeImmutable('-5 minute UTC');
        if ($request->getUtcDateTime() < $threshold) {
            throw new ExpiredWebhookException('Request expired');
        }

        // Load the public key
        $key = openssl_pkey_get_public($pem);
        if ($key === false) {
            throw new SignatureException(
                'Error loading public key: ' . openssl_error_string()
            );
        }

        $signature = base64_decode($request->getSignature(), true);
        if ($signature === false) {
            throw new HeaderException('Invalid signature format');
        }

        // Check the signature
        $ok = openssl_verify(
            $request->getDataToSign(),
            $signature,
            $key,
            $request->getAlgorithm()
        );

        if ($ok === 1) {
            return;
        }

        if ($ok === 0) {
            throw new SignatureException('Invalid signature');
        }

        if ($ok === false) {
            throw new SignatureException(
                openssl_error_string() ?: 'Invalid signature'
            );
        }
    }
}
