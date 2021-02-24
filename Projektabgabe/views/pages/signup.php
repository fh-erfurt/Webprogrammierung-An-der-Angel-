<div class="signup-wrapper">
	<h1>Konto erstellen</h1>

	<!-- checks if the account was created -->
	<?php if($success === true) : ?>
		<div class="success-message">
			Vielen Dank, für dein Konto! Sie werden automatisch auf die Login-Seite weitergeleitet.
			<meta http-equiv="refresh" content="5; URL=index.php?c=pages&a=login">
		</div>
	<!-- else prints error message -->
	<?php else : ?>
		<?php if(isset($errors) && count($errors) > 0) : ?>
			<div class="error-message">
				<ul id="errorList">
					<?php foreach($errors as $key => $value) : ?>
						<li><?=$value?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; // errors show ?>

		<!-- form needed to create the account -->
		<form action="index.php?c=pages&a=signup" method="post" id="form">
			<div class="input">
				<label for="firstname">
					Vorname
				</label>
				<input id="firstname" name="firstname" type="text" placeholder="Vorname" value="<?=htmlspecialchars($_POST['firstname'] ?? '')?>" required />
			</div>
			<div class="input">
				<label for="lastname">
					Nachname
				</label>
				<input id="lastname" name="lastname" type="text" placeholder="Nachname" value="<?=htmlspecialchars($_POST['lastname'] ?? '')?>" required />
			</div>
			<div class="input">
				<label for="birthdate">
					Geburtsdatum
				</label>
				<input id="birthdate" name="birthdate" type="date" placeholder="Geburtsdatum" value="" required />
			</div>
			<div class="input">
				<label for="email">
					Email
				</label>
				<input id="email" name="email" type="email" placeholder="E-Mail" value="<?=htmlspecialchars($_POST['email'] ?? '')?>" required />
			</div>
			<div class="input">
				<label for="password">
					Passwort
				</label>
				<input id="password" name="password" type="password" placeholder="Passwort" onkeyup="passwordQuality()" value="" required />
			</div>
			<div class="input">
				<label for="street">
					Straße
				</label>
				<input id="street" name="street" type="text" placeholder="Straße" value="<?=htmlspecialchars($_POST['street'] ?? '')?>" required />
			</div>
			<div class="input">
				<label for="streetNo">								Hausnummer
				</label>
				<input id="streetNo" name="streetNo" type="text" placeholder="Hausnummer" value="<?=htmlspecialchars($_POST['streetNo'] ?? '')?>" required />
			</div>
			<div class="input">
				<label for="zip">
					Postleitzahl
				</label>
				<input id="zip" name="zip" type="text" placeholder="Postleitzahl" value="<?=htmlspecialchars($_POST['zip'] ?? '')?>" required />
			</div>
			<div class="input">
				<label for="city">
					Stadt
				</label>
				<input id="city" name="city" type="text" placeholder="Stadt" value="<?=htmlspecialchars($_POST['city'] ?? '')?>" required />
			</div>
			<div class="input">
				<label for="country">
					Land
				</label>
				<input id="country" name="country" type="text" placeholder="Land" value="<?=htmlspecialchars($_POST['country'] ?? '')?>" required />
			</div>
			<div class="input-submit">
				<input name="submit" type="submit" value="Erstellen"/>
			</div>
			<div class="signup-footer">
				<a href="index.php?c=pages&a=login">« zurück zum Login</a>
			</div>
		</form>
	<?php endif; ?>
</div>