<?php

        class Cuisine
        {
            private $cuisine_name;
            private $id;

            //constructors
            function __construct($cuisine_name, $id = null)
            {
                $this->cuisine_name = $cuisine_name;
                $this->id = $id;
            }

            //getters
            function getCuisineName()
            {
                return $this->cuisine_name;
            }

            function getId()
            {
                return $this->id;
            }

            function getRestaurants()
            {
                $restaurants = array();
                $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurant WHERE cuisine_id = {$this->getId()};");

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

            //setters
            function setCuisineName($new_cuisine_name)
            {
                $this->cuisine_name = (string) $new_cuisine_name;
            }

            //save function
            function save()
            {
                $GLOBALS['DB']->exec("INSERT INTO cuisine (name) VALUES ('{$this->getCuisineName()}')");
                $this->id = $GLOBALS['DB']->lastInsertId();

            }

            //Delete function
            function delete()
            {
                $GLOBALS['DB']->exec("DELETE FROM cuisine WHERE id = {$this->getId()};");
            }

            //Update function
            function update($new_cuisine_name)
            {
                $GLOBALS['DB']->exec("UPDATE cuisine SET name = '{new_cuisine_name}' WHERE id = {$this->getId()};");
                $this->setCuisineName($new_cuisine_name);
            }



            //Static functions
            static function getAll()
            {
                $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisine;");
                $cuisines = array();

                foreach($returned_cuisines as $cuisine) {
                    $name = $cuisine['name'];
                    $id = $cuisine['id'];
                    $new_cuisine = new Cuisine($name, $id);
                    array_push($cuisines, $new_cuisine);
                }
                return $cuisines;
            }

            static function deleteAll()
            {
                $GLOBALS['DB']->exec("DELETE FROM cuisine;");
            }

            static function find($search_id)
            {
                $found_cuisine = null;
                $cuisines = Cuisine::getAll();

                foreach($cuisines as $cuisine) {
                    $cuisine_id = $cuisine->getId();

                    if ($cuisine_id == $search_id) {
                        $found_cuisine = $cuisine;
                    }
                }
                return $found_cuisine;

            }
        }
 ?>
