<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Model;

use Compwright\ShipstationPhp\Common\Model\BaseModel;

class OrderItem extends BaseModel
{
    /**
     * @var int orderItemId	number	The system-generated identifier for the OrderItem. Read-Only field.
     */
    public int $orderItemId;

    /**
     * @var string An identifier for the OrderItem in the originating system.
     */
    public string $lineItemKey;

    /**
     * @var string The SKU (stock keeping unit) identifier for the product associated with this line item.
     */
    public string $sku;

    /**
     * @var string The name of the product associated with this line item.
     */
    public string $name;

    /**
     * @var string The public URL to the product image.
     */
    public string $imageUrl;

    /**
     * @var Weight|array<string, mixed> The weight of a single item.
     */
    public $weight {
        set($value) {
            $this->weight = Weight::create($value);
        }
    }

    /**
     * @var int The quantity of the product ordered.
     */
    public int $quantity;

    /**
     * @var float The sell price of a single item specified by the order source.
     */
    public float $unitPrice;

    /**
     * @var float The tax price of a single item specified by the order source.
     */
    public float $taxAmount;

    /**
     * @var float The shipping amount or price of a single item specified by the order source.
     */
    public float $shippingAmount;

    /**
     * @var string The location of the product within the seller's warehouse (e.g. Aisle 3, Shelf A, Bin 5)
     */
    public string $warehouseLocation;

    /**
     * @var array<ItemOption|array<string, mixed>>
     */
    public array $options {
        set(array $input) {
            $this->options = ItemOption::createList($input);
        }
    }

    /**
     * @var int The identifier for the PRoduct Rsource associated with this OrderItem.
     */
    public int $productId;

    /**
     * @var string The fulfillment SKU associated with this OrderItem if the fulfillment provider requires an
     * identifier other than the SKU.
     */
    public string $fulfillmentSku;

    /**
     * @var bool Indicates that the OrderItem is a non-physical adjustment to the order
     * (e.g. a discount or promotional code).
     */
    public bool $adjustment = false;

    /**
     * @var string UPC associated with this OrderItem.
     */
    public string $upc;

    /**
     * @var string The timestamp the orderItem was created in ShipStation's database. Read-Only field.
     */
    public string $createDate;

    /**
     * @var string The timestamp the orderItem was modified in ShipStation. modifyDate will equal createDate until a modification is made. Read-Only field.
     */
    public string $modifyDate;
}
