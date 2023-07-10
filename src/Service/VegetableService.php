<?php

namespace App\Service;

use App\Collection\VegetableCollection;

class VegetableService extends StorageService
{

    protected $vegetableCollection;
    public function __construct()
    {
        $this->vegetableCollection = new VegetableCollection();
    }

    /**
     * Singular function to get json data and call all functions.
     * @param array $data
     * @return array
     */
    public function processData($jsonData): array
    {
        $jsonData = json_decode($jsonData, true);

        $this->add($jsonData);
        $this->remove('Cucumber');
        $this->remove('Onion');

        return [
            'searched' => $this->vegetableCollection->search("Beans"),
            'vegetables' => $this->vegetableCollection->list(),
        ];
    }

    /**
     * Adding veg into Array collection.
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
            if ($itemType == "vegetable") :
                $this->vegetableCollection->add(
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
     * Remove vegetable from Array collection.
     * @param string $name
     * @return void
     */
    private function remove(string $name): void
    {
        foreach ($this->vegetableCollection->list() as $key => $list) {
            if ($list['name'] == $name) {
                $this->vegetableCollection->remove($key);
            }
        }
    }
}
