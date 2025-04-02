<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Model;

use Compwright\EasyApi\Type\DateType;
use Compwright\EasyApi\Type\StringType;
use Compwright\ShipstationPhp\Common\Model\BaseModel;

class Label extends BaseModel
{
    public const CONFIRMATION_NONE = 'none';
    public const CONFIRMATION_DELIVERY = 'delivery';
    public const CONFIRMATION_SIGNATURE = 'signature';
    public const CONFIRMATION_SIGNATURE_ADULT = 'adult_signature';
    public const CONFIRMATION_SIGNATURE_DIRECT = 'direct_signature';

    /**
     * @var string Identifies the carrier to be used for this label.
     */
    public string $carrierCode;

    /**
     * @var string Identifies the shipping service to be used for this label.
     */
    public string $serviceCode;

    /**
     * @var string Identifies the packing type that should be used for this label.
     */
    public string $packageCode;

    /**
     * @var string|self::CONFIRMATION_* The type of delivery confirmation that is to be used once the shipment is created.
     */
    public string $confirmation {
        set(string $confirmation) {
            $this->confirmation = StringType::oneOf(
                __PROPERTY__,
                $confirmation,
                self::CONFIRMATION_NONE,
                self::CONFIRMATION_DELIVERY,
                self::CONFIRMATION_SIGNATURE,
                self::CONFIRMATION_SIGNATURE_ADULT,
                self::CONFIRMATION_SIGNATURE_DIRECT
            );
        }
    }

    /**
     * @var string The date the order was shipped.
     */
    public $shipDate {
        set($value) {
            $this->shipDate = DateType::create($value)->format('Y-m-d');
        }
    }

    /**
     * @var Weight|array<string, mixed> Weight of the order.
     */
    public $weight {
        set($value) {
            $this->weight = Weight::create($value);
        }
    }

    /**
     * @var Dimensions|array<string, mixed> Dimensions of the order.
     */
    public $dimensions {
        set($value) {
            $this->dimensions = Dimensions::create($value);
        }
    }

    /**
     * @var Address|array<string, mixed> Address indicating shipment's origin.
     */
    public $shipFrom {
        set($value) {
            $this->shipFrom = Address::create($value);
        }
    }

    /**
     * @var Address|array<string, mixed> Address indicating shipment's destination.
     */
    public $shipTo {
        set($value) {
            $this->shipTo = Address::create($value);
        }
    }

    /**
     * @var InsuranceOptions|array<string, mixed> The shipping insurance information associated with this order.
     */
    public $insuranceOptions {
        set($value) {
            $this->insuranceOptions = InsuranceOptions::create($value);
        }
    }

    /**
     * @var InternationalOptions|array<string, mixed> Customs information that can be used to generate customs documents for international orders.
     */
    public $internationalOptions {
        set($value) {
            $this->internationalOptions = InternationalOptions::create($value);
        }
    }

    /**
     * @var AdvancedOptions|array<string, mixed> Various advanced options that may be available depending on the shipping carrier
     * that is used to ship the order.
     */
    public $advancedOptions {
        set($value) {
            $this->advancedOptions = AdvancedOptions::create($value);
        }
    }

    /**
     * @var bool Specifies whether a test label should be created.
     */
    public bool $testLabel;
}
