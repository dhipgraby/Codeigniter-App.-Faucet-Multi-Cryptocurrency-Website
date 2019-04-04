<section>
	<h2>Order store Items</h2>
	<p class="alert alert-info">Drag to order Items and then click 'Save'</p>
	<div id="orderResult"></div>
</section>

<input type="button" name="save" id ="save" value="save" class="btn btn-primary">

<script>

	$(function() {
     $.post('<?php echo base_url(); ?>admin/store/order_ajax', {}, function(data){
     	$('#orderResult').html(data);
     });
	

    $('#save').click(function(){

    	$('#orderResult').slideUp();
    	$('#orderResult').slideDown();
       
     oSortable = $('.sortable').nestedSortable('toArray');
     $.post('<?php echo base_url(); ?>admin/store/order_ajax', { sortable: oSortable}, function(data){ 
     
$('#orderResult').html(data);

    });

   });  

  });
</script>