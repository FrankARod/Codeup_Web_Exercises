<?php

	var_dump($_POST);
	var_dump($_GET);

?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
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
			<p>
				<label for="save"><input type="checkbox" name="save" id="save">Save to sent folder?</label>
			</p>
		</form>


		<h2>Pop Quiz!</h2>
		<form method="POST" action="/my_first_form.php">
			<h3>What color is the sky on a sunny day?</h3>
			<p>
				<label for="q1answer1"><input type="radio" name="q1answer1" value="blue">Blue</la
				<label for="q1answer2"><input type="radio" name="q1answer2" value="red">Red</la
				<label for="q1answer3"><input type="radio" name="q1answer3" value="green">Green</la
				<label for="q1answer4"><input type="radio" name="q1answer4" value="purple">Purple</label>
			</p>

			<h3>What day is it?</h3>
			<p>
				<label for="q2answer1"><input type="radio" name="q2answer1" value="monday">Monday</label>
				<label for="q2answer2"><input type="radio" name="q2answer2" value="tuesday">Tuesday</label>
				<label for="q2answer3"><input type="radio" name="q2answer3" value="wednesday">Wednesday</label>
				<label for="q2answer4"><input type="radio" name="q2answer4" value="thursday">Thursday</label>
			</p>


			<h3>How do you feel today?</h3>
			<p>
				<label for="m_answer1"><input type="checkbox" name="m_answer[]" value="happy">Happy</label>
				<label for="m_answer2"><input type="checkbox" name="m_answer[]" value="sad">Sad</label>
				<label for="m_answer3"><input type="checkbox" name="m_answer[]" value="bored">Bored</label>
				<label for="m_answer4"><input type="checkbox" name="m_answer[]" value="scared">Scared</label>
			</p>


			<p>
				<h3>What Languages Can You Speak></h3>
				<label for="languages">Pick multiple</label>
				<select name="languages[]" multiple>
					<option>English</option>
					<option>Spanish</option>
					<option>French</option>
					<option>Esperanto</option>
				</select>
			</p>
			<p>
				<input type="submit" value="Check your answers!">
			</p>
		</form>

		<h2>Select Testing</h2>
		<form method="POST" action="/my_first_form.php">
			<p>
				<label for="yesno">Yes or No?</label>
					<select id="yesno" name="yesno">
						<option value="1" checked>Yes</option>
						<option value="0">No</option>
					</select>
			</p>

			<p>
				<input type="submit">
			</p>
		</form>
	</body>
</html>