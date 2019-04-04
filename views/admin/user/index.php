           
<script>
function paginator(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("paginator").innerHTML = this.response;

    }
  };
  xmlhttp.open("GET", "<?php echo base_url(); ?>admin/user/paginator?page="+str, true);
  xmlhttp.send();
}
</script>
              <section>
  <h2>Users</h2>
  <?php echo anchor('admin/user/edit', '<i class="fa fa-plus" aria-hidden="true"></i> Add new user'); ?>
  
<br>
  <br>

  <h3>
<i class="fas fa-users"></i> Total users.
      <br>
<?php echo $total_users; ?></h3>
      <br>

  <h3>
<i class="fas fa-user-edit"></i></i>New users register info.
 
</h3>
     <br>
<table class="table">
  
  <tr>
    <td><i class="fas fa-user-plus"></i></td>
    <td><b>Today</b></td>
        <td><b>Yesterday</b></td>
            <td><b>Las 7 days</b></td>
                <td><b>Last 30 days</b></td>
  </tr>

<tr>
  <td></td>
  <td><?php echo $today_users; ?></td>
    <td><?php echo $yesterday_users; ?></td>
      <td><?php echo $weekly_users; ?></td>
        <td><?php echo $monthly_users; ?></td>


</tr>
</table>

      <br>

 
</section>