<div class="checkout-wrapper">
	<h1>Kasse</h1>
    <div class="checkout">
        <!-- checks if the order and orderItems was created -->
        <?php if($checkedOut === true) : ?>
		<div class="success-message">
			Vielen Dank, für Ihren Einkauf!
			<meta http-equiv="refresh" content="5; URL=index.php?c=pages&a=home">
		</div>
	    <?php else : ?>

        <!-- shows all products of the cart -->
        <table>
            <tr>
                <th class="th-image">Bild</th>
                <th class="th-name">Name</th>
                <th class="th-price">Preis pro Stück</th>
                <th class="th-amount">Anzahl</th>
                <th class="th-total">Preis</th>
            </tr>
            <?php $totalPrice=0; ?>
            <?php foreach($_SESSION['shoppingCart'] as $id => $quantity) : ?>
            <?php $db = $GLOBALS['db']; $product = \dwp\model\Products::findOne('id = '.$db->quote($id)); ?>
            <tr>
                <td class="td-image">
                    <div class="image">
                        <a href="index.php?c=productDetails&a=showProductDetails&id=<?=$id;?>">
                            <img src="<?=IMGPRODPATH.$product->image?>" alt="<?=$product->name?>">
                        </a>
                    </div>
                </td>
                <td class="td-name">
                    <a href="index.php?c=productDetails&a=showProductDetails&id=<?=$id;?>">
                        <?=$product->name?>
                    </a>
                </td>
                <td class="td-price">
                    <?php $price= $product->price;
                        if($product->discount != 0)
                        {
                            $price=round(($product->price*(100-$product->discount)/100),2);
                        }
                    ?>
                    <?= $price?> €
                </td>
                <td class="td-amount">
                    <?= $_SESSION['shoppingCart'][$id]['quantity'] ?>
                </td>
                <td class="td-total">
                    <?php  echo ($_SESSION['shoppingCart'][$id]['quantity']*$price)  ?> €
                </td>
            </tr>
            <?php  $totalPrice += ($_SESSION['shoppingCart'][$product->id]['quantity']*$price)  ?>
            <?php endforeach; ?>
        </table>

        <p class="total">Gesamt: <?php echo ($totalPrice) ?> €</p>

        <!-- form needed to place order -->
		<form action="index.php?c=pages&a=checkout" method="post">
            <p class="pay-method">Geben Sie Ihre Zahlungsmethode an:</p>
            <fieldset>
                <div class="paypal">
                    <input type="radio" id="pp" name="paymethod" value="PayPal" required>
                    <label for="pp"> PayPal</label> 
                </div>
                <div class="bill">
                    <input type="radio" id="re" name="paymethod" value="Rechnung">
                    <label for="re"> Rechnung</label>
                </div>
                <div class="credit">
                    <input type="radio" id="kk" name="paymethod" value="Kreditkarte">
                    <label for="kk"> Kreditkarte</label> 
                </div>
                <div class="prepayment">
                    <input type="radio" id="vk" name="paymethod" value="Vorkasse">
                    <label for="vk"> Vorkasse</label>
                </div>
            </fieldset>
			<div class="buy">
				<input name="buy" type="submit" value="Jetzt kaufen!"/>
			</div>
		</form>
        <?php endif; ?>
	</div>
</div>