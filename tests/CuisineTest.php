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
                    Restaurant::deleteAll();
                }

                function test_getCuisineName()
                {
                    //Arrange
                    $name = "burgers";
                    $test_cuisine = new Cuisine($name);

                    //Act
                    $result = $test_cuisine->getCuisineName();

                    //Assert
                    $this->assertEquals($name, $result);
                }

                function test_save()
                {
                    //Arrange
                    $name = "burgers";
                    $test_cuisine = new Cuisine($name);
                    $test_cuisine->save();

                    //Act
                    $result = Cuisine::getAll();

                    //Assert
                    $this->assertEquals($test_cuisine, $result[0]);
                }

                function test_getAll()
                {
                    //Arrange
                    $name = "burgers";
                    $test_cuisine = new Cuisine($name);
                    $test_cuisine->save();

                    //Act
                    $result = Cuisine::getAll();

                    //Assert
                    $this->assertEquals([$test_cuisine], $result);
                }

                function test_deleteAll()
                {
                    //Arrange
                    $name = "burgers";
                    $test_cuisine = new Cuisine($name);
                    $test_cuisine->save();

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
                    $test_cuisine = new Cuisine($name, $id);

                    //Act
                    $result = $test_cuisine->getId();

                    //Assert
                    $this->assertEquals(true, is_numeric($result));
                }

                function test_find()
                {

                    //Arrange
                    $name = "burgers";
                    $test_cuisine = new Cuisine($name);
                    $test_cuisine->save();

                    //Act
                    $result = Cuisine::find($test_cuisine->getId());

                    //Assert
                    $this->assertEquals($test_cuisine, $result);
                }

                function test_update()
                {
                    //Arrange
                    $name = "burgers";
                    $id = null;
                    $test_cuisine = new Cuisine($name, $id);
                    $test_cuisine->save();

                    $new_cuisine_name = "sushi";

                    //Act
                    $test_cuisine->update($new_cuisine_name);

                    //Assert
                    $this->assertEquals("sushi", $test_cuisine->getCuisineName());
                }

                function testDelete()
                {
                    //Arrange
                    $name = "burgers";
                    $id = null;
                    $test_cuisine = new Cuisine($name, $id);
                    $test_cuisine->save();

                    $name2 = "sushi";
                    $test_cuisine2 = new Cuisine($name2, $id);
                    $test_cuisine2->save();

                    //Act
                    $test_cuisine->delete();

                    //Assert
                    $this->assertEquals([$test_cuisine2], Cuisine::getAll());
                }
        }

 ?>
