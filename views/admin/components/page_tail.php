
  </body>
<script type="text/javascript">

    
$('#mysearch').click(function(){

var id = $('#searchid').val();

if(id > 0){


window.location.href = "<?php echo base_url(); ?>admin/user/edit/"+id;

} else { alert('introduce a valid id'); }


});

    
    
$('#gback').click(function(){

window.history.go(-1);


});


$('#text_edit2').each(function(){
    var $this = $(this);
    var t = $this.val();
    $this.val(t.replace('&lt;','<').replace('&gt;', '>'));
});

$('#text_edit').each(function(){
    var $this = $(this);
    var t = $this.text();
    $this.html(t.replace('&lt;','<').replace('&gt;', '>'));
});
</script>

   <script src="<?php echo base_url(); ?>bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/5196d453fb.js"></script>
    

</html>
