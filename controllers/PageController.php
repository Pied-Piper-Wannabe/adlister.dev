<?php

require_once __DIR__ . '/../utils/helper_functions.php';

function pageController()
{

    // defines array to be returned and extracted for view
    $data = [];

    // get the part of the request after the domain name
    $request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


    // switch that will run functions and setup variables dependent on what route was accessed
    switch ($request) {
        case '/' :
            $mainView = '../views/home.php';
            $ads = new Ads();
            //Outputs Most Recent three results
            $data['results'] = ($ads::latest());
            break;

        case '/create' :
            $mainView = '../views/ads/create.php';
            $ads = new Ads();
            $user = new User();
            $photodir = "";

            $userInfo = $user::findByUsernameOrEmail($_SESSION['LOGGED_IN_USER']);
            $userId = $userInfo->id;


            if(Input::has("name")){
                if(!empty(Input::get("name")) && !empty(Input::get("category")) && !empty(Input::get("brand")) && !empty(Input::get("price")) && !empty(Input::get("description"))){

                    if($_FILES != null){
                        $photodir = saveUploadedImage("photodir");
                        $ads::insertAd(Input::get("name"), Input::get("category"), Input::get("brand"), Input::get("price"), Input::get("description"), $photodir, $userId);
                    }else{
                        $ads::insertAd(Input::get("name"), Input::get("category"), Input::get("brand"), Input::get("price"), Input::get("description"), "", $userId);
                    }
                }
            }
            break;

        case '/edit' :
            $mainView = '../views/ads/edit.php';
            $ads = new Ads();
            //Finds Ad
            $adInfo = $ads::find(Input::get("id"));
            var_dump($adInfo);
            //Asigns current ad values to output
            $data['name'] = $adInfo->name;
            $data['price'] = $adInfo->price;
            $data['description'] = $adInfo->description;
            $data['category'] = $adInfo->category;
            $data['brand'] = $adInfo->brand;

            if(Input::has("name")){
                if(!empty(Input::get("name"))
                && !empty(Input::get("category"))
                && !empty(Input::get("brand"))
                && !empty(Input::get("price"))
                && !empty(Input::get("description")))
                {
                    $ads->id = $adInfo->id;
                    $ads->name = Input::get("name");
                    $ads->category = Input::get("category");
                    $ads->brand= Input::get("brand");
                    $ads->price = Input::get("price");
                    $ads->description = Input::get("description");
                    $ads->user_id = $adInfo->user_id;

                    if($_FILES != null){
                        $ads->photodir = saveUploadedImage("photodir");
                    }else{
                        $ads->photodir = $adInfo->photodir;
                    }
                    $ads->updateAd();
                    header("Location: http://adlister.dev");
                    die();
                }else{
                    echo("All fields required");
                }
            }

            break;

        case '/show' :
            $mainView = '../views/ads/show.php';
            //need to output: info on the topic, choose by id from database,
            if (Input::has("id")){
                $data['id'] = Input::get("id");
            }

            $ads = new Ads();
            $user = new User();
            //Grab specific Ad by ID
            $data["results"] = $ads::find($data['id']);

            //Grabs user info and sets only needed info for data display
            $userInfo = $user::findByUsernameOrEmail($data["results"]->user_id);
            $data["userEmail"] = $userInfo->email;
            $data["username"] = $userInfo->username;
            break;

        case '/items' :
            $mainView = '../views/ads/index.php';
            $data['page'] = 1;
            $ads = new Ads();
            $cat = "";

            //Sets current page
            if (Input::has("page")) {
                $data['page'] = Input::get("page");
            }else{
                $data['page'] = 1;
            }

            //Re-asigns $cat if there is a catagory selected
            if (Input::has("cat")){
                $value = Input::get("cat");
                $cat = " WHERE category = '$value'";
            }

            if(Input::has("a")){
                $value = Input::get("a");
                $cat = " WHERE category LIKE '%$value%' OR name LIKE '%$value%' OR brand LIKE '%$value%'";
            }

            //Outputs Results
            $data['results'] = ($ads::paginate($data['page'], $cat));

            //Calculate total # of pages for both all and if a catagory is selected
            $data['total'] = $ads::count($cat);
            $data['pages'] = ceil($data['total'] / 10);

            //Prevents overflow of pages
            if ($data['page'] >= $data['pages']) {
                $data['page'] = $data['pages'];
            }
            break;

        case '/account' :
            $mainView = '../views/users/account.php';
            $user = new User;
            $ads = new Ads();
            //Display User info
            $userInfo = $user::findByUsernameOrEmail($_SESSION['LOGGED_IN_USER']);
            $data['name'] = $userInfo->name;
            $data['username'] = $userInfo->username;
            $data['email'] = $userInfo->email;

            //Setup Ad info
            $cat = " WHERE user_id = '$userInfo->id' ORDER BY id DESC ";

            //Sets current page
            if (Input::has("page")) {
                $data['page'] = Input::get("page");
            }else{
                $data['page'] = 1;
            }

            //Outputs Results
            $data['results'] = ($ads::paginate($data['page'], $cat, 5));

            //Calculate total # of pages for both all and if a catagory is selected
            $data['total'] = $ads::count($cat);
            $data['pages'] = ceil($data['total'] / 5);

            //Prevents overflow of pages
            if ($data['page'] >= $data['pages']) {
                $data['page'] = $data['pages'];
            }
            break;

        case '/edit-user' :
            $mainView = '../views/users/edit.php';
            $user = new User;
            $userInfo = $user::findByUsernameOrEmail($_SESSION['LOGGED_IN_USER']);
            $data['name'] = $userInfo->name;
            $data['username'] = $userInfo->username;
            $data['email'] = $userInfo->email;

            //Checks to ensure username set and fields not empty
            if(Input::has("username")){
                if(!empty(Input::get("name"))
                && !empty(Input::get("email"))
                && !empty(Input::get("username"))
                && !empty(Input::get("password"))
                && !empty(Input::get("passwordVerify")))
                {
                    //Checks to ensure password and verify match then udpates user info TODO: Prevent duplicates
                    if(Input::get("password") === Input::get("passwordVerify")){
                        $user->id = $userInfo->id;
                        $user->name = Input::get("name");
                        $user->email = Input::get("email");
                        $user->username = Input::get("username");
                        $newUsername = Input::get("username");
                        $user->password = Input::get("password");
                        $user->updateUser($newUsername);
                    }else{
                        echo("Passwords do not match");
                    }
                }else{
                    echo("All fields required");
                }
            }


            break;

        case '/login' :
            $mainView = '../views/users/login.php';
            $user = new User;

            if(Input::has("email_user")) {
                $attempt = $user::attempt(Input::get("email_user"), Input::get("password"));

                if($user::check()){
                    header("Location: http://adlister.dev");
                    die();
                }
            }
            break;

        case '/signup' :
            $mainView = '../views/users/signup.php';
            $user = new User();

            if(Input::has("name")){
                if(!empty(Input::get("name")) && !empty(Input::get("email")) && !empty(Input::get("username")) && !empty(Input::get("password"))){

                    if($user::findByUsernameOrEmail(Input::get("email")) === null && $user::findByUsernameOrEmail(Input::get("username")) === null){
                        $user::insertUser(Input::get("name"), Input::get("email"), Input::get("username"), Input::get("password"));
                    }
                }
            }
            break;

        case '/logout' :
            $user = new User;
            $user::logout();
            header("Location: http://adlister.dev/");
            break;

        default:    // displays 404 if route not specified above
            $mainView = '../views/404.php';
            break;
    }

    $data['mainView'] = $mainView;

    //Search Bar Functionality
    if(Input::has("search")){
        header("Location: http://adlister.dev/items?a=" . Input::get('search'));
        die();
    }


    return $data;
}

extract(pageController());
