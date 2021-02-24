<div class="product-details-wrapper">
    <h1><?=$product->name?></h1>

    <!-- shows product information -->
    <div class="product-info">
        <div class="image">
            <img src="<?=IMGPRODPATH.$product->image?>" alt="<?=$category->name.': '.$product->name?>">
        </div>
        <div class="name">
            <h4><?=$product->name?></h4>
        </div>
        <div class="price">
            <?php if ($product->discount == 0) : ?>
                <?=$product->price?> EUR inkl. MwSt.
            <?php else : ?>
                <div class="reduced">
                    Angebot: <?=round(($product->price*(100-$product->discount)/100),2);?> EUR inkl. MwSt.
                </div>
            <?php endif;?>
        </div>
        <div class="amount">
            Anzahl: <?=$product->amount?>
        </div>
        <div class="size">
            Größe: <?=$product->size?>
        </div>
        <div class="weight">
            Gewicht: <?=$product->weight?>
        </div>
        <div class="manufacturer">
            Hersteller: <?=$manufacturer->name?>
        </div>
        <div class="material">
            Material: <?=$material->name?>
        </div>
        <div class="color">
            Farbe: <?=$color->name?>
        </div>
    </div>

    <!-- form needed to put the product into the cart -->
    <div class="add-to-cart">
        <form action="index.php?c=productDetails&a=showProductDetails&id=<?=$product->id;?>" method="post">
			<div class="quantity">
				<label for="quantity">
					Anzahl
				</label>
                <input type="number" id="quantity" name="quantity" min="1" max="100" value="1" required/>
			</div>
			<div class="buy-quantity">
				<input name="submit" type="submit" value="Zum Warenkorb hinzufügen"/>
			</div>
		</form>
    </div>
</div>