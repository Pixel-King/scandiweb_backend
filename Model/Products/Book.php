<?php

class Book extends Product
{
    protected $weight;
    protected $dbSpecificFieldName = 'weight';

    public function getInf() {
        return [
            'sku' => $this->sku,
            'name' => $this->name,
            'price' => $this->price,
            $this->dbSpecificFieldName => $this->weight
        ];
    }

    public function getSpecificAttribute(): string
    {
        return "{$this->weight}";
    }

    public function setSpecificAttribute($weight): void
    {
        $this->weight = $weight;
    }
}