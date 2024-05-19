<?php

declare(strict_types=1);

namespace AmazonSellingPartner\Model\CatalogItem;

use AmazonSellingPartner\Exception\AssertionException;
use AmazonSellingPartner\ModelInterface;
use AmazonSellingPartner\ObjectSerializer;

/**
 * Selling Partner API for Catalog Items.
 *
 * The Selling Partner API for Catalog Items provides programmatic access to information about items in the Amazon catalog.  For more information, refer to the [Catalog Items API Use Case Guide](doc:catalog-items-api-v2022-04-01-use-case-guide).
 *
 * The version of the OpenAPI document: 2022-04-01
 *
 * This class was auto-generated by https://openapi-generator.tech
 * Do not change it, it will be overwritten with next execution of /bin/generate.sh
 *
 * @implements \ArrayAccess<TKey, TValue>
 *
 * @template TKey int|null
 * @template TValue mixed|null
 */
class ItemSummaryByMarketplace implements \ArrayAccess, \JsonSerializable, \Stringable, ModelInterface
{
    final public const DISCRIMINATOR = null;

    final public const ITEM_CLASSIFICATION_BASE_PRODUCT = 'BASE_PRODUCT';

    final public const ITEM_CLASSIFICATION_OTHER = 'OTHER';

    final public const ITEM_CLASSIFICATION_PRODUCT_BUNDLE = 'PRODUCT_BUNDLE';

    final public const ITEM_CLASSIFICATION_VARIATION_PARENT = 'VARIATION_PARENT';

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static string $openAPIModelName = 'ItemSummaryByMarketplace';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static array $openAPITypes = [
        'marketplace_id' => 'string',
        'adult_product' => 'bool',
        'autographed' => 'bool',
        'brand' => 'string',
        'browse_classification' => '\AmazonSellingPartner\Model\CatalogItem\ItemBrowseClassification',
        'color' => 'string',
        'contributors' => '\AmazonSellingPartner\Model\CatalogItem\ItemContributor[]',
        'item_classification' => 'string',
        'item_name' => 'string',
        'manufacturer' => 'string',
        'memorabilia' => 'bool',
        'model_number' => 'string',
        'package_quantity' => 'int',
        'part_number' => 'string',
        'release_date' => '\DateTimeInterface',
        'size' => 'string',
        'style' => 'string',
        'trade_in_eligible' => 'bool',
        'website_display_group' => 'string',
        'website_display_group_name' => 'string',
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization.
     *
     * @var string[]
     *
     * @phpstan-var array<string, string|null>
     *
     * @psalm-var array<string, string|null>
     */
    protected static array $openAPIFormats = [
        'marketplace_id' => null,
        'adult_product' => null,
        'autographed' => null,
        'brand' => null,
        'browse_classification' => null,
        'color' => null,
        'contributors' => null,
        'item_classification' => null,
        'item_name' => null,
        'manufacturer' => null,
        'memorabilia' => null,
        'model_number' => null,
        'package_quantity' => null,
        'part_number' => null,
        'release_date' => 'date',
        'size' => null,
        'style' => null,
        'trade_in_eligible' => null,
        'website_display_group' => null,
        'website_display_group_name' => null,
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name.
     *
     * @var string[]
     */
    protected static array $attributeMap = [
        'marketplace_id' => 'marketplaceId',
        'adult_product' => 'adultProduct',
        'autographed' => 'autographed',
        'brand' => 'brand',
        'browse_classification' => 'browseClassification',
        'color' => 'color',
        'contributors' => 'contributors',
        'item_classification' => 'itemClassification',
        'item_name' => 'itemName',
        'manufacturer' => 'manufacturer',
        'memorabilia' => 'memorabilia',
        'model_number' => 'modelNumber',
        'package_quantity' => 'packageQuantity',
        'part_number' => 'partNumber',
        'release_date' => 'releaseDate',
        'size' => 'size',
        'style' => 'style',
        'trade_in_eligible' => 'tradeInEligible',
        'website_display_group' => 'websiteDisplayGroup',
        'website_display_group_name' => 'websiteDisplayGroupName',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static array $setters = [
        'marketplace_id' => 'setMarketplaceId',
        'adult_product' => 'setAdultProduct',
        'autographed' => 'setAutographed',
        'brand' => 'setBrand',
        'browse_classification' => 'setBrowseClassification',
        'color' => 'setColor',
        'contributors' => 'setContributors',
        'item_classification' => 'setItemClassification',
        'item_name' => 'setItemName',
        'manufacturer' => 'setManufacturer',
        'memorabilia' => 'setMemorabilia',
        'model_number' => 'setModelNumber',
        'package_quantity' => 'setPackageQuantity',
        'part_number' => 'setPartNumber',
        'release_date' => 'setReleaseDate',
        'size' => 'setSize',
        'style' => 'setStyle',
        'trade_in_eligible' => 'setTradeInEligible',
        'website_display_group' => 'setWebsiteDisplayGroup',
        'website_display_group_name' => 'setWebsiteDisplayGroupName',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static array $getters = [
        'marketplace_id' => 'getMarketplaceId',
        'adult_product' => 'getAdultProduct',
        'autographed' => 'getAutographed',
        'brand' => 'getBrand',
        'browse_classification' => 'getBrowseClassification',
        'color' => 'getColor',
        'contributors' => 'getContributors',
        'item_classification' => 'getItemClassification',
        'item_name' => 'getItemName',
        'manufacturer' => 'getManufacturer',
        'memorabilia' => 'getMemorabilia',
        'model_number' => 'getModelNumber',
        'package_quantity' => 'getPackageQuantity',
        'part_number' => 'getPartNumber',
        'release_date' => 'getReleaseDate',
        'size' => 'getSize',
        'style' => 'getStyle',
        'trade_in_eligible' => 'getTradeInEligible',
        'website_display_group' => 'getWebsiteDisplayGroup',
        'website_display_group_name' => 'getWebsiteDisplayGroupName',
    ];

    /**
     * Associative array for storing property values.
     *
     * @var mixed[]
     */
    protected array $container = [];

    /**
     * Constructor.
     *
     * @param null|mixed[] $data Associated array of property values
     *                           initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['marketplace_id'] = $data['marketplace_id'] ?? null;
        $this->container['adult_product'] = $data['adult_product'] ?? null;
        $this->container['autographed'] = $data['autographed'] ?? null;
        $this->container['brand'] = $data['brand'] ?? null;
        $this->container['browse_classification'] = $data['browse_classification'] ?? null;
        $this->container['color'] = $data['color'] ?? null;
        $this->container['contributors'] = $data['contributors'] ?? null;
        $this->container['item_classification'] = $data['item_classification'] ?? null;
        $this->container['item_name'] = $data['item_name'] ?? null;
        $this->container['manufacturer'] = $data['manufacturer'] ?? null;
        $this->container['memorabilia'] = $data['memorabilia'] ?? null;
        $this->container['model_number'] = $data['model_number'] ?? null;
        $this->container['package_quantity'] = $data['package_quantity'] ?? null;
        $this->container['part_number'] = $data['part_number'] ?? null;
        $this->container['release_date'] = $data['release_date'] ?? null;
        $this->container['size'] = $data['size'] ?? null;
        $this->container['style'] = $data['style'] ?? null;
        $this->container['trade_in_eligible'] = $data['trade_in_eligible'] ?? null;
        $this->container['website_display_group'] = $data['website_display_group'] ?? null;
        $this->container['website_display_group_name'] = $data['website_display_group_name'] ?? null;
    }

    /**
     * Array of property to type mappings. Used for (de)serialization.
     */
    public static function openAPITypes() : array
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization.
     */
    public static function openAPIFormats() : array
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name.
     */
    public static function attributeMap() : array
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     */
    public static function setters() : array
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests).
     */
    public static function getters() : array
    {
        return self::$getters;
    }

    /**
     * Gets the string presentation of the object.
     */
    public function __toString() : string
    {
        return (string) \json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * The original name of the model.
     */
    public function getModelName() : string
    {
        return self::$openAPIModelName;
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getItemClassificationAllowableValues() : array
    {
        return [
            self::ITEM_CLASSIFICATION_BASE_PRODUCT,
            self::ITEM_CLASSIFICATION_OTHER,
            self::ITEM_CLASSIFICATION_PRODUCT_BUNDLE,
            self::ITEM_CLASSIFICATION_VARIATION_PARENT,
        ];
    }

    /**
     * Validate all properties.
     *
     * @throws AssertionException
     */
    public function validate() : void
    {
        if ($this->container['marketplace_id'] === null) {
            throw new AssertionException("'marketplace_id' can't be null");
        }

        if ($this->container['browse_classification'] !== null) {
            $this->container['browse_classification']->validate();
        }

        $allowedValues = $this->getItemClassificationAllowableValues();

        if (null !== $this->container['item_classification'] && !\in_array($this->container['item_classification'], $allowedValues, true)) {
            throw new AssertionException(
                \sprintf(
                    "invalid value '%s' for 'item_classification', must be one of '%s'",
                    $this->container['item_classification'],
                    \implode("', '", $allowedValues)
                )
            );
        }
    }

    /**
     * Gets marketplace_id.
     */
    public function getMarketplaceId() : string
    {
        return $this->container['marketplace_id'];
    }

    /**
     * Sets marketplace_id.
     *
     * @param string $marketplace_id amazon marketplace identifier
     */
    public function setMarketplaceId(string $marketplace_id) : self
    {
        $this->container['marketplace_id'] = $marketplace_id;

        return $this;
    }

    /**
     * Gets adult_product.
     */
    public function getAdultProduct() : ?bool
    {
        return $this->container['adult_product'];
    }

    /**
     * Sets adult_product.
     *
     * @param null|bool $adult_product identifies an Amazon catalog item is intended for an adult audience or is sexual in nature
     */
    public function setAdultProduct(?bool $adult_product) : self
    {
        $this->container['adult_product'] = $adult_product;

        return $this;
    }

    /**
     * Gets autographed.
     */
    public function getAutographed() : ?bool
    {
        return $this->container['autographed'];
    }

    /**
     * Sets autographed.
     *
     * @param null|bool $autographed identifies an Amazon catalog item is autographed by a player or celebrity
     */
    public function setAutographed(?bool $autographed) : self
    {
        $this->container['autographed'] = $autographed;

        return $this;
    }

    /**
     * Gets brand.
     */
    public function getBrand() : ?string
    {
        return $this->container['brand'];
    }

    /**
     * Sets brand.
     *
     * @param null|string $brand name of the brand associated with an Amazon catalog item
     */
    public function setBrand(?string $brand) : self
    {
        $this->container['brand'] = $brand;

        return $this;
    }

    /**
     * Gets browse_classification.
     */
    public function getBrowseClassification() : ?ItemBrowseClassification
    {
        return $this->container['browse_classification'];
    }

    /**
     * Sets browse_classification.
     *
     * @param null|\AmazonSellingPartner\Model\CatalogItem\ItemBrowseClassification $browse_classification browse_classification
     */
    public function setBrowseClassification(?ItemBrowseClassification $browse_classification) : self
    {
        $this->container['browse_classification'] = $browse_classification;

        return $this;
    }

    /**
     * Gets color.
     */
    public function getColor() : ?string
    {
        return $this->container['color'];
    }

    /**
     * Sets color.
     *
     * @param null|string $color name of the color associated with an Amazon catalog item
     */
    public function setColor(?string $color) : self
    {
        $this->container['color'] = $color;

        return $this;
    }

    /**
     * Gets contributors.
     *
     * @return null|\AmazonSellingPartner\Model\CatalogItem\ItemContributor[]
     */
    public function getContributors() : ?array
    {
        return $this->container['contributors'];
    }

    /**
     * Sets contributors.
     *
     * @param null|\AmazonSellingPartner\Model\CatalogItem\ItemContributor[] $contributors individual contributors to the creation of an item, such as the authors or actors
     */
    public function setContributors(?array $contributors) : self
    {
        $this->container['contributors'] = $contributors;

        return $this;
    }

    /**
     * Gets item_classification.
     */
    public function getItemClassification() : ?string
    {
        return $this->container['item_classification'];
    }

    /**
     * Sets item_classification.
     *
     * @param null|string $item_classification classification type associated with the Amazon catalog item
     */
    public function setItemClassification(?string $item_classification) : self
    {
        $this->container['item_classification'] = $item_classification;

        return $this;
    }

    /**
     * Gets item_name.
     */
    public function getItemName() : ?string
    {
        return $this->container['item_name'];
    }

    /**
     * Sets item_name.
     *
     * @param null|string $item_name name, or title, associated with an Amazon catalog item
     */
    public function setItemName(?string $item_name) : self
    {
        $this->container['item_name'] = $item_name;

        return $this;
    }

    /**
     * Gets manufacturer.
     */
    public function getManufacturer() : ?string
    {
        return $this->container['manufacturer'];
    }

    /**
     * Sets manufacturer.
     *
     * @param null|string $manufacturer name of the manufacturer associated with an Amazon catalog item
     */
    public function setManufacturer(?string $manufacturer) : self
    {
        $this->container['manufacturer'] = $manufacturer;

        return $this;
    }

    /**
     * Gets memorabilia.
     */
    public function getMemorabilia() : ?bool
    {
        return $this->container['memorabilia'];
    }

    /**
     * Sets memorabilia.
     *
     * @param null|bool $memorabilia identifies an Amazon catalog item is memorabilia valued for its connection with historical events, culture, or entertainment
     */
    public function setMemorabilia(?bool $memorabilia) : self
    {
        $this->container['memorabilia'] = $memorabilia;

        return $this;
    }

    /**
     * Gets model_number.
     */
    public function getModelNumber() : ?string
    {
        return $this->container['model_number'];
    }

    /**
     * Sets model_number.
     *
     * @param null|string $model_number model number associated with an Amazon catalog item
     */
    public function setModelNumber(?string $model_number) : self
    {
        $this->container['model_number'] = $model_number;

        return $this;
    }

    /**
     * Gets package_quantity.
     */
    public function getPackageQuantity() : ?int
    {
        return $this->container['package_quantity'];
    }

    /**
     * Sets package_quantity.
     *
     * @param null|int $package_quantity quantity of an Amazon catalog item in one package
     */
    public function setPackageQuantity(?int $package_quantity) : self
    {
        $this->container['package_quantity'] = $package_quantity;

        return $this;
    }

    /**
     * Gets part_number.
     */
    public function getPartNumber() : ?string
    {
        return $this->container['part_number'];
    }

    /**
     * Sets part_number.
     *
     * @param null|string $part_number part number associated with an Amazon catalog item
     */
    public function setPartNumber(?string $part_number) : self
    {
        $this->container['part_number'] = $part_number;

        return $this;
    }

    /**
     * Gets release_date.
     */
    public function getReleaseDate() : ?\DateTimeInterface
    {
        return $this->container['release_date'];
    }

    /**
     * Sets release_date.
     *
     * @param null|\DateTimeInterface $release_date first date on which an Amazon catalog item is shippable to customers
     */
    public function setReleaseDate(?\DateTimeInterface $release_date) : self
    {
        $this->container['release_date'] = $release_date;

        return $this;
    }

    /**
     * Gets size.
     */
    public function getSize() : ?string
    {
        return $this->container['size'];
    }

    /**
     * Sets size.
     *
     * @param null|string $size name of the size associated with an Amazon catalog item
     */
    public function setSize(?string $size) : self
    {
        $this->container['size'] = $size;

        return $this;
    }

    /**
     * Gets style.
     */
    public function getStyle() : ?string
    {
        return $this->container['style'];
    }

    /**
     * Sets style.
     *
     * @param null|string $style name of the style associated with an Amazon catalog item
     */
    public function setStyle(?string $style) : self
    {
        $this->container['style'] = $style;

        return $this;
    }

    /**
     * Gets trade_in_eligible.
     */
    public function getTradeInEligible() : ?bool
    {
        return $this->container['trade_in_eligible'];
    }

    /**
     * Sets trade_in_eligible.
     *
     * @param null|bool $trade_in_eligible identifies an Amazon catalog item is eligible for trade-in
     */
    public function setTradeInEligible(?bool $trade_in_eligible) : self
    {
        $this->container['trade_in_eligible'] = $trade_in_eligible;

        return $this;
    }

    /**
     * Gets website_display_group.
     */
    public function getWebsiteDisplayGroup() : ?string
    {
        return $this->container['website_display_group'];
    }

    /**
     * Sets website_display_group.
     *
     * @param null|string $website_display_group identifier of the website display group associated with an Amazon catalog item
     */
    public function setWebsiteDisplayGroup(?string $website_display_group) : self
    {
        $this->container['website_display_group'] = $website_display_group;

        return $this;
    }

    /**
     * Gets website_display_group_name.
     */
    public function getWebsiteDisplayGroupName() : ?string
    {
        return $this->container['website_display_group_name'];
    }

    /**
     * Sets website_display_group_name.
     *
     * @param null|string $website_display_group_name display name of the website display group associated with an Amazon catalog item
     */
    public function setWebsiteDisplayGroupName(?string $website_display_group_name) : self
    {
        $this->container['website_display_group_name'] = $website_display_group_name;

        return $this;
    }

    /**
     * Returns true if offset exists. False otherwise.
     */
    public function offsetExists($offset) : bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @return null|mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset) : mixed
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     */
    public function offsetSet($offset, $value) : void
    {
        if (null === $offset) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     */
    public function offsetUnset($offset) : void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     *
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed returns data which can be serialized by json_encode(), which is a value
     *               of any type other than a resource
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize() : string
    {
        return \json_encode(ObjectSerializer::sanitizeForSerialization($this), JSON_THROW_ON_ERROR);
    }

    /**
     * Gets a header-safe presentation of the object.
     */
    public function toHeaderValue() : string
    {
        return \json_encode(ObjectSerializer::sanitizeForSerialization($this), JSON_THROW_ON_ERROR);
    }
}