<?php

namespace App\Collection;

use Doctrine\Common\Collections\ArrayCollection;

class VegetableCollection
{
    private $vegetables;

    public function __construct()
    {
        $this->vegetables = new ArrayCollection();
    }
    
    public function add(array $vegetable): void
    {
        $this->vegetables->add($vegetable);
    }

    public function remove(string $fruit)
    {
        return $this->vegetables->remove($fruit);
    }

    public function list(): array
    {
        return $this->vegetables->toArray();
    }

    public function search(string $name): array
    {
        return $this->vegetables->filter(function ($vegetable) use ($name) {
            return $vegetable[0] === $name;
        })->toArray();
    }
}
