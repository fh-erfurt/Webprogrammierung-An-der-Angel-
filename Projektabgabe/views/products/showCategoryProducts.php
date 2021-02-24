<div class="category-wrapper">
    <h1><?=$category->name?></h1>

    <!-- filter button for mobile version -->
    <input type="checkbox" id="hamburg-filter">
    <label for="hamburg-filter" class="hamburg-filter">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
    </label>

    <!-- form needed to filter products -->
    <div class="filter">
        <form action="index.php?c=products&a=showCategoryProducts&id=<?=$category->id;?>" method="post">
            <h4>Preis</h4>
                <input type="text" id="priceMin" name="priceMin" placeholder="Min €" value=''/>
                <input type="text" id="priceMax" name="priceMax" placeholder="Max €" value=''/>

            <h4>Hersteller</h4>
            <?php $manufacturers = \dwp\model\Manufacturer::find(); ?>
            <?php foreach($manufacturers as $manufacturer) : ?>
                <li>
                <input type="checkbox" id="<?=$manufacturer->id;?>" name="manufacturer[]" value="<?=$manufacturer->id;?>" class="check"/>
                <label for="<?=$manufacturer->id;?>"><?=$manufacturer->name;?></label>
                </li>
            <?php endforeach; ?>

            <div class="input-submit">
                <input name="submit" type="submit" value="Filter anwenden"/>
            </div>
        </form>
    </div>
    
    <!-- shows products matching the category and the filters -->
    <div class="products">
        <?php if(empty($products)) : ?>
            <p>Keine Ergebnisse vorhanden!</p>
        <?php else : ?>

            <?php foreach($products as $product) : ?>
            <div class="product">
                <a href="index.php?c=productDetails&a=showProductDetails&id=<?=$product->id;?>"> 
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
                </a>
            </div>
            <?php endforeach; ?>
        <?php endif ; ?>
    </div>
</div>