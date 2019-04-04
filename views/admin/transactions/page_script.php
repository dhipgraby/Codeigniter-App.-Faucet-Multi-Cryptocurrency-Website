
<script type="text/javascript">

function get_pages(category=null,id=null){
 
if(id != null){
	id = id;
}
else { id= 0; } 

$.ajax({

 url: "<?php echo base_url() ?>/admin/transactions/pages?category="+category+"&id="+id,
 type: "POST",
 data: { },

 success: function(data){

  
 $('#pages').html(data);

 }

});

}


function search(get=null,coin='null'){


if(get !=null){

var category = get;

}

var id = $('#userid').val();
      
      $.ajax({

      url: "<?php echo base_url(); ?>admin/transactions/full_table?id="+id+"&category="+category+"&coin="+coin,
      type: "POST",
      data: { },

      success: function(data) {
          
         $('#pagination').html(data);
               
        }

      });

}

</script>