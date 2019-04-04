<?php

 function randLetter()
{
    $int = rand(0,51);
    $a_z = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $rand_letter = $a_z[$int];
    return  $rand_letter;
}


function timescript($time,$location,$id=NULL){

$script = '';

if($id != NULL){ $id = $id; }

$script  .= '<script>

var timeleft = '.$time.';
    var downloadTimer = setTimeout(function(){

        location.reload("'.$location.'");
    },3000);

$("#'.$id.'").remove();
    
    </script>';



return $script;


}

function windows_box($title,$body,$b_id,$b_title){

$window .= '';

$window .= '<div class="container w-75 p-3">
       
    <div class="card">
      <div class="card-header">
      '.$title.'
      </div>
      <div class="card-body">
   <span id="message"></span>
'.$body.'<br><button '.$b_id.' class="btn btn-primary">'.$b_title.'</button>
      </div>
    </div>
</div>';

return $window;


}

  function new_button($name,$id,$type,$attr = NULL){

  $btn = '';

  $btn .='<button id="'.$id.'" class="btn btn-'.$type.'" '.$attr.'>'.$name.'</button>';

  return $btn;

  }

function deposit_table($address){

$table = '';

$table .= '<table class="table"><th>Deposits of '.$address.'</th><tr>

<td>datetime</td>
<td>Amount</td>
<td>Hash</td>

</tr><tr>';

$url = "https://blockchain.info/address/".$address."?format=json";
$json = json_decode(file_get_contents($url), true);

$outs = $json['txs'];

    foreach ($outs as $txs) {
      
      $transactions=  $txs['out']; 

          foreach ($transactions as $key) {
            
              if ($key['addr'] == $address){ 

              $table .= '<tr><td>'.date("Y-m-d H:i:s", $txs["time"]).'</td>
              <td>'.$key["value"].'</td>
              <td>'.$txs["hash"].'</td></tr>';
                     
                    
                                            
      

              }
          }
    }

$table .= '</tr></table>';

return $table;

}


function alert_msg($content, $type){

$str = '';

$str .= '<div class="alert alert-'.$type.'" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button><p>'.$content.' <span id="countdowntimer"></span></p></div>';

return $str;

}

function modal_content($title,$content,$button, $id,$close=NULL){ 

if($close != NULL){

  $close = 'name="'.$close.'"';
}
else {  $close = 'data-dismiss="modal"'; }

$str = '';


$str .= '<div class="modal fade hide" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
   
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">'.$title.'</h5>
        <button type="button" class="close" '.$close.' aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
    '.$content.'
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" '.$close.'>Close</button>
        <button id="'.$id.'"type="button" class="btn btn-primary">'.$button.'</button>
      </div>

   
    </div>
  </div>
</div>';

return $str;
}

function add_meta_title($string) {

    $CI =& get_instance();
    $CI->data['meta_title'] = e($string) .'-'. $CI->data['meta_title'];
}

function btn_edit($uri){
	return anchor($uri, '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>');
}

function btn_delete($uri){
	return anchor($uri, '<i class="fa fa-times" aria-hidden="true"></i>', array(
   'onclick' => "return confirm('You are about to delete a record. This cannot be undone. Are you sure?');"
		));
}

function e($string) {

    return htmlentities($string);
}


function article_link($article) {

return anchor(

    'article/' . intval($article->id) . '/' . e($article->slug),
    '<h3>'. e($article->title). '</h3><br><p class="pubdate">' 
    .e($article->pubdate). '</p>');

}

function article_links($articles) {

    $string .= '<ul>';

    foreach ($articles as $article) {
    $string .='<li>';
    $string .= article_link($article);
     $string .= '</li>';
   }

     $string .= '</ul>';
         return $string;
}

function get_excerpt($article, $numwords = 25) {

    $string = '';
    $url = 'article/' . intval($article->id) . '/' . e($article->slug);
    $string .= '<div class="row"><div style="margin: 10px; background: #fbb728; width: 15%; padding: 8px; background-image: linear-gradient(#fbb728,#f7f7f7);" ><h4 align="center">'.e($article->pubdate) . '<br></h4></div>';
    $string .= '<div style="margin: 10px;"><h3>'. anchor($url, $article->title,'style="color:#000000;"') . '</h3></div></div>';
    $string .= '<div ><p>' .e(limit_to_numwords(strip_tags($article->body), $numwords)). '</p>';
    $string .= '<p>'. anchor($url,'Read more >' ,array('title' => e($article->title))) . '</p></div>';
    return $string;
}

function get_excerpt_lastarticles($article, $numwords = 10) {

    $string = '';
    $url = 'article/' . intval($article->id) . '/' . e($article->slug);
    $string .= '<div class="row"><div style="margin: 10px; background: #fbb728; width: 30%; padding: 8px; align: right;background-image: linear-gradient(#fbb728,#f7f7f7);" ><h4 align="center">'.e($article->pubdate) . '&nbsp;</h4></div></div>';
    $string .= '<div><h4>'. anchor($url, $article->title,'style="color:#000000;"') . '</h4></div>';
    $string .= '<div style="margin-right: 10px;"><p>' .e(limit_to_numwords(strip_tags($article->body), $numwords)). '</p>';
    $string .= '<p>'. anchor($url,'Read more >' ,array('title' => e($article->title))) . '</p></div>';
    return $string;
}

function limit_to_numwords($string, $numwords) {

    $excerpt = explode(' ', $string, $numwords + 1);
    if (count($excerpt) >= $numwords) {
        
        array_pop($excerpt);
    }

    $excerpt = implode(' ', $excerpt);
    return $excerpt;

}
/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable 
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        
        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';
        
        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}
if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}

//MENU FOR LOGGED IN USERS
function my_menu($array, $child = FALSE) {

$CI =& get_instance();
$str = '';

    if (count($array)) {

  
        foreach ($array as $item) {

            $active = $CI->uri->segment(1) == $item['slug'] ? TRUE : FALSE;

             if (isset($item['children']) && count($item['children'])){
               
    $str .= '<li class="nav-item dropdown">';
  $str .= $active ? 

  '<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="'. base_url(e($item['slug'])).'" >'. $item['title']. '<span class="caret"></span></a>' 

  :

   '<a class="nav-link dropdown-toggle active" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="'. base_url($item['slug']).'" >'. $item['title']. '<span class="caret"></span></a>';


 $str .= '<div class="dropdown-menu" aria-labelledby="navbarDropdown">'.my_menu($item['children'], TRUE);  

             }

             else {
        
        if($child == FALSE){

             $str .= $active ? ' <li class="nav-item active">' : ' <li class="nav-item">';
        }
               
                $str .= $child == FALSE ? '<a class="nav-link" href="'. base_url($item['slug']) .'">'. $item['title'] . '</a>' : '<a class="dropdown-item" href="'. base_url($item['slug']) .'">'. $item['title'] . '</a>';

            }

        $str .= $child == FALSE ? '</li>'. PHP_EOL : '' . PHP_EOL;
        }
        
             
        
    
    }
     

    return $str;
}
