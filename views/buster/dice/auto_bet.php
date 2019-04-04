   
<div class="container"  align="center">


<span id="autobet_result"></span> 

    

     </div>

  
<script>


var slideIndex = 1;
showBet(slideIndex);

var myIndex = 0;
//carousel();

$("[id=on]").click(function(){

$("[id=on]").removeClass("btn btn-secondary");
$("[id=on]").addClass("btn btn-light");
$(this).removeClass("btn btn-light");
$(this).addClass("btn btn-secondary");

});


  function currentBet(n) {

  showBet(slideIndex = n);
}

function showBet(n) {
  var i;
var x = document.getElementsByClassName("onbet")

  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }

  x[slideIndex-1].style.display = "block";
 
}


// the selector will match all input controls of type :checkbox
// and attach a click event handler 
$("input:checkbox[name='direction']").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='direction']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});

$("input:checkbox[name='onplay']").on('click', function() {
  var $box = $(this);
  if ($box.is(":checked")) {
  
    var group = "input:checkbox[name='onplay']";
    
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});

$("input:checkbox[name='onwin']").on('click', function() {
  var $box = $(this);
  if ($box.is(":checked")) {
  
    var group = "input:checkbox[name='onwin']";
    
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});

$("input:checkbox[name='onlose']").on('click', function() {
  var $box = $(this);
  if ($box.is(":checked")) {
  
    var group = "input:checkbox[name='onlose']";
    
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});

$("input:checkbox[name='hitmax']").on('click', function() {
  
  var $box = $(this);
  if ($box.is(":checked")) {
   
    var group = "input:checkbox[name='hitmax']";
   
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});




</script>