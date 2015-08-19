<?php

        class Cuisine
        {
            private $cuisine_name;

            //constructors
            function __construct($cuisine_name)
            {
                $this->cuisine_name = $cuisine_name;
            }

            //getters
            function getCuisineName()
            {
                return $this->cuisine_name;
            }

            //setters
            function setCuisineName($new_cusine_name)
            {
                $this->cuisine_name = (string) $new_cuisine_name;
            }

            //save function
            function save()
            {
                $GLOBALS['DB']->exec("INSERT INTO cuisine (name) VALUES ('{$this->getCuisineName()}')");

            }

            //Static functions
            static function getAll()
            {
                $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisine;");
                $cuisines = array();

                foreach($returned_cuisines as $cuisine) {
                    $name = $cuisine['name'];
                    $new_cuisine = new Cuisine($name);
                    array_push($cuisines, $new_cuisine);
                }
                return $cuisines;
            }

            static function deleteAll()
            {
                $GLOBALS['DB']->exec("DELETE FROM cuisine;");
            }
        }
 ?>
