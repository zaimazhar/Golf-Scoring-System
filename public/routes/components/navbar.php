<?php
    use php\logic\Auth;
?>

<nav>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/test">Test</a></li>
        <li><a href="/register">Register</a></li>
        <li><?php Auth::LoginHome() ?></li>
    </ul>
</nav>