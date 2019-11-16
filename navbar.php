<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Addu</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li <?= highlight("") ?> >
                <a class="nav-link" href="/">Home</a>
            </li>

            <li <?= highlight("islands") ?>>
                <a class="nav-link" href="islands.php">Islands</a>
            </li>

            <li <?= highlight("services") ?>>
                <a class="nav-link" href="services.php">Services</a>
            </li>

        </ul>


        <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>

        <ul class="navbar-nav ml-auto">

            <?php
            if (isset($_SESSION['user'])) {
                echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ' . $_SESSION['user'] . '
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/profile.php">Profile</a>
                            <a class="dropdown-item" href="/logout.php">Logout</a>
                        </div>
                    </li>';
            } else {

                echo '<li class="nav-item ">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>';
            }
            ?>


        </ul>
    </div>
</nav>

<?php

function highlight($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri) {
        echo 'class="nav-item active"';
    } else {
        echo 'class="nav-item"';
    }
}

?>