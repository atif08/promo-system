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
class ItemApprovalAction implements \ArrayAccess, \JsonSerializable, \Stringable, ModelInterface
{
    final public const DISCRIMINATOR = null;

    final public const ACTION_TYPE_APPROVE = 'APPROVE';

    final public const ACTION_TYPE_DECLINE = 'DECLINE';

    final public const ACTION_TYPE_APPROVE_WITH_CHANGES = 'APPROVE_WITH_CHANGES';

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static string $openAPIModelName = 'ItemApprovalAction';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static array $openAPITypes = [
        'action_type' => 'string',
        'comment' => 'string',
        'changes' => '\AmazonSellingPartner\Model\Orders\ItemApprovalActionChanges',
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
        'action_type' => null,
        'comment' => null,
        'changes' => null,
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name.
     *
     * @var string[]
     */
    protected static array $attributeMap = [
        'action_type' => 'ActionType',
        'comment' => 'Comment',
        'changes' => 'Changes',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static array $setters = [
        'action_type' => 'setActionType',
        'comment' => 'setComment',
        'changes' => 'setChanges',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static array $getters = [
        'action_type' => 'getActionType',
        'comment' => 'getComment',
        'changes' => 'getChanges',
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
        $this->container['action_type'] = $data['action_type'] ?? null;
        $this->container['comment'] = $data['comment'] ?? null;
        $this->container['changes'] = $data['changes'] ?? null;
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
    public function getActionTypeAllowableValues() : array
    {
        return [
            self::ACTION_TYPE_APPROVE,
            self::ACTION_TYPE_DECLINE,
            self::ACTION_TYPE_APPROVE_WITH_CHANGES,
        ];
    }

    /**
     * Validate all properties.
     *
     * @throws AssertionException
     */
    public function validate() : void
    {
        if ($this->container['action_type'] === null) {
            throw new AssertionException("'action_type' can't be null");
        }

        $allowedValues = $this->getActionTypeAllowableValues();

        if (null !== $this->container['action_type'] && !\in_array($this->container['action_type'], $allowedValues, true)) {
            throw new AssertionException(
                \sprintf(
                    "invalid value '%s' for 'action_type', must be one of '%s'",
                    $this->container['action_type'],
                    \implode("', '", $allowedValues)
                )
            );
        }

        if ($this->container['changes'] !== null) {
            $this->container['changes']->validate();
        }
    }

    /**
     * Gets action_type.
     */
    public function getActionType() : string
    {
        return $this->container['action_type'];
    }

    /**
     * Sets action_type.
     *
     * @param string $action_type defines the type of action for the approval
     */
    public function setActionType(string $action_type) : self
    {
        $this->container['action_type'] = $action_type;

        return $this;
    }

    /**
     * Gets comment.
     */
    public function getComment() : ?string
    {
        return $this->container['comment'];
    }

    /**
     * Sets comment.
     *
     * @param null|string $comment comment message to provide optional additional context on the approval action
     */
    public function setComment(?string $comment) : self
    {
        $this->container['comment'] = $comment;

        return $this;
    }

    /**
     * Gets changes.
     */
    public function getChanges() : ?ItemApprovalActionChanges
    {
        return $this->container['changes'];
    }

    /**
     * Sets changes.
     *
     * @param null|\AmazonSellingPartner\Model\Orders\ItemApprovalActionChanges $changes changes
     */
    public function setChanges(?ItemApprovalActionChanges $changes) : self
    {
        $this->container['changes'] = $changes;

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
