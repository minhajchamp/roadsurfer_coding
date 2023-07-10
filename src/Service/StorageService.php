<?php

namespace App\Service;

abstract class StorageService
{
    /**
     * Singular function to get json data and call all functions.
     * @param array $data
     * @return array
     */
    abstract public function processData($jsonData): array;
}
