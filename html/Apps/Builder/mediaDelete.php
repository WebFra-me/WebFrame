<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
if(isset($_GET['media'])){
  $media = test_input($_GET['media']);
  if($media != ""){
    unlink("www/Media/" . $media);
  }
}
wd_head($wd_type, $wd_app, 'pmedia.php', '');
?>
