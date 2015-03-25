<?php
require_once('product_model.php');

class Review
{
    private $reviewID; // int
    private $product; // Product
    private $rating; // int
    private $text; // string
    private $appVersion; // string

    function __construct($product, $rating, $text, $appVersion = "")
    {
        $this->setReviewID();
        $this->setProduct($product);
        $this->setRating($rating);
        $this->setText($text);
        if (empty($appVersion) && isset($this->product)) {
            $this->setVersion($product->getVersion());
        } else {
            $this->setVersion($appVersion);
        }

        // If it's not a valid setup, alert.
        if (!$this->isValid()) {
            // TODO: Whatever we want to do when someone doesn't enter proper params.
        }
    }

    function __destruct()
    {

    }

    public function isValid()
    {
        if (!isset($this->reviewID)) {
            return false;
        } else if (!isset($this->product)) {
            return false;
        } else if (!isset($this->rating)) {
            return false;
        } else if (!isset($this->text)) {
            return false;
        } else if (!isset($this->appVersion)) {
            return false;
        }

        return true;
    }

    // Getters
    public function getReviewID()
    {
        return $this->reviewID;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getVersion()
    {
        return $this->appVersion;
    }

    // Setters
    private function setReviewID()
    {
        return $this->reviewID = uniqid("", true);
    }

    private function setProduct(Product $product)
    {
        if (is_subclass_of($product, "Product")) {
            $this->product = $product;
            return true;
        }
        return false;
    }

    public function setRating($rating)
    {
        if (is_int($rating)) {
            $this->rating = $rating;
            return true;
        }
        return false;
    }

    public function setText($text)
    {
        if (is_string($text)) {
            $this->text = $text;
            return true;
        }
        return false;
    }

    public function setVersion($version)
    {
        if (is_string($version)) {
            if (intval($version) <= intval($this->product->getVersion())) {
                $this->appVersion = $version;
                return true;
            }
        }
        return false;
    }
}
?>