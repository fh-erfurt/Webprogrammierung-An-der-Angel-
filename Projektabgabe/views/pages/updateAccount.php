<div class="update-account-wrapper">
	<h1>Profil aktualisieren</h1>

	<!-- checks if the account was updated -->
	<?php if($success === true) : ?>
		<div class="success-message">
			Ihr Profil wurde erfolgreich aktualisiert. Sie werden in Kürze auf Ihre Kontoseite weitergeleitet.
			<meta http-equiv="refresh" content="5; URL=index.php?c=pages&a=account">
		</div>
	<!-- else prints error message -->
	<?php else : ?>
		<?php if(isset($errors) && count($errors) > 0) : ?>
			<div class="error-message">
				<ul>
					<?php foreach($errors as $key => $value) : ?>
						<li><?=$value?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; // errors show ?>

		<!-- form needed to update the account -->
		<form action="index.php?c=pages&a=updateAccount" method="post">
			<div class="input">
				<label for="firstname">
					Vorname
				</label>
				<input id="firstname" name="firstname" type="text" placeholder="Vorname" value="<?=htmlspecialchars($_POST['firstname'] ?? '')?>" />
			</div>

			<div class="input">
				<label for="lastname">
					Nachname
				</label>
				<input id="lastname" name="lastname" type="text" placeholder="Nachname" value="<?=htmlspecialchars($_POST['lastname'] ?? '')?>" />
			</div>

			<div class="input">
				<label for="birthdate">
					Geburtsdatum
				</label>
				<input id="birthdate" name="birthdate" type="date" placeholder="Geburtsdatum" value="" />
			</div>

			<div class="input">
				<label for="email">
					Email
				</label>
				<input id="email" name="email" type="email" placeholder="E-Mail" value="<?=htmlspecialchars($_POST['email'] ?? '')?>" />
			</div>

			<div class="input">
				<label for="password">
					Passwort
				</label>
				<input id="password" name="password" type="password" placeholder="Passwort" value=""  />
			</div>


			<div class="input submit">
				<input name="submit" type="submit" value="Aktualisieren"/>
			</div>

			<div class="update-account-footer">
				<a href="index.php?c=pages&a=account">« zurück zum Konto</a>
			</div>
		</form>
	<?php endif; ?>
</div>