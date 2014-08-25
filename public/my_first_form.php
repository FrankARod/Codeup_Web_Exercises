<?php

	var_dump($_POST);
	var_dump($_GET);

?>

<h2>User Login</h2>

<form method="POST" action="/my_first_form.php">
    <p>
        <label for="username">Username</label>
        <input id="username" name="username" type="text" placeholder="Username"></label>
    </p>
    <p>
        <label for="password">Password</label>
        <input id="password" name="password" type="password" placeholder="Password"></label>
    </p>
    <p>
        <button type="submit" name="Submit" value="Login">Login</button>
    </p>
</form>

<h2>Compose an eMail</h2>

<form method="POST" action="/my_first_form.php">
	<p>
		<label for="to">Recipient<input name="to" id="to" type="text"></label>
	</p>

	<p>
		<label for="from">From<input name="from" id="from" type="text"></label>
	</p>

	<p>
		<label for="subject">Subject<input name="subject" id="subject" type="text"></label>
	</p>

	<p>
		<textarea name="body" id="body"></textarea>
	</p>

	<p>
		<label for="submit"><input name="submit" value="Send" type="submit"></label>
	</p>