<?php

declare(strict_types = 1);

namespace Compwright\ShipstationPhp\Model;

use JsonSerializable;

class ShipstationObject implements \ArrayAccess, \Countable, \JsonSerializable
{
    /** @var array<string, mixed> */
    protected array $_values;

    // Standard accessor magic methods
    public function __set($k, $v)
    {
        $this->_values[$k] = self::convertToObject($v);
    }

    /**
     * @param mixed $k
     *
     * @return bool
     */
    public function __isset($k)
    {
        return isset($this->_values[$k]);
    }

    public function __unset($k)
    {
        unset($this->_values[$k]);
    }

    public function &__get($k)
    {
        // function should return a reference, using $nullval to return a reference to null
        $nullval = null;
        if (!empty($this->_values) && \array_key_exists($k, $this->_values)) {
            return $this->_values[$k];
        }
        return $nullval;
    }

    // ArrayAccess methods

    /**
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($k, $v)
    {
        $this->__set($k, $v);
    }

    /**
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($k)
    {
        return \array_key_exists($k, $this->_values);
    }

    /**
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($k)
    {
        unset($this->{$k});
    }

    /**
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($k)
    {
        return \array_key_exists($k, $this->_values) ? $this->_values[$k] : null;
    }

    /**
     * @return int
     */
    #[\ReturnTypeWillChange]
    public function count()
    {
        return \count($this->_values);
    }

    /**
     * This unfortunately needs to be public to be used in Util\Util.
     *
     * @param array $values
     *
     * @return static the object constructed from the given values
     */
    public static function fromArray($values)
    {
        $obj = new static(isset($values['id']) ? $values['id'] : null);
        $obj->loadValues($values, false);
        return $obj;
    }

    /**
     * Refreshes this object using the provided values.
     *
     * @param array $values
     */
    public function loadValues($values, bool $partial = false)
    {
        if ($values instanceof ShipstationObject) {
            $values = $values->toArray();
        }

        // Wipe old state before setting new.  This is useful for e.g. updating a
        // customer, where there is no persistent card parameter.  Mark those values
        // which don't persist as transient
        if ($partial) {
            $removed = [];
        } else {
            $removed = \array_diff(\array_keys($this->_values), \array_keys($values));
        }

        foreach ($removed as $k) {
            unset($this->{$k});
        }

        foreach ($values as $k => $v) {
            $this->_values[$k] = self::convertToObject($v);
        }
    }

    /**
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Returns an associative array with the key and values composing the
     * Stripe object.
     *
     * @return array the associative array
     */
    public function toArray(): array
    {
        $maybeToArray = function ($value) {
            if (null === $value) {
                return null;
            }

            return \is_object($value) && \method_exists($value, 'toArray') ? $value->toArray() : $value;
        };

        return \array_reduce(\array_keys($this->_values), function ($acc, $k) use ($maybeToArray) {
            if ('_' === \substr((string) $k, 0, 1)) {
                return $acc;
            }
            $v = $this->_values[$k];
            if (self::isList($v)) {
                $acc[$k] = \array_map($maybeToArray, $v);
            } else {
                $acc[$k] = $maybeToArray($v);
            }

            return $acc;
        }, []);
    }

    public function __toString(): string
    {
        return sprintf(
            '%s JSON: %s',
            static::class,
            json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR)
        );
    }

    /**
     * Whether the provided array (or other) is a list rather than a dictionary.
     * A list is defined as an array for which all the keys are consecutive
     * integers starting at 0. Empty arrays are considered to be lists.
     *
     * @param array<mixed, mixed>|mixed $array
     */
    protected static function isList($array): bool
    {
        return \is_array($array) && (
            [] === $array
            || \array_keys($array) === \range(0, \count($array) - 1)
        );
    }

    /**
     * Converts a response from the Stripe API to the corresponding PHP object.
     *
     * @param array                $resp    the response from the Stripe API
     *
     * @return array|ShipstationObject|mixed
     */
    protected static function convertToObject($resp)
    {
        $types = [];

        if (self::isList($resp)) {
            return \array_map([self::class, 'convertToObject'], $resp);
        }

        if (\is_array($resp)) {
            $class = $types[$resp['object']] ?? ShipstationObject::class;
            return $class::fromArray($resp);
        }

        return $resp;
    }
}
