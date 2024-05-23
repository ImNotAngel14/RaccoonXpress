<?php
class Product
{
    private product_id;
    private name;
    private description;
    private quotable;
    private price;
    private quantity;
    private approved;
    private image1;
    private image2;
    private image3;
    private video;
    private seller_id;
    private admin_approval_id;

    // Constructor
    public function __construct($product_id, $name, $description, $quotable, $price, $quantity, $approved, $image1, $image2, $image3, $video, $seller_id, $admin_approval_id)
    {
        $this->product_id = $product_id;
        $this->name = $name;
        $this->description = $description;
        $this->quotable = $quotable;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->approved = $approved;
        $this->image1 = $image1;
        $this->image2 = $image2;
        $this->image3 = $image3;
        $this->video = $video;
        $this->seller_id = $seller_id;
        $this->admin_approval_id = $admin_approval_id;
    }

    static public function parseJson($json) {
        $product = new Product(
            isset($json["product_id"]) ? $json["product_id"] : "";
            isset($json["name"]) ? $json["name"] : "";
            isset($json["description"]) ? $json["description"] : "";
            isset($json["quotable"]) ? $json["quotable"] : "";
            isset($json["price"]) ? $json["price"] : "";
            isset($json["quantity"]) ? $json["quantity"] : "";
            isset($json["approved"]) ? $json["approved"] : "";
            isset($json["image1"]) ? $json["image1"] : "";
            isset($json["image2"]) ? $json["image2"] : "";
            isset($json["image3"]) ? $json["image3"] : "";
            isset($json["video"]) ? $json["video"] : "";
            isset($json["seller_id"]) ? $json["seller_id"] : "";
            isset($json["admin_approval_id"]) ? $json["admin_approval_id"] : "";
        );
        return $product;
    }

    static public function getProduct()
    {

    }

    static public function getProducts()
    {

    }

    static public function saveProduct()
    {

    }

    static public function deleteProduct()
    {
        
    }
}