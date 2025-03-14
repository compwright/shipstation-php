<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Model;

use Compwright\ShipstationPhp\Common\Model\BaseModel;
use Compwright\ShipstationPhp\Common\Model\StringType;

class InsuranceOptions extends BaseModel
{
    public const PROVIDER_SHIPSURANCE = 'shipsurance';
    public const PROVIDER_CARRIER = 'carrier';
    public const PROVIDER_PROVIDER = 'provider';
    public const PROVIDER_XCOVER = 'xcover';
    public const PROVIDER_PARCELGUARD = 'parcelguard';

    /**
     * @var string|self::PROVIDER_* Preferred Insurance provider. The "provider" option is used to indicate that a shipment was insured by a third party other than Shipsurance, XCover, ParcelGuard or the carrier. Billing for "provider" insurance is handled outside of ShipStation, and will not affect the cost of processing the label.
     */
    public string $provider {
        set(string $value) {
            $this->provider = StringType::oneOf(
                __PROPERTY__,
                $value,
                self::PROVIDER_SHIPSURANCE,
                self::PROVIDER_CARRIER,
                self::PROVIDER_PROVIDER,
                self::PROVIDER_XCOVER,
                self::PROVIDER_PARCELGUARD
            );
        }
    }

    /**
     * @var bool Indicates whether shipment should be insured.
     */
    public bool $insureShipment;

    /**
     * @var float Value to insure.
     */
    public float $insuredValue;
}
