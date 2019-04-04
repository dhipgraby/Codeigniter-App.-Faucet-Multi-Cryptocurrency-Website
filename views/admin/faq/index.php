  <script>
  
   function jump_to(id){



  window.location.href = '<?php echo base_url() ?>admin/faq/topic/'+id;   }
       

   
</script>  


              <section>
  <h2>FAQs</h2>
  <?php echo anchor('admin/faq/edit', '<i class="fa fa-plus" aria-hidden="true"></i> Add new FAQ'); ?>
<br>

<div class="input-group">

<?php if(count($topics)){

foreach($topics as $topic){


echo new_button($topic->topic,$topic->topic,'info','style="margin:7px;" onclick="jump_to(this.id);"');

}


} else echo ' no topics';

 ?>

</ul>

         

</div>
<br>

</section>