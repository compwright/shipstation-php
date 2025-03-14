<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Webhook;

use DateTimeImmutable;

class WebhookVerifier
{
    /**
     * @param iterable<array<string, string>> $keys
     */
    public function __invoke(SignedWebhook $request, iterable $keys): void
    {
        // Prevent replay attacks
        $threshold = new DateTimeImmutable('-5 minute UTC');
        if ($request->getUtcDateTime() < $threshold) {
            throw new ExpiredWebhookException('Request expired');
        }

        // Find the public key
        $pem = $this->lookupPublicKey(
            $request->getPublicKeyId(),
            $keys
        );
        $key = openssl_pkey_get_public($pem);
        if ($key === false) {
            throw new SignatureException(
                'Error loading public key: ' . openssl_error_string()
            );
        }

        // Check the signature
        $ok = openssl_verify(
            $request->getDataToSign(),
            $request->getSignature(),
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

    /**
     * @param iterable<array<string, string>> $keys
     */
    private function lookupPublicKey(string $keyId, iterable $keys): string
    {
        $lookup = array_reduce(
            iterator_to_array($keys),
            function (array $keys, array $key) {
                $keys[$key['kid']] = implode("\n", explode("\\n", $key['pem'] ?? ''));
                return $keys;
            },
            []
        );

        return $lookup[$keyId] ?? '';
    }
}
