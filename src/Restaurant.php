<?php

    class Restaurant
    {

        private $name;
        private $address;
        private $phone;
        private $cuisine_id;
        private $id;

        //Constructors
        function __construct($name, $address, $phone, $cuisine_id, $id)
        {
            $this->name = $name;
            $this->address = $address;
            $this->phone = $phone;
            $this->cuisine_id = $cuisine_id;
            $this->id = $id;
        }

        //Setters
        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setAddress($new_address)
        {
            $this->address = $new_address;
        }

        function setPhone($new_phone)
        {
            $this->phone = $new_phone;
        }

        //Getters
        function getName()
        {
            return $this->name;
        }

        function getAddress()
        {
            return $this->address;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function getId()
        {
            return $this->id;
        }

        //Save Function
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurant (name, address, phone, cuisine_id) VALUES ('{$this->getName()}', '{$this->getAddress()}', '{$this->getPhone()}', {$this->getCuisineId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        //Update Function
        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE restaurant SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        //Delete function
        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurant WHERE id = {$this->getId()};");
        }

        //Static Functions
        static function getAll()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurant;");
            $restaurants = array();

            foreach($returned_restaurants as $restaurant) {
                $name = $restaurant['name'];
                $address = $restaurant['address'];
                $phone = $restaurant['phone'];
                $cuisine_id = $restaurant['cuisine_id'];
                $id = $restaurant['id'];

                $new_restaurant = new Restaurant($name, $address, $phone, $cuisine_id, $id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function deleteAll()
        {
            $GLOBALS ['DB']->exec("DELETE FROM restaurant;");
        }

        static function find($search_id)
        {
            $found_restaurant = null;
            $restaurants = Restaurant::getAll();

            foreach($restaurants as $restaurant) {
                $restaurant_id = $restaurant->getId();
                if ($restaurant_id == $search_id) {
                    $found_restaurant = $restaurant;
                }
            }
            return $found_restaurant;
        }
    }
 ?>
