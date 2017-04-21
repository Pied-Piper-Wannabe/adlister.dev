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

            if(Input::has("name")){
                if(!empty(Input::get("name")) && !empty(Input::get("category")) && !empty(Input::get("brand")) && !empty(Input::get("price")) && !empty(Input::get("description"))){
            
                        $ads::insertAd(Input::get("name"), Input::get("category"), Input::get("brand"), Input::get("price"),  Input::get("description"));
                }
            }



            break;

        case '/edit' :
            $mainView = '../views/ads/edit.php';
            break;

        case '/show' :
            $mainView = '../views/ads/show.php';
            //need to output: info on the topic, choose by id from database,
            if (Input::has("id")){
                $data['id'] = Input::get("id");
            }

            $ads = new Ads();
            //Grab specific Ad by ID
            $data["results"] = $ads::find($data['id']);
            break;

        case '/items' :
            $mainView = '../views/ads/index.php';
            $data['page'] = 1;
            $data['cat'] = "";

            if (Input::has("cat")){
                $value = Input::get("cat");
                $data['cat'] = " WHERE category = '$value'";

            }

            if (Input::has("page")) {
                $data['page'] = Input::get("page");
            }else{
                $data['page'] = 1;
            }

            $ads = new Ads();
            //Outputs Results 
            $data['results'] = ($ads::paginate($data['page'], $data['cat']));
            //Total Count of avaliable records
            $data['totalResults'] = ($ads::count());

            //Calculate total # of pages
            $data['total'] = $ads::count();
            $data['pages'] = ceil($data['total'] / 10);

            //Prevents overflow of pages
            if ($data['page'] >= $data['pages']) {
                $data['page'] = $data['pages'];
            }
            break;

        case '/account' :
            $mainView = '../views/users/account.php';
            $user = new User;
            $userInfo = $user::findByUsernameOrEmail($_SESSION['LOGGED_IN_USER']);
            $data['name'] = $userInfo->name;
            $data['username'] = $userInfo->username;
            $data['email'] = $userInfo->email;

            break;

        case '/edit-user' :
            $mainView = '../views/users/edit.php';
            $user = new User;
            $userInfo = $user::findByUsernameOrEmail($_SESSION['LOGGED_IN_USER']);
            $data['name'] = $userInfo->name;
            $data['username'] = $userInfo->username;
            $data['email'] = $userInfo->email;

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


    return $data;
}

extract(pageController());
