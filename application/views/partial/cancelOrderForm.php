<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"> Cancel Order </h5>
            <button type="button" class="close custom-close" data-dismiss="modal" onclick="return closeModal()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="cancel_form">
        <div class="modal-body">
            <div>
                <h3> Order Reference : <?= $order_info->order_reference ?> </h3>
                <?php 
                if( isset( $itemInfo ) && !empty( $itemInfo ) ) {
                ?>
                <p> Product : <?= $itemInfo->product_name ?> #<?= $itemInfo->product_sku?></p>
                <?php 
                }
                ?>
            </div>
            <div>
                
                    <div class="form-group">
                        <label> Reason</label>
                        <div>
                            <input type="hidden" name="order_id" value="<?= $order_id ?>">
                            <input type="hidden" name="order_product_id" value="<?= $order_product_id ?>">
                            <textarea class="form-control" rows="3" name="cancel_reason" required></textarea>
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary custom-close" onclick="return closeModal()" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>

    </div>
</div>

<script>
$('form').on('submit', function (e) {

    e.preventDefault();
    var urls = '<?php echo BASE_URL; ?>my_orders/cancelOrder';
    $.ajax({
        type: 'post',
        url: urls,
        data: $('form').serialize(),
        dataType: 'json',
        beforeSend: function() {
            loading();
        },
        success: function (res) {
            unloading();
            console.log( res );
            if( res.error == 0 ) {
                $('#cancelOrderModal').modal('hide');
                location.reload();
            }
        }
    });

});
</script>