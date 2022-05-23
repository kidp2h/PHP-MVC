<tr>
    <?php if(!isset($idStore)) {?>
    <td><?=$order['store_id']?></td>
    <?php }?>
    <td><?=$order['username']?></td>
    <td class="action">
        <button class="button-icon see-detail" data-id="<?=$order['id']?>">
            <span>Xem chi tiết</span>
        </button>
    </td>
    <td><?=$order['created_at']?></td>
    <td><?=$order['total']?></td>
    <td class="status-bill">
        <?php if($order['status'] == 1) {?>
        <div class="lds-dual-ring"></div> 
        <?php } else if($order['status']==2) { ?>
        <i class="ion-checkmark-circled completed"></i>
        <?php } else { ?>
        <i class="ion-close-circled cancelled"></i>
        <?php }?>
        
    </td>
    <td class="action">
        <button class="button-icon remove" data-id='${product.id}' data-table='products'>
            <i class="ion-close-round"></i>
        </button>
        <button class="button-icon save" data-id='${product.id}' data-table='products'>
            <i class="ion-checkmark-round"></i>
        </button>
    </td>
</tr>