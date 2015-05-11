<?php

class OrderDetail {

    var $orderID, $proID, $amount;

    function __construct($orderID, $proID, $amount) {
        $this->orderID = $orderID;
        $this->proID = $proID;
        $this->amount = $amount;
    }

    public function getId() {
        return $this->id;
    }

    public function getOrderID() {
        return $this->orderID;
    }

    public function getProID() {
        return $this->proID;
    }


    public function getAmount() {
        return $this->amount;
    }

    public function setOrderID($orderID) {
        $this->orderID = $orderID;
    }

    public function setProID($proID) {
        $this->proID = $proID;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function add() {

        $sql = "insert into OrderDetails (OrderID, ProductID, Amount)
                values($this->orderID, $this->proID, $this->amount)";
        $sql2 = "update products set quantity = quantity - $this->amount where productID = $this->proID";
        DataProvider::execQuery($sql);
        DataProvider::execQuery($sql2);
    }

}
