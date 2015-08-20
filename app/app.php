<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Restaurant.php";

    //Start Silex app
    $app = new Silex\Application();


    $server = 'mysql:host=localhost;dbname=restaurant_projects';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    //Twig Paths
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    // Get Calls
    $app->get("/", function() use($app) {

        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->get("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);

        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->get("/cuisines/{id}/edit", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisine_edit.html.twig', array('cuisine' => $cuisine));
    });

    $app->patch("/cuisines/{id}", function($id) use ($app) {
        $name = $_POST['cuisine_name'];
        $cuisine = Cuisine::find($id);
        $cuisine->update($name);

        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    //Post Calls

    //Restaurant Post Calls
    $app->post("/restaurants", function() use ($app) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        //$rating = $_POST['rating'];
        $cuisine_id = $_POST['cuisine_id'];
        $restaurant = new Restaurant($name, $address, $phone, $cuisine_id, $id = null);

        $restaurant->save();
        $cuisine = Cuisine::find($cuisine_id);

        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    //Cuisine Post Calls
    $app->post("/cuisines", function() use ($app) {
        $cuisine = new Cuisine($_POST['cuisine_name']);
        $cuisine->save();

        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    //Delete Calls

    //Restaurant Delete Call
    $app->post("delete_restaurants", function() use ($app) {
        Restaurant::deleteAll();

        return $app['twig']->render('delete_restaurants.html.twig');
    });

    //Cuisine Delete Call
    $app->post("delete_cuisines", function() use ($app) {
        Cuisine::deleteAll();
        return $app['twig']->render('delete_cuisines.html.twig');
    });

    return $app;
 ?>
