<div class="update-address-wrapper">
	<h1>Adresse aktualisieren</h1>

	<!-- checks if the address was updated -->
	<?php if($success === true) : ?>
		<div class="success-message">
			Ihre Adresse wurde aktualisiert. Sie werden in Kürze auf die Konto-Seite weitergeleitet.
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

		<!-- form needed to update the address -->
		<form action="index.php?c=pages&a=updateAddress" method="post">
			<div class="input">
				<label for="street">
					Straße
				</label>
				<input id="street" name="street" type="text" placeholder="Straße" value="<?=htmlspecialchars($_POST['street'] ?? '')?>" required />
			</div>

			<div class="input">
				<label for="streetNo">
					Hausnummer
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

			<div class="input submit">
				<input name="submit" type="submit" value="Aktualisieren"/>
			</div>

			<div class="update-address-footer">
				<a href="index.php?c=pages&a=account">« zurück zum Konto</a>
			</div>
		</form>

	<?php endif; ?>
</div>
