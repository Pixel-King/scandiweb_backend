<?php

class Dvd extends Product
{
    protected $size;
    protected $type = 'dvd';
    protected $dbSpecificFieldName = 'size';

    public function getInf()
    {
        return [
            'sku' => $this->sku,
            'name' => $this->name,
            'price' => $this->price,
            $this->dbSpecificFieldName => $this->size
        ];
    }

    public function getSpecificAttribute()
    {
        return $this->size;
    }

    public function setSpecificAttribute($size): void
    {
        $this->size = $size;
    }
}