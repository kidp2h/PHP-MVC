<tr>
    <td>
        <div class="wrap-image" data-id="<?= $product->id ?>">
            <img class="image-document i-product" src="<?= $product->image[0] ?>" alt="">

        </div>
    </td>

    <td contenteditable="true" class="nameProduct"><?= $product->name ?></td>
    <td class="categoryProduct">

        <div id="select">
            <select id="selectCategory">
                <?php
                foreach (array_reverse($categories) as $category) {

                    if ($product->category_id == $category['id'])
                        echo "<option selected value='{$category['id']}'>{$category['title']}</option>";
                    else
                        echo "<option value='{$category['id']}'>{$category['title']}</option>";
                }

                ?>
            </select>
        </div>

    </td>
    <td contenteditable="true" class="priceProduct"><?= $product->price ?></td>
    <!-- <td contenteditable="true" class="priceSaleProduct">${product.sale}</td> -->
    <!-- <td class="rateProduct">
        <span class="input-number-decrement">–</span>
        <input class="input-number" type="text" value="${product.rate}" min="0" max="5" disabled>
        <span class="input-number-increment">+</span>
    </td> -->
    <td class="action">
        <button class="button-icon remove" data-id='<?= $product->id ?>' data-table='products'>
            <i class="ion-trash-b"></i>
        </button>
        <button class="button-icon save" data-id='<?= $product->id ?>' data-table='products'>
            <i class="ion-document-text"></i>
        </button>
    </td>
</tr>