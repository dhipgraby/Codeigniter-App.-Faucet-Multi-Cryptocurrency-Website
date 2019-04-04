
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

var script = coinjs.script();
var decode = script.decodeRedeemScript('<?php echo $hash ?>');

var checklock = parseInt(decode.checklocktimeverify) * 1000;

var timelock = <?php echo time(); ?>;


    var cd = new Countdown({
        cont: document.querySelector('.countimer'),
        endDate: checklock,
        outputTranslation: {
            year: 'Years',
            week: 'Weeks',
            day: 'Days',
            hour: 'Hours',
            minute: 'Minutes',
            second: 'Seconds',
        },
        endCallback: null,
        outputFormat: 'minute|second',
    });
    cd.start();


if(timelock >  parseInt(decode.checklocktimeverify)){

$('#hash_result').html('<?php echo alert_msg('Ready to Claim', 'info'); ?>');

}

else {

$('#hash_result').html('<?php echo alert_msg('Faucet Recharging, wait timer end to Claim', 'info'); ?>');

}

</script>
