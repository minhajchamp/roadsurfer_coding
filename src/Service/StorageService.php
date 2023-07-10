<?php

namespace App\Service;

use App\Collection\FruitCollection;
use App\Collection\VegetableCollection;

class StorageService
{

    protected $fruitCollection, $vegetableCollection;
    public function __construct()
    {
        $this->vegetableCollection = new VegetableCollection();
        $this->fruitCollection = new FruitCollection();
    }

    /**
     * Singular function to get json data and call all functions.
     * @param array $data
     * @return void
     */
    public function createCollectionsFromJson($jsonData): array
    {
        $jsonData = json_decode($jsonData, true);

        // FRUITS
        $this->addItems($jsonData, 'fruit');
        $this->removeItem('Oranges', 'fruit');

        // VEGETABLES
        $this->addItems($jsonData, 'vegetable');
        $this->removeItem('Cucumber', 'vegetable');
        $this->removeItem('Beans', 'vegetable');

        return [
            'fruits' => $this->fruitCollection->list(),
            'vegetables' => $this->vegetableCollection->list(),
        ];
    }

    /**
     * Adding fruit into Array collection.
     * @param array $data
     * @return void
     */
    private function addItems(array $data, string $type): void
    {
        $collection = $type === 'fruit' ? $this->fruitCollection : $this->vegetableCollection;

        foreach ($data as $item) {
            $name = $item['name'];
            $itemType = $item['type'];
            $quantity = $item['quantity'];
            $unit = $item['unit'] == "kg" ? "g" : "g";

            if ($itemType === $type) {
                $collection->add(['name' => $name, 'unit' => $unit, 'quantity' => $quantity]);
            }
        }
    }

    /**
     * Remove fruit from Array collection.
     * @param string $name
     * @param string $type
     * @return void
     */
    private function removeItem(string $name, string $type): void
    {
        $collection = $type === "fruit"
            ? $this->fruitCollection :
            $this->vegetableCollection;
        foreach ($collection->list() as $key => $list) {
            if ($list['name'] == $name) {
                $collection->remove($key);
            }
        }
    }
}
