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
class AutomatedShippingSettings implements \ArrayAccess, \JsonSerializable, \Stringable, ModelInterface
{
    final public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static string $openAPIModelName = 'AutomatedShippingSettings';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static array $openAPITypes = [
        'has_automated_shipping_settings' => 'bool',
        'automated_carrier' => 'string',
        'automated_ship_method' => 'string',
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
        'has_automated_shipping_settings' => null,
        'automated_carrier' => null,
        'automated_ship_method' => null,
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name.
     *
     * @var string[]
     */
    protected static array $attributeMap = [
        'has_automated_shipping_settings' => 'HasAutomatedShippingSettings',
        'automated_carrier' => 'AutomatedCarrier',
        'automated_ship_method' => 'AutomatedShipMethod',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static array $setters = [
        'has_automated_shipping_settings' => 'setHasAutomatedShippingSettings',
        'automated_carrier' => 'setAutomatedCarrier',
        'automated_ship_method' => 'setAutomatedShipMethod',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static array $getters = [
        'has_automated_shipping_settings' => 'getHasAutomatedShippingSettings',
        'automated_carrier' => 'getAutomatedCarrier',
        'automated_ship_method' => 'getAutomatedShipMethod',
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
        $this->container['has_automated_shipping_settings'] = $data['has_automated_shipping_settings'] ?? null;
        $this->container['automated_carrier'] = $data['automated_carrier'] ?? null;
        $this->container['automated_ship_method'] = $data['automated_ship_method'] ?? null;
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
    }

    /**
     * Gets has_automated_shipping_settings.
     */
    public function getHasAutomatedShippingSettings() : ?bool
    {
        return $this->container['has_automated_shipping_settings'];
    }

    /**
     * Sets has_automated_shipping_settings.
     *
     * @param null|bool $has_automated_shipping_settings When true, this order has automated shipping settings generated by Amazon. This order could be identified as an SSA order.
     */
    public function setHasAutomatedShippingSettings(?bool $has_automated_shipping_settings) : self
    {
        $this->container['has_automated_shipping_settings'] = $has_automated_shipping_settings;

        return $this;
    }

    /**
     * Gets automated_carrier.
     */
    public function getAutomatedCarrier() : ?string
    {
        return $this->container['automated_carrier'];
    }

    /**
     * Sets automated_carrier.
     *
     * @param null|string $automated_carrier auto-generated carrier for SSA orders
     */
    public function setAutomatedCarrier(?string $automated_carrier) : self
    {
        $this->container['automated_carrier'] = $automated_carrier;

        return $this;
    }

    /**
     * Gets automated_ship_method.
     */
    public function getAutomatedShipMethod() : ?string
    {
        return $this->container['automated_ship_method'];
    }

    /**
     * Sets automated_ship_method.
     *
     * @param null|string $automated_ship_method auto-generated ship method for SSA orders
     */
    public function setAutomatedShipMethod(?string $automated_ship_method) : self
    {
        $this->container['automated_ship_method'] = $automated_ship_method;

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
