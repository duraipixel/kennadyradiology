<?php
    if ( ($helper instanceof common_function) != true ) {
		$helper     = $this->loadHelper('common_function');
		$helper->getStoreConfig();
	}
?>

<div class="table-responsive" id="chechoutdivbind">
    <div id="hidecheckouttable">
    <?php
		include("_checkout_items_list.php");
	?>
    </div>
</div>
<div class="row border-bottom">
    <div class="col-sm-12 col-md-12 col-lg-8">
        <?php
		include("couponpage.php");
	?>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-4" id="divordersummarytab">
        <?php
		include("ordersummarytab.php");
	?>
        </table>
    </div>
</div>
<script src="<?php echo img_base; ?>/static/js/jquery-3.5.1.min.js"></script>
<script>
$(function() {


    $('.quantity').each(function() {
        var spinner = $(this),
            input = spinner.find('input[type="text"]'),
            btnUp = spinner.find('.quantity-up'),
            btnDown = spinner.find('.quantity-down'),
            min = input.attr('min'),
            max = input.attr('max'),
            step = parseFloat(input.attr('step'));
        //	console.log(step);

        btnUp.click(function() {
            //console.log(step);
            var oldValue = parseFloat(input.val());
            if (oldValue >= max) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue + step;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("blur");
        });

        btnDown.click(function() {
            //	console.log(step);
            var oldValue = parseFloat(input.val());
            if (oldValue <= min) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue - step;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("blur");
        });

    });

});
</script>