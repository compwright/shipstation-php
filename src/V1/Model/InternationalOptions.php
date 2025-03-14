<?php
declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Model;

use Compwright\ShipstationPhp\Common\Model\BaseModel;
use Compwright\ShipstationPhp\Common\Model\ListType;
use Compwright\ShipstationPhp\Common\Model\StringType;

class InternationalOptions extends BaseModel
{
    public const CONTENTS_MERCHANDISE = 'merchandise';
    public const CONTENTS_DOCUMENT = 'documents';
    public const CONTENTS_GIFT = 'gift';
    public const CONTENTS_RETURN = 'returned_goods';
    public const CONTENTS_SAMPLE = 'sample';

    public const NONDELIVERY_RETURN = 'return_to_sender';
    public const NONDELIVERY_ABANDON = 'treat_as_abandoned';

    /**
     * @var string|self::CONTENTS_* Contents of international shipment.
     */
    public string $contents {
        set (string $value) {
            $this->contents = StringType::oneOf(
                __PROPERTY__,
                $value,
                self::CONTENTS_MERCHANDISE,
                self::CONTENTS_DOCUMENT,
                self::CONTENTS_GIFT,
                self::CONTENTS_RETURN,
                self::CONTENTS_SAMPLE
            );
        }
    }

    /**
     * @var array<CustomsItem|array<string, mixed>> An array of customs items. Please note: If you wish to supply customsItems in the CreateOrder
     * call and have the values not be overwritten by ShipStation, you must have the International Settings
     * Customs Declarations set to "Leave blank (Enter Manually)" in the UI:
     * https://ss.shipstation.com/#/settings/international
     */
    public array $customsItems {
        set (array $values) {
            $this->customsItems = CustomsItem::createList($values);
        }
    }

    /**
     * @var string|self::NONDELIVERY_* Non-Delivery option for international shipment. Please note: If the shipment is created
     * through the Orders/CreateLabelForOrder endpoint and the nonDelivery field is not
     * specified then value defaults based on the International Setting in the UI.
     *  If the call is being made to the Shipments/CreateLabel endpoint and
     * the nonDelivery field is not specified then the value will default
     * to "return_to_sender"
     */
    public string $nonDelivery {
        set (string $value) {
            $this->contents = StringType::oneOf(
                __PROPERTY__,
                $value,
                self::NONDELIVERY_RETURN,
                self::NONDELIVERY_ABANDON
            );
        }
    }
}
