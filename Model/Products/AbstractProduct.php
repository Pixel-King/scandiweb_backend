<?php

abstract class Product
{
    protected $sku;
    protected $name;
    protected $price;
    protected $type;
    protected $dbSpecificFieldName;

    public function getDbSpecificFieldName(): string
    {
        return $this->dbSpecificFieldName;
    }

    public function getSKU(): string
    {
        return $this->sku;
    }

    public function setSKU(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getType() {
        return $this->type;
    }

    abstract public function getSpecificAttribute();

    abstract public function setSpecificAttribute($prop): void;

    abstract public function getInf();
}