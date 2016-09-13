<!--
/*
 * @support
 * http://www.opensourcetechnologies.com/contactus.html
 * sales@opensourcetechnologies.com
* */
-->
<?php echo $header; ?>
<?php echo $footer; ?>
?>
<script>
	$( document ).ready(function() {
	cart.addcart(<?php echo $product_id;?>);
	window.location="<?php echo $redirect ?>";
	});

</script>
	<?php
