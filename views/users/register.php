Register:
<form action="" method="POST">
	Username: <input type="text" name="username" value="<?= htmlspecialchars($this->username) ?>"><br/>	
	Password: <input type="password" name="password" value="<?= htmlspecialchars($this->password) ?>"><br/>
	Repeat password: <input type="password" name="repeatPassword" value="<?= htmlspecialchars($this->repeatPassword) ?>"><br/>
	Email: <input type="text" name="email" value="<?= htmlspecialchars($this->email) ?>"><br/>
	<input type="submit" value="Register">
</form>