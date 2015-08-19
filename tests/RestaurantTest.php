<?php

        /**
        * @backupGlobals disabled
        * @backupStaticAttributes disabled
        */

        require_once "src/Cuisine.php";
        require_once "src/Restaurant.php";

        $server = 'mysql:host=localhost;dbname=test_restaurant_projects';
        $username = 'root';
        $password = 'root';
        $DB = new PDO($server, $username, $password);

        class RestaurantTest extends PHPUnit_Framework_TestCase
        {
            protected function tearDown()
            {
                Restaurant::deleteAll();
                Cuisine::deleteAll();
            }

            function test_getId()
            {
                //Arrange
                $name = "Drinks";
                $id = null;
                $test_Cuisine = new Cuisine($name, $id);
                $test_Cuisine->save();

                $restaurant = "Aalto";
                $address = "123 Belmont";
                $phone = "123-456-7890";
                $cuisine_id = $test_Cuisine->getId();
                $test_restaurant = new Restaurant($restaurant, $address, $phone, $cuisine_id, $id);
                $test_restaurant->save();

                //Act
                $result = $test_restaurant->getId();

                //Assert
                $this->assertEquals(true, is_numeric($result));
            }

            function test_getCategoryId()
            {
                //Arrange
                $name = "Drinks";
                $id = null;
                $test_Cuisine = new Cuisine($name, $id);
                $test_Cuisine->save();

                $restaurant = "Aalto";
                $address = "123 Belmont";
                $phone = "123-456-7890";
                $cuisine_id = $test_Cuisine->getId();
                $test_restaurant = new Restaurant($restaurant, $address, $phone, $cuisine_id, $id);
                $test_restaurant->save();

                //Act
                $result = $test_restaurant->getCuisineId();

                //Assert
                $this->assertEquals(true, is_numeric($result));
            }

            function test_save()
            {
                //Arrange
                $name = "Drinks";
                $id = null;
                $test_Cuisine = new Cuisine($name, $id);
                $test_Cuisine->save();

                $restaurant = "Aalto";
                $address = "123 Belmont";
                $phone = "123-456-7890";
                $cuisine_id = $test_Cuisine->getId();
                $test_restaurant = new Restaurant($restaurant, $address, $phone, $cuisine_id, $id);

                //Act
                $test_restaurant->save();

                //Assert
                $result = Restaurant::getAll();
                $this->assertEquals($test_restaurant, $result[0]);
            }
        }

 ?>
