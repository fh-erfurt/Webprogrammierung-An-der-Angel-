<div class="login-wrapper">
	<h1>Login</h1>

	<!-- checks if login was not successfull, prints error message -->
	<?php if($errMsg !== null) : ?>
		<div class="error-message">
			<?=$errMsg?>
		</div>
	<?php endif; ?>

	<!-- form needed for login -->
	<form action="index.php?c=pages&a=login" method="post">
		<div class="input">
			<label for="email">
				Email
			</label>
			<input id="email" name="email" type="email" placeholder="max@mustermann.de" value="<?=htmlspecialchars($username ?? '')?>" required />
		</div>

		<div class="input">
			<label for="password">
				Passwort
			</label>
			<input id="password" name="password" type="password" placeholder="Passwort" required />
		</div>
		<div class="input">
			<input type="checkbox" id="stayLoggedIn" name="stayLoggedIn" class="check"/>
			<label for="stayLoggedIn">Eingeloggt bleiben</label>
		</div>
		<div class="input-submit">
			<input name="submit" type="submit" value="Login"/>
		</div>
		<div class="login-footer">
			<a href="index.php?c=pages&a=signup">Konto erstellen</a>
		</div>
	</form>
</div>