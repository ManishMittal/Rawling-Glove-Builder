<!--
/*
 * @support
 * http://www.opensourcetechnologies.com/contactus.html
 * sales@opensourcetechnologies.com
* */
-->
<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
      <div class="row">
        <?php echo $rawlingsglovebuilder;?>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>

<?php if(isset($product_id))
{
?>
<div id="product<?php echo $product_id;?>">
	<input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control" />
	<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
	<?php
	foreach($options as $option) 
	{
	 	if ($option['type'] == 'textarea')
		{
			?>
			<textarea name="option[<?php echo $option['product_option_id']; ?>]" id="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['value']; ?></textarea>
			<?php
		}
	}
	?>
</div>

<script>
	$( document ).ready(function() {
	cart.add(<?php echo $product_id;?>);
	});
				var cart = 
				{
					'add': function(product_id) {
					$.ajax({
						url: 'index.php?route=checkout/cart/add',
						type: 'post',
						data: $('#product'+product_id+' input[type=\'text\'], #product'+product_id+' input[type=\'hidden\'], #product'+product_id+' textarea'),
						dataType: 'json',
						beforeSend: function() {
							$('#cart > button').button('loading');
						},
						complete: function() {
							$('#cart > button').button('reset');
						},			
						success: function(json) {
							$('.alert, .text-danger').remove();

							if (json['redirect']) {
								location = json['redirect'];
							}

							if (json['success']) {
								$('#content').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
								
								// Need to set timeout otherwise it wont update the total
								setTimeout(function () {
									$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
								}, 100);
							
								 $('#cart-total').html(json['total']);

         							 $('html, body').animate({ scrollTop: 0 }, 'slow');

          							$('#cart > ul').load('index.php?route=common/cart/info ul li');
							}
						}
					});
					}
				}
</script>


<?php
}
?>
