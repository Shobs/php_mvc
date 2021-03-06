<?php
/**
 * Header template page
 */

//Check current uri against desired page to check if active
$uris = $router->parse($_SERVER['REQUEST_URI']);
$home = in_array('home', $uris)?"active":"";
$admin = in_array('admin', $uris)?"active":"";

print <<<END
<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">



<!--Pulling Awesome Font -->
<link rel="stylesheet" href="bower_components/popper.js/docs/css/font-awesome.min.css">

<!-- Bootstrap fileinput CSS -->
<link rel="stylesheet" href="bower_components/bootstrap-fileinput/css/fileinput.min.css">

<!--Tabulator stylesheet -->
<link href="bower_components/tabulator/dist/css/tabulator.min.css" rel="stylesheet">

<!--Custom stylesheet -->
<link rel="stylesheet" href="public/css/styles.css">


<title>Simple Database App</title>
</head>

<body>
END;

if (!in_array('login', $uris)) {
    echo <<<END
    <nav class="navbar navbar-expand-md navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="home">MalwareDetect</a>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item ">
    <a class="nav-link $home" href="home">Home <span class="sr-only">(current)</span></a>
    </li>
END;

    // displaying admin link if user logged and is admin
    if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] && $_SESSION['isAdmin']) {
        echo "<li class='nav-item'><a class='nav-link $admin' href='admin'>Admin <span class='sr-only'>(current)</span></a></li>";
    }

    echo  "</ul>";
    echo  "<ul class='navbar-nav ml-auto'>";

    // if user logged display loggout, else login
    if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {
        echo "<li class='nav-item'> <a class='nav-link active' href='login/logout'>Logout <span class='sr-only'>(current)</span></a></li>";
    } else {
        echo "<li class='nav-item'><a class='nav-link active' href='login'>Login <span class='sr-only'>(current)</span></a></li>";
    }

    echo "</ul></div></nav>";

}

echo '<main role="main" class="container">';

?>






