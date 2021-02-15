<?php
<<<<<<< HEAD
    use php\logic\Auth;
=======

use php\logic\Auth;

>>>>>>> 27629233997d10766ae89b63ecff19f07a0d17a4
?>

<nav>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/test">Test</a></li>
        <li><a href="/register">Register</a></li>
        <li><?php Auth::LoginHome() ?></li>
    </ul>
</nav>