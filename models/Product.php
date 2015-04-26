<?php
namespace app\models;

class Product
{
    private $id; // int
    private $name; // string
    private $description; // string
    private $website; // string
    private $os; // string

    public function __construct()
    {
        // Create product id somehow? Lol.
    }


    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function getOs()
    {
        return $this->os;
    }


    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setWebsite($website)
    {
        $this->website = $website;
    }

    public function setOs($os)
    {
        $this->os = $os;
    }

}