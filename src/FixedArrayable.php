<?php

namespace Petrobolos\FixedArray;

use ArrayAccess;
use Illuminate\Support\Collection;
use JsonSerializable;
use SplFixedArray;

/**
 * FixedArrayable class.
 *
 * Provides a fluent interface for working with fixed arrays.
 *
 * @copyright Copyright (C) 2022 Petrobolos Games
 * @license MIT
 * @package Petrobolos\FixedArray
 */
class FixedArrayable implements JsonSerializable
{
    /**
     * The underlying array value.
     *
     * @var \SplFixedArray
     */
    protected SplFixedArray $value;

    public function __construct(mixed $input = null)
    {
        if ($input instanceof SplFixedArray) {
            $this->value = $input;
        } elseif ($input instanceof Collection) {
            $this->value = FixedArray::fromCollection($input);
        } else {
            $this->value = is_array($input) ? FixedArray::fromArray($input) : FixedArray::fromArray([$input]);
        }
    }

    public function add(mixed $input): self
    {
        return $this->push($input);
    }

    public function addFrom(ArrayAccess|array $input): self
    {
        return $this->from(FixedArray::addFrom($input, $this->value));
    }

    public function contains(mixed $item, bool $useStrict = false): bool
    {
        return FixedArray::contains($item, $this->value, $useStrict);
    }

    public function count(): int
    {
        return FixedArray::count($this->value);
    }

    public function create(int $count = 5): self
    {
        return $this->from(FixedArray::create($count));
    }

    public function each(callable $callback): self
    {
        FixedArray::each($this->value, $callback);

        return $this;
    }

    public function filter(callable $callback): self
    {
        return $this->from(FixedArray::filter($this->value, $callback));
    }

    public function first(): mixed
    {
        return FixedArray::first($this->value);
    }

    public function from(mixed $input): self
    {
        return new static($input);
    }

    public function fromArray(array $array): self
    {
        return $this->from($array);
    }

    public function fromCollection(Collection $collection): self
    {
        return $this->from($collection);
    }

    public function get(): SplFixedArray
    {
        return $this->value;
    }

    public function last(): mixed
    {
        return FixedArray::last($this->value);
    }

    public function map(string|callable $callback): self
    {
        return $this->from(FixedArray::map($this->value, $callback));
    }

    public function merge(array|SplFixedArray|Collection ...$inputs): self
    {
        return $this->from(FixedArray::merge($this->value, $inputs));
    }

    public function pop(): mixed
    {
        return FixedArray::pop($this->value);
    }

    public function push(mixed $input): self
    {
        return $this->from(FixedArray::push($input, $this->value));
    }

    public function resize(int $indices): self
    {
        FixedArray::resize($indices, $this->value);

        return $this;
    }

    public function second(): mixed
    {
        return FixedArray::second($this->value);
    }

    public function toArray(): array
    {
        return FixedArray::toArray($this->value);
    }

    public function toCollection(): Collection
    {
        return FixedArray::toCollection($this->value);
    }

    /**
     * Get the JSON representation of the arrayable object.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
