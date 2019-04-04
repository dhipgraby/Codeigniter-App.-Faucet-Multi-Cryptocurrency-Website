
<div class="container">
  <div class="row">
 
    <div class="col-sm">
        
    </div>

    <div class="col-sm" >


      	<div class="btn-group m-4" role="group" aria-label="First group">

   		<?php echo new_button('Roll Low', '','dark submenu btn-lg', 'onClick="roll(2);" type="button"'); ?>
<?php echo new_button('Roll Hi', 'roll','dark submenu btn-lg', 'onClick="roll(1);" type="button"'); ?>

 </div>
 <br>
 <small><span class="m-3" id="under"></span><span class="m-3"  id="over"></span>
</small>

      <div class="col-sm">

    <p>Winning Change</p>
 <input class="form-control" id="multiplier" name="multiplier" value="<?php if(!isset($_POST['multiplier'])){ echo "47.5"; } else { echo $_POST['multiplier']; } ?>" placeholder="47.5" onchange="btcConvert(this); noteLimit(this, 4)" onkeyup="btcConvert(this); noteLimit(this, 4)" onkeydown="noteLimit(this, 4);"/>

    </div>

    	</div>

   
    <div class="col-sm">
       	
    </div>
  </div>
</div>
   	

<br>

<div class="container">
  <div class="row">
    
    <div class="col-sm">

    	<p>BET: </p><?php echo form_input('bet', '100', 'class="form-control" id="bet2" onchange="btcConvert(this); noteLimit(this, 6)" onkeyup="btcConvert(this); noteLimit(this, 6)" onkeydown="noteLimit(this, 6);"'); ?>
    	
    	<div class="btn-group m-2" role="group" aria-label="First group">
	   

	   <?php echo new_button('x2', 'doublebet','light', 'onClick="double()" type="button"'); ?>
       <?php echo new_button('Half', 'minbet','light', 'onClick="half()" type="button"'); ?>


</div>
   	<div class="btn-group m-2" role="group" aria-label="First group">

<?php echo new_button('Max', 'maxbet','light', 'onClick="Max()" type="button"'); ?>
<?php echo new_button('Min', 'minbet','light', 'onClick="Min()" type="button"'); ?>

</div>

    </div>

      
      <div class="col-sm">

    <p>PROFIT: </p>
<input class="form-control" id="reward_profit" value="0">

    </div>

    
    </div>
</div>
<script>
  

$("input:checkbox[name='coin']").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='coin']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});

</script>