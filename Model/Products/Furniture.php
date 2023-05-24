<?php

class Furniture extends Product
{
    protected $dimensions;
    protected $type = 'furniture';
    protected $dbSpecificFieldName = 'dimensions';

    public function getInf()
    {
        return [
            'sku' => $this->sku,
            'name' => $this->name,
            'price' => $this->price,
            $this->dbSpecificFieldName => $this->dimensions
        ];
    }

    public function getSpecificAttribute(): string
    {
        return "{$this->dimensions}";
    }

    public function setSpecificAttribute($dimensions): void
    {
        $this->dimensions = $dimensions;
    }
}