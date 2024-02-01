<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; //get the username in the post
    $password = $_POST['password']; // gets the password in the post
    $login->login_user($username, $password);
}
?>
<h2>Login</h2>
<form action="" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <br>
    <button type="submit">Login</button>
</form>