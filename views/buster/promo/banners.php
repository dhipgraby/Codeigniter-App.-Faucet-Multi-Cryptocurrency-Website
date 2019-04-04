<!-- 1ST -->
<div class="input-group mb-3 w-80">
   <button class="tooltiptext btn btn-light" id="tooltip300" onclick="myFunction(300)">Click on to copy</button> 
  <div class="input-group-prepend">

  
    <span  class="input-group-text" id="basic-addon1"><b> 300 x 250</b>
    </span>
  </div>



<?php echo form_input('banner','<a href="'.base_url().'main?ref='.$this->session->id.'"><img src="'.base_url().'images/banner/squarebanner.gif"></a>','class="form-control"  onclick="myFunction(this.id)" id="300"  readonly') ?>
 
</div>
<br>
<a href="<?php echo base_url() ?>main?ref=<?php echo $this->session->id; ?>"><img src="<?php echo base_url() ?>images/banner/squarebanner.gif"></a>
<br>


<br>
<!-- 2ST -->
<div class="input-group mb-3 w-80">
   <button class="tooltiptext btn btn-light" id="tooltip234" onclick="myFunction(234)">Click on to copy</button> 
  <div class="input-group-prepend">

  
    <span  class="input-group-text" id="basic-addon1"><b> 234x60</b>
    </span>
  </div>



<?php echo form_input('banner','<a href="'.base_url().'main?ref='.$this->session->id.'"><img src="'.base_url().'images/banner/banner234.gif"></a>','class="form-control" onclick="myFunction(this.id)" id="234"  readonly') ?>
 
</div>
<br>
<a href="<?php echo base_url() ?>main?ref=<?php echo $this->session->id; ?>"><img src="<?php echo base_url() ?>images/banner/banner234.gif"></a>
<br>

<br>

<!-- 3ST -->
<div class="input-group mb-3 w-80">
   <button class="tooltiptext btn btn-light"  id="tooltip728" onclick="myFunction(728)">Click on to copy</button> 
  <div class="input-group-prepend">

  
    <span  class="input-group-text" id="basic-addon1"><b> 728x90</b>
    </span>
  </div>


<?php echo form_input('banner','<a href="'.base_url().'main?ref='.$this->session->id.'"><img src="'.base_url().'images/banner/banner728.gif"></a>','class="form-control" onclick="myFunction(this.id)" id="728"   readonly') ?>
 
</div>
<br>

<a href="<?php echo base_url() ?>main?ref=<?php echo $this->session->id; ?>"><img src="<?php echo base_url() ?>images/banner/banner728.gif"></a>
<br>

<br>

<!-- 4ST -->

<div class="input-group mb-3 w-80">
   <button class="tooltiptext btn btn-light"  id="tooltipjackpot" onclick="myFunction('jackpot')">Click to copy</button> 
  <div class="input-group-prepend">

  
    <span  class="input-group-text" id="basic-addon1"><b> Jackpot 300x300</b>
    </span>
  </div>


<?php echo form_input('banner','<a href="'.base_url().'main?ref='.$this->session->id.'"><img src="'.base_url().'images/banner/jackpot.png"></a>','class="form-control" onclick="myFunction(this.id)" id="jackpot"  readonly') ?>
 
</div>
<br>

<a href="<?php echo base_url() ?>main?ref=<?php echo $this->session->id; ?>"><img style="withd:300px;height:300px;" src="<?php echo base_url() ?>images/banner/jackpot.png"></a>
<br>

<br>
<!-- 5ST -->
<div class="input-group mb-3 w-80">
   <button class="tooltiptext btn btn-light" id="tooltipvert" onclick="myFunction('vert')">Click on to copy</button> 
  <div class="input-group-prepend">

  
    <span  class="input-group-text" id="basic-addon1"><b>Vertical 120x600</b>
    </span>
  </div>

<?php echo form_input('banner','<a href="'.base_url().'main?ref='.$this->session->id.'"><img src="'.base_url().'images/banner/verticalbanner.gif"></a>','class="form-control" onclick="myFunction(this.id)" id="vert"   readonly') ?>
 
</div>
<br>
<br>

<a href="<?php echo base_url() ?>main?ref=<?php echo $this->session->id; ?>"><img src="<?php echo base_url() ?>images/banner/verticalbanner.gif"></a>


<br>
<script>
function myFunction(id) {
  var copyText = document.getElementById(id);
  copyText.select();
  document.execCommand("copy");
  
  var tooltip = document.getElementById('tooltip'+id);
  tooltip.innerHTML ="Copied to clipboard!";
}


</script>