<?php
namespace app\models;

class Review
{
    private $id; // int
    private $productId; // int
    private $rating; // int
    private $comment; // string
    private $username; // int

    public function __construct()
    {

    }


    public function getId()
    {
        return $this->id;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getUsername()
    {
        return $this->username;
    }


    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }
}