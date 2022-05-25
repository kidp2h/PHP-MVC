<tr>
    <td>
        <div class="wrap-image">
            <img class="image-document i-product" src="<?=$store['banner'][0]?>" alt="Image product id ${product.id}">
            <button class="addImage" data-image='<?=json_encode($store['banner'])?>'><i class="ion-plus-round"></i></button>
        </div>
    </td>

    <td contenteditable="true" class="addressStore"><?=$store['address']?></td>


    <td class="action">
        <button class="button-icon remove" data-id='<?=$store['id']?>' data-table='products'>
            <i class="ion-trash-b"></i>
        </button>
        <button class="button-icon save" data-id='<?=$store['id']?>' data-table='products'>
            <i class="ion-document-text"></i>
        </button>
        <button class="button-icon link" data-id='<?=$store['id']?>' data-table='products'>
            <i class="ion-link"></i>
        </button>
    </td>
</tr>

