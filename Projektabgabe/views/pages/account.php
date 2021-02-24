<div class="account-wrapper">
	<h1>Konto</h1>

    <!-- shows account data of the user -->
    <table class="data-table">
        <tr>
            <td class="data-type">
                Vorname: 
            </td>
            <td class="data">
                <?php echo($firstName) ?>
            </td>
        </tr>
        <tr>
            <td class="data-type">
                Nachname: 
            </td>
            <td class="data">
                <?php echo($lastName) ?>
            </td>
        </tr>
        <tr>
            <td class="data-type">
                Geburtsdatum: 
            </td>
            <td class="data">
                <?php echo($birthdate) ?>
            </td>
        </tr>
        <tr>
            <td class="data-type">
                Email: 
            </td>
            <td class="data">
                <?php echo($email) ?>
            </td>
        </tr>
        <tr>
            <td class="data-type">
                Straße: 
            </td>
            <td class="data">
                <?php echo($street) ?>
            </td>
        </tr>
        <tr>
            <td class="data-type">
                Hausnummer: 
            </td>
            <td class="data">
                <?php echo($streetNo) ?>
            </td>
        </tr>
        <tr>
            <td class="data-type">
                Postleitzahl: 
            </td>
            <td class="data">
                <?php echo($zip) ?>
            </td>
        </tr>
        <tr>
            <td class="data-type">
                Stadt: 
            </td>
            <td class="data">
                <?php echo($city) ?>
            </td>
        </tr>
        <tr>
            <td class="data-type">
                Land: 
            </td>
            <td class="data">
                <?php echo($country) ?>
            </td>
        </tr>
    </table>

    <!-- button to log out -->
    <div class="account-footer">
		<a href="index.php?c=pages&a=logout">Logout</a>
	</div>

    <!-- form needed to change data or delete account -->
    <form action="index.php?c=pages&a=account" method="post">
        <div class="update-account">
			<input name="updateAcc" type="submit" value="Profildaten ändern"/>
		</div>

        <div class="update-address">
			<input name="updateAddress" type="submit" value="Adresse ändern"/>
		</div>

        <div class="delete-account">
			<input name="deleteAcc" type="submit" value="Account löschen"/>
		</div>
    </form>
</div>