<?php

namespace App\Service;

use App\Collection\FruitCollection;

class FruitService extends StorageService
{

    protected $fruitCollection;
    public function __construct()
    {
        $this->fruitCollection = new FruitCollection();
    }

    /**
     * Singular function to get json data and call all functions.
     * @param array $data
     * @return array
     */
    public function processData($jsonData): array
    {
        $jsonData = json_decode($jsonData, true);

        // FRUITS
        $this->add($jsonData);
        $this->remove('Oranges');
        $this->remove('Pears');
        $this->remove('Melons');

        return [
            'searched' => $this->fruitCollection->search("Apples"),
            'fruits' => $this->fruitCollection->list(),
        ];
    }

    /**
     * Adding fruit into Array collection.
     * @param array $data
     * @return void
     */
    private function add(array $data): void
    {
        foreach ($data as $item) {
            $name = $item['name'];
            $itemType = $item['type'];
            $quantity = $item['quantity'];
            $unit = "g";
            if ($itemType == "fruit") :
                $this->fruitCollection->add(
                    [
                        'name' => $name,
                        'unit' => $unit,
                        'quantity' => $quantity,
                        'type' => $itemType
                    ]
                );
            endif;
        }
    }

    /**
     * Remove fruit from Array collection.
     * @param string $name
     * @return void
     */
    private function remove(string $name): void
    {
        foreach ($this->fruitCollection->list() as $key => $list) {
            if ($list['name'] == $name) {
                $this->fruitCollection->remove($key);
            }
        }
    }
}
