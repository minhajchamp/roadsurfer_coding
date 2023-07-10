<?php

namespace App\Collection;

use Doctrine\Common\Collections\ArrayCollection;

class FruitCollection
{
    private $fruits;

    public function __construct()
    {
        $this->fruits = new ArrayCollection();
    }

    public function add(array $fruits): void
    {
        $this->fruits->add($fruits);
    }

    public function remove(string $fruit)
    {
        return $this->fruits->remove($fruit);
    }

    public function list(): array
    {
        return $this->fruits->toArray();
    }

    public function search(string $name): array
    {
        return $this->fruits->filter(function ($fruit) use ($name) {
            return $fruit['name'] == $name;
        })->toArray();
    }
}
