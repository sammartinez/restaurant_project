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


        class CuisineTest extends PHPUnit_Framework_TestCase
        {

                protected function tearDown()
                {
                    Cuisine::deleteAll();
                }

                function test_getCuisineName()
                {
                    //Arrange
                    $name = "burgers";
                    $test_Cuisine = new Cuisine($name);

                    //Act
                    $result = $test_Cuisine->getCuisineName();

                    //Assert
                    $this->assertEquals($name, $result);
                }

                function test_save()
                {
                    //Arrange
                    $name = "burgers";
                    $test_Cuisine = new Cuisine($name);
                    $test_Cuisine->save();

                    //Act
                    $result = Cuisine::getAll();

                    //Assert
                    $this->assertEquals($test_Cuisine, $result[0]);
                }

                function test_getAll()
                {
                    //Arrange
                    $name = "burgers";
                    $test_Cuisine = new Cuisine($name);
                    $test_Cuisine->save();

                    //Act
                    $result = Cuisine::getAll();

                    //Assert
                    $this->assertEquals([$test_Cuisine], $result);
                }

                function test_deleteAll()
                {
                    //Arrange
                    $name = "burgers";
                    $test_Cuisine = new Cuisine($name);
                    $test_Cuisine->save();

                    //Act
                    Cuisine::deleteAll();
                    $result = Cuisine::getAll();

                    //Assert
                    $this->assertEquals([], $result);

                }

                function test_getId()
                {
                    //Arrange
                    $name = "burgers";
                    $id = 1;
                    $test_Cuisine = new Cuisine($name, $id);

                    //Act
                    $result = $test_Cuisine->getId();

                    //Assert
                    $this->assertEquals(true, is_numeric($result));
                }

                function test_find()
                {

                    //Arrange
                    $name = "burgers";
                    $test_Cuisine = new Cuisine($name);
                    $test_Cuisine->save();

                    //Act
                    $result = Cuisine::find($test_Cuisine->getId());

                    //Assert
                    $this->assertEquals($test_Cuisine, $result);
                }
        }

 ?>
