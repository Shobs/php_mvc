<?php

//Check current uri against desired page to check if active
$index = strpos($_SERVER['REQUEST_URI'],'index.php') !== false?"active":"";
$create = strpos($_SERVER['REQUEST_URI'],'create.php') !== false?"active":"";

print <<<END
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="public/css/styles.css">

    <title>Simple Database App</title>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href=".">A Blog</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link $index" href=".">Home <span class="sr-only">(current)</span></a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link $create" href="create.php">Create</a>
                </li>-->
            </ul>
        </div>
    </nav>
    <main role="main" class="container">
END;

?>





