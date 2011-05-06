<?php
function get_page_id()
{
  if(isset($_GET['page_id']))
  {
    $page_id=intval($_GET['page_id']);
  }
  else if(isset($_POST['fb_sig_page_id']))
  {
    $page_id=$_POST['fb_sig_page_id'];
  }
  else if(isset($_REQUEST['signed_request']))
  {
     $signed_request = $_REQUEST["signed_request"];
     list($encoded_sig, $payload) = explode('.', $signed_request, 2); 
     $data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);


     if(isset($data['page']))
       $page_id=$data['page']['id'];
     else
       $page_id=false;
  }
  else
  {
    $page_id=false;
  }

  return $page_id;
}
?>
