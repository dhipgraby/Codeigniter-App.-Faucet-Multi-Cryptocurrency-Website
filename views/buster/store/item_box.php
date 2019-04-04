 <script>
function purch(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint2").innerHTML = this.response;

    }
  };
  xmlhttp.open("GET", "<?php echo base_url(); ?>overclock/purchase?item="+str, true);
  xmlhttp.send();
}
</script>


     <div class="modal" style="display: none;">
      <div class="modal-header">
         
          <button type="button" class="close"  id="btn1">&times;</button>
          <br>
          <h3 class="modal-title">Purchase</h3>
         
        </div> 
           
  <div class="modal-body">

        <form method="post">

          <span id="txtHint2">

     <input type="text" name="ctitle" id="ctitle" value="" readonly>
     <br>
     <input type="number" name="cprice" id="cprice" value="" readonly>
         </span>

   <br>


<input class="da-link button" type="submit" name="submit"  value="Confirm"><br>




</form>

</div>
<div class="modal-footer">
      <p>  Buster Faucet CA</p>
          <button type="button" class="btn btn-default" id="btnclose">Close</button>
              </div>
          </div>

  <table style=" margin: 5px;">

  
 <?php if($items): foreach($items as $item) : ?>
    <tr><td> <img style="border-radius: 8px;" height="126px" width="182px" src="<?php echo './uploads/'.$item->img; ?>" alt="project 1" /></th>


   <td><p><b><?php echo $item->title; ?></b></p>

    <p><b>Price: <?php echo number_format($item->price/100000000, 5); ?> BTC </b>
<br>
  <?php echo $item->body; ?> </p>
  <button style="float:right; margin-right: 5%; border-radius: 8px;"  id="btn2" onclick="purch(this.value)" class="da-link button" name="buy" value="<?php echo $item->id ?>">
    
    Purchase
  </button>



     <?php endforeach; endif; ?>
</td></tr>

</table>

  
<br>




    


      


