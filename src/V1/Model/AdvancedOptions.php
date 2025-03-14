<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Model;

use Compwright\ShipstationPhp\Common\Model\BaseModel;
use Compwright\ShipstationPhp\Common\Model\StringType;

class AdvancedOptions extends BaseModel
{
    public const BILL_MY_ACCOUNT = 'my_account';
    public const BILL_MY_OTHER_ACCOUNT = 'my_other_account';
    public const BILL_RECIPIENT = 'recipient';
    public const BILL_THIRD_PARTY = 'third_party';

    /**
     * @var int Specifies the warehouse where to the order is to ship from.
     * If the order was fulfilled using a fill provider, no warehouse is
     * attached to these orders and will result in a null value return.
     */
    public int $warehouseId;

    /**
     * @var bool Specifies whether the order is non-machinable.
     */
    public bool $nonMachinable;

    /**
     * @var bool Specifies whether the order is to be delivered on a Saturday.
     */
    public bool $saturdayDelivery;

    /**
     * @var bool Specifies whether the order contains alcohol.
     */
    public bool $containsAlcohol;

    /**
     * @var int ID of store that is associated with the order. If not specified in
     * the CreateOrder call either to create or update an order, ShipStation
     * will default to the first manual store on the account.
     */
    public int $storeId;

    /**
     * @var string Field that allows for custom data to be associated with an order. *Please see note below
     */
    public string $customField1;

    /**
     * @var string Field that allows for custom data to be associated with an order. *Please see note below
     */
    public string $customField2;

    /**
     * @var string Field that allows for custom data to be associated with an order. *Please see note below
     */
    public string $customField3;

    /**
     * @var string Identifies the original source/marketplace of the order. *Please see note below
     */
    public string $source;

    /**
     * @var bool Returns whether or not an order has been merged or split with another order. Read-Only
     */
    public bool $mergedOrSplit;

    /**
     * @var int[] Array of orderIds. Each orderId identifies an order that was merged with the associated order. Read-Only
     */
    public array $mergedIds;

    /**
     * @var int If an order has been split, it will return the Parent ID of the order with which it has been split. If the order has not been split, this field will return null. Read-Only
     */
    public int $parentId;

    /**
     * @var string|self::BILL_* Identifies which party to bill.
     */
    public string $billToParty {
        set (string $value) {
            $this->billToParty = StringType::oneOf(
                __PROPERTY__,
                $value,
                self::BILL_MY_ACCOUNT,
                self::BILL_MY_OTHER_ACCOUNT,
                self::BILL_RECIPIENT,
                self::BILL_THIRD_PARTY
            );
        }
    }

    /**
     * @var string Account number of billToParty.
     */
    public string $billToAccount;

    /**
     * @var string Postal Code of billToParty.
     */
    public string $billToPostalCode;

    /**
     * @var string Country Code of billToParty.
     */
    public string $billToCountryCode;

    /**
     * @var string When using my_other_account as the billToParty value, the shippingProviderId value that is associated with the desired account. Make a List Carriers call to obtain shippingProviderId values.
     */
    public string $billToMyOtherAccount;
}
