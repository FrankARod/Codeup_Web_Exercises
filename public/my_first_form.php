<?php

	var_dump($_POST);
	var_dump($_GET);

?>


<form method="POST" action="/my_first_form.php">
    <p>
        <label for="username">Username</label>
        <input id="username" name="username" type="text" placeholder="Username">
    </p>
    <p>
        <label for="password">Password</label>
        <input id="password" name="password" type="password" placeholder="Password">
    </p>
    <p>
        <button type="submit" name="Submit" value="Login">Login</button>
    </p>
</form>