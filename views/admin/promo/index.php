
<h2><i class="fas fa-user-graduate"></i> Promoters</h2>

<table class="table">
  
<tr>
  
<td><i class="fas fa-users"></i> Total Promoters</td>
<td><i class="fas fa-coins"></i> Total advert Share</td>
<td><i class="far fa-eye"></i> Yesterday views</td>
<td><i class="far fa-eye"></i> Total site views</td>
</tr>

<tr>
  <td><?php echo count($promoters); ?></td>
  <td><?php echo $total_share; ?></td>
    <td><?php echo $yesterday_views; ?></td>
      <td><?php echo $siteviews; ?></td>

</tr>


</table>
<br>

<h4>Top 25 promoters</h4>
<br>
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
      <a name="option" id="email" class="dropdown-item" href="#">Email</a>
      <a name="option" class="dropdown-item" id="boost" href="#">lvl</a>

    </div>
  </div>
  <input type="text" class="form-control" aria-label="Text input with segmented dropdown button" id="search_content">
  <button type="button" class="btn btn-primary" id="search">Search</button>
</div>

<br>
<span id="promo_table"> <?php $this->load->view('admin/tables/promoters'); ?></span>

<script>
  

$('#search').click(function(event){
  event.preventDefault();


var content = $('#search_content').val();
var option = $('#current_option').attr('name');
      
      $.ajax({

      url: "<?php echo base_url(); ?>admin/promoters/table",
      type: "POST",
      data: { content : content, option : option, },

      success: function(data) {

          
         $('#promo_table').html(data);
               
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