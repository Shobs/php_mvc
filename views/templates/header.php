<?php

//Check current uri against desired page to check if active
$uris = $router->parse($_SERVER['REQUEST_URI']);
$home = in_array('home', $uris)?"active":"";
$login = in_array('login', $uris)?"active":"";

print <<<END
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">

    <link rel="stylesheet" href="public/css/styles.css">

    <!--Pulling Awesome Font -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <title>Simple Database App</title>
</head>

<body>
END;

if (!in_array('login', $uris)) {
print <<<END
    <nav class="navbar navbar-expand-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="home">MalwareDetect</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link $home" href="home">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link $login" href="login">Login <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
END;
}

echo '<main role="main" class="container">';

?>






