<?php

declare(strict_types=1);

namespace AmazonSellingPartner\Model\Orders;

use AmazonSellingPartner\Exception\AssertionException;
use AmazonSellingPartner\ModelInterface;
use AmazonSellingPartner\ObjectSerializer;

/**
 * Selling Partner API for Orders.
 *
 * The Selling Partner API for Orders helps you programmatically retrieve order information. These APIs let you develop fast, flexible, custom applications in areas like order synchronization, order research, and demand-based decision support tools.
 *
 * The version of the OpenAPI document: v0
 *
 * This class was auto-generated by https://openapi-generator.tech
 * Do not change it, it will be overwritten with next execution of /bin/generate.sh
 *
 * @implements \ArrayAccess<TKey, TValue>
 *
 * @template TKey int|null
 * @template TValue mixed|null
 */
class OrderAddress implements \ArrayAccess, \JsonSerializable, \Stringable, ModelInterface
{
    final public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static string $openAPIModelName = 'OrderAddress';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static array $openAPITypes = [
        'amazon_order_id' => 'string',
        'buyer_company_name' => 'string',
        'shipping_address' => '\AmazonSellingPartner\Model\Orders\Address',
        'delivery_preferences' => '\AmazonSellingPartner\Model\Orders\DeliveryPreferences',
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
        'amazon_order_id' => null,
        'buyer_company_name' => null,
        'shipping_address' => null,
        'delivery_preferences' => null,
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name.
     *
     * @var string[]
     */
    protected static array $attributeMap = [
        'amazon_order_id' => 'AmazonOrderId',
        'buyer_company_name' => 'BuyerCompanyName',
        'shipping_address' => 'ShippingAddress',
        'delivery_preferences' => 'DeliveryPreferences',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static array $setters = [
        'amazon_order_id' => 'setAmazonOrderId',
        'buyer_company_name' => 'setBuyerCompanyName',
        'shipping_address' => 'setShippingAddress',
        'delivery_preferences' => 'setDeliveryPreferences',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static array $getters = [
        'amazon_order_id' => 'getAmazonOrderId',
        'buyer_company_name' => 'getBuyerCompanyName',
        'shipping_address' => 'getShippingAddress',
        'delivery_preferences' => 'getDeliveryPreferences',
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
        $this->container['amazon_order_id'] = $data['amazon_order_id'] ?? null;
        $this->container['buyer_company_name'] = $data['buyer_company_name'] ?? null;
        $this->container['shipping_address'] = $data['shipping_address'] ?? null;
        $this->container['delivery_preferences'] = $data['delivery_preferences'] ?? null;
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
     * Validate all properties.
     *
     * @throws AssertionException
     */
    public function validate() : void
    {
        if ($this->container['amazon_order_id'] === null) {
            throw new AssertionException("'amazon_order_id' can't be null");
        }

        if ($this->container['shipping_address'] !== null) {
            $this->container['shipping_address']->validate();
        }

        if ($this->container['delivery_preferences'] !== null) {
            $this->container['delivery_preferences']->validate();
        }
    }

    /**
     * Gets amazon_order_id.
     */
    public function getAmazonOrderId() : string
    {
        return $this->container['amazon_order_id'];
    }

    /**
     * Sets amazon_order_id.
     *
     * @param string $amazon_order_id an Amazon-defined order identifier, in 3-7-7 format
     */
    public function setAmazonOrderId(string $amazon_order_id) : self
    {
        $this->container['amazon_order_id'] = $amazon_order_id;

        return $this;
    }

    /**
     * Gets buyer_company_name.
     */
    public function getBuyerCompanyName() : ?string
    {
        return $this->container['buyer_company_name'];
    }

    /**
     * Sets buyer_company_name.
     *
     * @param null|string $buyer_company_name company name of the destination address
     */
    public function setBuyerCompanyName(?string $buyer_company_name) : self
    {
        $this->container['buyer_company_name'] = $buyer_company_name;

        return $this;
    }

    /**
     * Gets shipping_address.
     */
    public function getShippingAddress() : ?Address
    {
        return $this->container['shipping_address'];
    }

    /**
     * Sets shipping_address.
     *
     * @param null|\AmazonSellingPartner\Model\Orders\Address $shipping_address shipping_address
     */
    public function setShippingAddress(?Address $shipping_address) : self
    {
        $this->container['shipping_address'] = $shipping_address;

        return $this;
    }

    /**
     * Gets delivery_preferences.
     */
    public function getDeliveryPreferences() : ?DeliveryPreferences
    {
        return $this->container['delivery_preferences'];
    }

    /**
     * Sets delivery_preferences.
     *
     * @param null|\AmazonSellingPartner\Model\Orders\DeliveryPreferences $delivery_preferences delivery_preferences
     */
    public function setDeliveryPreferences(?DeliveryPreferences $delivery_preferences) : self
    {
        $this->container['delivery_preferences'] = $delivery_preferences;

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