<!--Partial for head.  Good place to include things like css files.-->
<?php





?>
<meta name="viewport" content="width=device-width, initial-scale=1" >
<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/css/main.css">
<?PHP if($mainView === "../views/users/signup.php" || $mainView === "../views/users/login.php"): ?>
    <link rel="stylesheet" type="text/css" href="/css/signup.css">
<?PHP endif; ?>
