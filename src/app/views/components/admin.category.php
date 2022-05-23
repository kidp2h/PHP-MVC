<tr>
    <td>
        <div class="wrap-image">
        <img class="image-document i-category" src="<?=$category['image']?>" alt="Image product id <?=$category['id']?>">
        <button class="changeImage" data-id="<?=$category['id']?>">
            <i class="ion-plus-round">
            <input type="file" name="changeImage" id="inputChangeImage"  style="display: none;" accept="image/*">
            </i>
        </button>
        </div>
    </td>
    <td contenteditable="true" class="nameCategory"><?=$category['title']?></td>
    <td class="action">
        <button class="button-icon remove" data-id='${product.id}' data-table='products'>
            <i class="ion-trash-b"></i>
        </button>
        <button class="button-icon save" data-id='${product.id}' data-table='products'>
            <i class="ion-document-text"></i>
        </button>
    </td>
</tr>

