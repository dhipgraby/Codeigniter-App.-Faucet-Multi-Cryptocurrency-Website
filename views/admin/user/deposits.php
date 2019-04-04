<h2>Deposits</h2>




<br>



<h4>Last deposits</h4>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <button type="button" class="btn btn-light"><b>Filter by</b></button>
    <button type="button" class="btn btn-outline-secondary" name="id" id="current_option">User ID</button>
    <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu">
      <a name="option" id="id" class="dropdown-item" href="#">User ID</a>
      <a name="option" id="name" class="dropdown-item" href="#">User name</a>
      <a name="option" id="address" class="dropdown-item" href="#">Deposit address</a>
      <a name="option" id="email" class="dropdown-item" href="#">Email</a>
        <a name="option" id="coin" class="dropdown-item" href="#">Coin</a>
              <a name="option" class="dropdown-item" id="status" href="#">Status</a>

    </div>
  </div>
  <input type="text" class="form-control" aria-label="Text input with segmented dropdown button" id="search_content">
  <button type="button" class="btn btn-primary" id="search">Search</button>
</div>

<br>
<span id="deposit_table"> <?php $this->load->view('admin/tables/deposit'); ?></span>

<script>
	

$('#search').click(function(event){
	event.preventDefault();


var content = $('#search_content').val();
var option = $('#current_option').attr('name');
			
			$.ajax({

			url: "<?php echo base_url(); ?>admin/deposits/table",
			type: "POST",
			data: { content : content, option : option, },

			success: function(data) {

					
			   $('#deposit_table').html(data);
               
				}

			});

	});


$('[name="option"]').on('click', function(){

var option_name = $(this).html();
var option = $(this).attr('id');
$('#current_option').html(option_name);
$('#current_option').attr('name',option);


 });




</script>