
<div class="col-md-12 col-sm-12 col-xs-12 nopad section-title"> Brand Tie-ups </div>
<div class="col-md-12 col-sm-12 col-xs-12 nopad ">
  <div class="product-owlbg">
    <div class="logoslider-small">
      <?php foreach($getbrandtieuplogo as $barndtieuplogo){ ?>
      <a href="<?php echo BASE_URL.$barndtieuplogo['tieupurl']; ?>"  target="_balnk">
      <div class="item"><img src="<?php echo BASE_URL;?>uploads/tieupimage/<?php echo $barndtieuplogo['tieupimage']; ?>"  alt="" ></div>
      </a>
      <?php } ?>
    </div>
  </div>
</div>
