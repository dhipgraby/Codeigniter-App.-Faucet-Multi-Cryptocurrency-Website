

    <br />
  

<style type="text/css">
    #price, #oneDollarSatoshi
    {
        color: blue;
        font-size: larger;
    }
    .currencySymbol
    {
        vertical-align: top;
    }

    .unitDiv
    {
  
        border: solid 1px grey;
        border-radius: 5px;
        padding-right: 5px;
    }
        .unitDiv:hover
        {
            border: solid 1px black;
            border-radius: 5px;
        }
    .headerClass
    {
        margin: auto;
    }
    .timeStampDiv
    {
        font-size: small;
    }
    .refreshDiv
    {
        cursor: pointer;
        color: blue;
        font-size: medium;
    }
    .internalPriceDiv
    {
        padding: 10px;
    }
    .preDefined
    {
        cursor: pointer;
    }
    .satoshi
    {
        text-align: center;
    }
    .preDefinedTable
    {
        margin: auto;
    }

    .reload { font-family: Lucida Sans Unicode }

    .selectBox
    {
        display: inline-block;
        margin-left: auto;

    }


</style>


<div class="container" align="center">


      <div class="form-group" >
    <h4>Bitcoin Satoshi <b>to</b> <label class="currencyUnit">USD</label>
      

    <select id="currencySelect" >
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
            <option value="CNY">CNY</option>
            <option value="GBP">GBP</option>
            <option value="RUB">RUB</option>
            <option value="CAD">CAD</option>

        </select>

    <div class="selectBox">
        <select id="tickerSelect" class="chosen-select" style="width: 150px !important">
            <option value="Coindesk">Coindesk</option>
            <option value="BitcoinAverage">BitcoinAverage</option>
        </select>
    </div>

<!-- CURRENT PRICE --> 
        <div class="oneBitcoin">Current BTC ฿1 = <label class="currencySymbol">$</label><label id="oneBitcoin">x</label> <label class="currencyUnit">USD</label></div>

  <span style="font-size: 9px;">Click the Satoshi value or <label class="currencyUnit">USD</label> value to change it</span>
   


        </h4>
</div>

<div class="col-sm-12">
    


              
    <div class="col"><input type="text" value="1" id="unit" class="unitDiv">  <b>Satoshi</b> =
 <label class="currencyUnit">USD</label> <label class="currencySymbol">$</label><label id="price">0</label>
    </div>
<br>
<div class="col"><label class="currencySymbol"> $ </label><input type="text" value="1" id="dollarUnit" class="unitDiv" size="9" />
<b> <label class="currencyUnit">USD</label></b> = <label id="oneDollarSatoshi" class="preDefined">x</label> Satoshi = <label id="oneDollarBitcoin">x</label> BTC<br>

</div>
        
        <div class="refreshDiv">Refresh <span class=reload>&#x21bb;</span></div><span style="font-size: 9px;">- occurs every 100 seconds</span>

    <div class="refreshDiv"></div>

<br>
    <div class="col-10">     
        <h4>Btc/Satoshi Values:</h4>
        <label style="font-size: small;">Click the Satoshi value below to use that value above.</label>
        
   <div align="center" class="table-responsive">
        <table class="table">
            <tr>
                <td class="satoshi"><label class="preDefined">1 Satoshi</label></td>
                <td>= 0.00000001 ฿</td>
                <td></td>
            </tr>
            <tr>
                <td class="satoshi"><label class="preDefined">10 Satoshi</label></td>
                <td>= 0.00000010 ฿</td>
                <td></td>
            </tr>
            <tr>
                <td class="satoshi"><label class="preDefined">100 Satoshi</label></td>
                <td>= 0.00000100 ฿</td>

            </tr>
            <tr>
                <td class="satoshi"><label class="preDefined">1,000 Satoshi</label></td>
                <td>= 0.00001000 ฿</td>
                <td></td>
            </tr>
            <tr>
                <td class="satoshi"><label class="preDefined">10,000 Satoshi</label></td>
                <td>= 0.00010000 ฿</td>
                <td></td>
            </tr>
            <tr>
                <td class="satoshi"><label class="preDefined">100,000 Satoshi</label></td>
                <td>= 0.00100000 ฿</td>
          
            </tr>
            <tr>
                <td class="satoshi"><label class="preDefined">1,000,000 Satoshi</label></td>
                <td>= 0.01000000 ฿</td>
            
            </tr>
            <tr>
                <td class="satoshi"><label class="preDefined">10,000,000 Satoshi</label></td>
                <td>= 0.10000000 ฿</td>
                <td></td>
            </tr>
            <tr>
                <td class="satoshi"><label class="preDefined">100,000,000 Satoshi</label></td>
                <td>= 1.00000000 ฿</td>
                <td></td>
            </tr>


        </table></div>


    </div>
 </div>





<script type="text/javascript">
    
    var currencyUnit = "USD";
    var currencySymbol = "$";

    //var ajaxCall = "https://api.bitcoinaverage.com/ticker/" + currencyUnit;
    //var ajaxCall = "http://api.bitcoincharts.com/v1/weighted_prices.json";
    //var ajaxCall = "https://api.coindesk.com/v1/bpi/currentprice.json";
    var ajaxCall = "https://api.coindesk.com/v1/bpi/currentprice/" + currencyUnit + ".json";

    var tickerSelected = "Coindesk";


    $(document).ready(function () {

        
        $("#currencySelect").chosen({ width: "75px" }).change(function (event, params) {
            currencyUnit = params.selected
            //ajaxCall = "https://api.bitcoinaverage.com/ticker/" + currencyUnit;
            if (tickerSelected == "Coindesk") {
                    ajaxCall = "https://api.coindesk.com/v1/bpi/currentprice/" + currencyUnit + ".json";

            }
            if (tickerSelected == "BitcoinAverage")
            {
                    ajaxCall = "https://apiv2.bitcoinaverage.com/indices/global/ticker/short?crypto=BTC&fiat=" + currencyUnit;

                
            }
            setCurrencyUnit();
        });

        $("#tickerSelect").chosen({ width: "150px" }).change(function (event, params) {
            //alert(params.selected);
            if (params.selected == "Coindesk") {
                    ajaxCall = "https://api.coindesk.com/v1/bpi/currentprice/" + currencyUnit + ".json";

                
                tickerSelected = "Coindesk";
            }
            if (params.selected == "BitcoinAverage") {
                    ajaxCall = "https://apiv2.bitcoinaverage.com/indices/global/ticker/short?crypto=BTC&fiat=" + currencyUnit;

                
                tickerSelected = "BitcoinAverage";
            }

            //currencyUnit = params.selected
            //ajaxCall = "https://api.bitcoinaverage.com/ticker/" + currencyUnit;
            //ajaxCall = "http://api.coindesk.com/v1/bpi/currentprice/" + currencyUnit + ".json";
            //setCurrencyUnit();
            getPrice(ajaxCall);
        });

        
        getPrice(ajaxCall);


        var auto_refresh = setInterval(function () { // Do this
            updatePrice();
        }, 100000); // Every one hundred seconds

        //setTimeout("updatePrice()", 1000000);

        setCurrencyUnit();

        //Wait 15 seconds, then start the coin-hive miner if the checkbox is not unchecked
    

        var miner;
    });



    $('#unit').change(function () {
        updatePrice();

    });

    $('#dollarUnit').change(function () {
        updatePrice();

    });

    $('#unit').click(function () {
        //$(this).css('width', '175px');
        //$(this).css('width', '50px');
        var value = $(this).val();
        var size = value.length;

        if (size == 0)
            size = 3;
        if (size < 4)
            size = 3;

        size = size * 5; // average width of a char
        $(this).css('width', size * 3);
    });
    $('#dollarUnit').keyup(function () {
        //$(this).css('width', '50px');
        var value = $(this).val();
        var size = value.length;

        if (size == 0)
            size = 3;
        if (size < 4)
            size = 3;

        size = size * 5; // average width of a char
        $(this).css('width', size * 3);
        //$(this).select();

        setDollarSatoshi();
    });
    $('#unit').keyup(function () {
        //$(this).css('width', '50px');
        var value = $(this).val();
        var size = value.length;

        if (size == 0)
            size = 3;
        if (size < 4)
            size = 3;

        size = size * 5; // average width of a char
        $(this).css('width', size * 3);
        //$(this).select();

       
    });

    $('input').on('focus', function (e) {
        $(this)
            .one('mouseup', function () {
                $(this).select();
                return false;
            })
            .select();
    });

    $('.refreshDiv').click(function () {
        getPrice(ajaxCall);
        setPrice($('#unit').val().replace(/\,/g, ""));
    });

    $('.preDefined').click(function () {
        $('#unit').val($(this).html().replace("Satoshi", "").replace(" ", ""));
        updatePrice();

    });
    var oneCoinPrice = 0;

    function getPrice(url) {
        $.getJSON(url, function (data) {
            //data = JSON.parse(data);
            //alert(data);
            var items = [];
            
            $.each(data, function (key, val) {
                items.push("<li id='" + key + "'>" + key + " - " + val + "</li>");
                if (tickerSelected == "Coindesk") {
                    if (key == "bpi") {

                        $.each(val, function (key1, val1) {
                            //alert(key1);
                            if (key1 == currencyUnit) {
                                $.each(val1, function (key2, val2) {
                                    //alert(key2);
                                    if (key2 == "rate_float") {
                                        oneCoinPrice = val2;

                                        setPrice($('#unit').val().replace(/\,/g, ""));

                                    }

                                });
                            }
                        });
                    }

                    if (key == "time") {
                        $.each(val, function (key1, val1) {
                            if (key1 == "updated")
                                $('#timeStamp').html(val1);
                        });
                    }
                }
                if (tickerSelected == "BitcoinAverage")
                {
                    //alert("bitcoinaverage: " + key);
                    if (key == "BTC" + currencyUnit) {
                        //alert("key last found");
                        $.each(val, function (key1, val1) {
                            if (key1 == "last")
                            {
                                //alert("value: " + val1);
                                oneCoinPrice = val1;
                                setPrice($('#unit').val().replace(/\,/g, ""));

                            }
                        });
                    }
                    if (key == "timestamp")
                    {
                        $.each(val, function (key1, val1) {
                            $('#timeStamp').html(val1);
                        });
                    }
                }

            });
            //alert(items);

            //$("<ul/>", {
            //    "class": "my-new-list",
            //    html: items.join("")
            //}).appendTo("body");

            document.title = currencySymbol + oneCoinPrice.toFixed(2) + " " + currencyUnit + " Lotobitcoin.com";

            setDollarSatoshi();

        });

    }

    function setCurrencyUnit() {
        $('.currencyUnit').html(currencyUnit);
        switch (currencyUnit) {
            case "USD":
                currencySymbol = "$";
                break;
            case "CNY":
                currencySymbol = "¥";
                break;
            case "EUR":
                currencySymbol = "€";
                break;
            case "GBP":
                currencySymbol = "£";
                break;
            case "RUB":
                currencySymbol = "₽";
                break;
            case "CAD":
                currencySymbol = "$";
                break;

            default:
                currencySymbol = "";
        }

        $('.currencySymbol').html(currencySymbol);

        updatePrice();
    }
    function setPrice(satoshi) {

        $('#price').html(parseFloat(oneCoinPrice / 100000000 * satoshi ).toFixed(10));

    }

    function setDollarSatoshi()
    {
            
        //$('#oneDollarSatoshi').html(parseFloat(oneCoinPrice * 100).toFixed(0));
        //$('#oneDollarSatoshi').html(parseFloat(1 / oneCoinPrice * 100000000 / 1).toFixed(0));
        $('#oneDollarSatoshi').html(addCommas(parseFloat(1000 * $('#dollarUnit').val().replace(/\,/g, "") / oneCoinPrice * 100000).toFixed(0)));
        //var dollarSatoshi = $('#oneDollarSatoshi').html();
        //dollarSatoshi = addCommas(dollarSatoshi);
        //$('#oneDollarSatoshi').html(dollarSatoshi);
        $('#oneDollarBitcoin').html(parseFloat(parseFloat(1000 * $('#dollarUnit').val().replace(/\,/g, "") / oneCoinPrice * 100000).toFixed(0) * .00000001).toFixed(8));
        $('#oneBitcoin').html(parseFloat(oneCoinPrice).toFixed(2));

        
    }

    addCommas = function (input) {
        // If the regex doesn't match, `replace` returns the string unmodified
        return (input.toString()).replace(
          // Each parentheses group (or 'capture') in this regex becomes an argument 
          // to the function; in this case, every argument after 'match'
          /^([-+]?)(0?)(\d+)(.?)(\d+)$/g, function (match, sign, zeros, before, decimal, after) {

              // Less obtrusive than adding 'reverse' method on all strings
              var reverseString = function (string) { return string.split('').reverse().join(''); };

              // Insert commas every three characters from the right
              var insertCommas = function (string) {

                  // Reverse, because it's easier to do things from the left
                  var reversed = reverseString(string);

                  // Add commas every three characters
                  var reversedWithCommas = reversed.match(/.{1,3}/g).join(',');

                  // Reverse again (back to normal)
                  return reverseString(reversedWithCommas);
              };

              // If there was no decimal, the last capture grabs the final digit, so
              // we have to put it back together with the 'before' substring
              return sign + (decimal ? insertCommas(before) + decimal + after : insertCommas(before + after));
          }
        );
    };

    $.fn.addCommas = function () {
        $(this).each(function () {
            $(this).text(addCommas($(this).text()));
        });
    };

    $.fn.digits = function () { return this.each(function () { $(this).val($(this).val().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")); }) }

    function updatePrice() {

        getPrice(ajaxCall);
        setPrice($('#unit').val().replace(/\,/g, ""));
        

        var value = $('#unit').val();
        var size = value.length;

        if (size == 0)
            size = 3;

        size = size * 6; // average width of a char
        $('#unit').css('width', size * 3);

        value = $('#dollarUnit').val();
        size = value.length;

        if (size == 0)
            size = 3;

        size = size * 5; // average width of a char
        $('#dollarUnit').css('width', size * 3);
    }



</script>
</div>