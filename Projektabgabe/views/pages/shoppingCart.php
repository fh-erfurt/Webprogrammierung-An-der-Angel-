<div class="cart-wrapper">
    <h1>Warenkorb</h1>
    <div class="cart">
        <!-- checks if cart is empty -->
        <?php 
            $cartEmpty=true;
            if(empty($_SESSION['shoppingCart']))
            {
                $cartEmpty = true;
            }
            else
            {
                $cartEmpty = false;
            }
        ?>
        <!-- creates table with items in cart if it is not empty -->
        <?php if (!$cartEmpty) :?>
            <form>
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
                            <a href="index.php?c=productDetails&a=showProductDetails&id=<?=$id;?>">
                                <img src="<?=IMGPRODPATH.$product->image?>" alt="<?=$product->name?>">
                            </a>
                        </td>
                        <td class="td-name"> 
                            <a href="index.php?c=productDetails&a=showProductDetails&id=<?=$id;?>">
                                <?=$product->name?>
                            </a>
                        </td>
                        <td class="td-price">
                            <?php $price= $product->price;
                            // checks if product is on sale and calculates new price
                            if($product->discount != 0)
                            {
                                $price=round(($product->price*(100-$product->discount)/100),2);
                            }
                            ?>
                            <?= $price?> €
                        </td>
                        <td class="td-amount">
                            <input type="number" name="quantity[<?php echo ($id) ?>]" size="5" min="0" max="100" value="<?= $_SESSION['shoppingCart'][$id]['quantity'] ?>"/>
                        </td>
                        <td class="td-total">
                            <?php  echo ($_SESSION['shoppingCart'][$id]['quantity']*$price)  ?> €
                        </td>
                    </tr>
                    <?php  $totalPrice += ($_SESSION['shoppingCart'][$product->id]['quantity']*$price)  ?>
                    <?php endforeach; ?>
                </table>
                <div class="update-cart">
                    <input name="submit" type="submit" formaction="index.php?c=pages&a=shoppingCart" formmethod="post" value="Warenkorb aktualisieren"/>
                </div>
                <div class="pay">
                    <input name="submit" type="submit" formaction="index.php?c=pages&a=checkout" formmethod="post" value="Zur Kasse"/>
                </div>
            </form>
            <p class="total">Gesamt: <?php echo ($totalPrice) ?> €</p>
        <!-- if cart is empty show message -->
        <?php else :?>
            <p class="cart-empty">Der Warenkorb ist leer!</p>
        <?php endif;?>
    </div>
</div>