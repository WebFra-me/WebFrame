<?php
////////////////////////////////////
// 
// WORDFRAME FUNCTION FILE
// 
////////////////////////////////////
include_once("includes/functions.inc.php");
class wordframe{
  
  public function generateRandomNumber($max){
    
     return rand(0,$max);
     
  }
  public function navBar($options, $navItems){
    
    global $wd_Title;
    
    $option = array();
    if(is_array($options)){
      
      $option["color"] = (!empty($options["color"])) ? $options["color"] : "light";
      $option["brand"] = (!empty($options["brand"])) ? $options["brand"] : $wd_Title;
      $option["brandLink"] = (!empty($options["brandLink"])) ? $options["brandLink"] : "//" . $_SERVER["HTTP_HOST"] . "/index.php?page=index.php";
      $option["showLogin"] = (!empty($options["showLogin"])) ? $options["showLogin"] : false;
      $option["showRegister"] = (!empty($options["showRegister"])) ? $options["showRegister"] : false;
      
    }
    $nav = array();
    if(is_array($navItems)){
      
      foreach($navItems as $key => $nitem){
        
        if(!is_array($nitem)){
          $temp = explode("|", $nitem);
          $nav[$key]["title"] = $temp[0];
          $nav[$key]["link"] = $temp[1];
        }
        
      }
      
    }
    
    $nav_id = $this->generateRandomNumber(1000000000);
    
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-<?php echo $option["color"] ?>">
      <a class="navbar-brand" href="<?php echo $option["brandLink"] ?>"><?php echo $option["brand"] ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-<?php echo $nav_id ?>" aria-controls="navbar-<?php echo $nav_id ?>" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars fa-fw fa-lg"></i>
      </button>
    
      <div class="collapse navbar-collapse" id="navbar-<?php echo $nav_id ?>">
        <ul class="navbar-nav ml-auto">
          <?php
          foreach($nav as $key => $item){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $item["link"] ?>"><?php echo $item["title"] ?></a>
            </li>
            <?php
          }
          
          if($option["showLogin"]){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="//<?php echo $_SERVER["HTTP_HOST"] ?>/index.php?page=login.php"><i class="fa fa-sign-in-alt fa-fw"></i> Login</a></a>
            </li>
            <?php
          }
          if($option["showRegister"]){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $proot . $register; ?>"><i class="fa fa-sign-in-alt fa-fw"><i class="fa fa-user fa-fw"></i> Sign Up</a></a>
            </li>
            
            <?php
          }
          ?>
        </ul>
      </div>
    </nav>
    <?php
  }
  
}//class definition
$wordframe = new wordframe();

//$wd_protect = "yes";
$wd_protect = "yes";
$_SESSION['wd_home'] = 'desktop.php';
function test_input($data) {
  
  return (!empty($data)) ? htmlspecialchars(stripslashes(trim($data))) : false;

}
require_once 'Plugins/htmlpurifier/library/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);
if(isset($_POST)){
  foreach($_POST as $key => $value){
    $_POST[$key] = $purifier->purify($value);
    $wd_POST[$key] = $value;
  }
}
if(isset($_GET)){
  foreach($_GET as $key => $value){
    $_GET[$key] = $purifier->purify($value);
    $wd_GET[$key] = $value;
  }
}
if(isset($_REQUEST)){
  foreach($_REQUEST as $key => $value){
    $_REQUEST[$key] = $purifier->purify($value);
    $wd_REQUEST[$key] = $value;
  }
}
function f_enc($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = str_replace(" ", "", $data);
   $data = preg_replace("/\s+/", "", $data);
   $data = strtolower($data);
   $data = strrev($data);
   $data = str_rot13($data);
   return $data;
    }
}
function f_dec($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = str_replace(" ", "", $data);
   $data = preg_replace("/\s+/", "", $data);
   $data = strtolower($data);
   $data = str_rot13($data);
   $data = strrev($data);
   return $data;
    }
}
function t_enc($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = str_replace(" ", "", $data);
   $data = preg_replace("/\s+/", "", $data);
   $data = strrev($data);
   $data = str_rot13($data);
   $data = base64_encode($data);
   return $data;
    }
}
function t_dec($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = str_replace(" ", "", $data);
   $data = preg_replace("/\s+/", "", $data);
   $data = base64_decode($data);
   $data = str_rot13($data);
   $data = strrev($data);
   return $data;
    }
}
function up_enc($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = str_replace(" ", "", $data);
   $data = preg_replace("/\s+/", "", $data);
   $data = str_rot13($data);
   $data = strrev($data);
   //$data = password_hash($data, PASSWORD_DEFAULT);
   $data = md5($data);
   return $data;
    }
}

//Functions
if(isset($_GET['adminView']) && isset($_SESSION['wd_adminView'])){
  unset($_SESSION['wd_adminView']);
}
$wd_root = "NA1";
$wd_roots = array();
if(file_exists("path.php") || file_exists("../../path.php")){
  if(file_exists("path.php"))
    include('path.php');
  else
    include("../../path.php");
  
  if(isset($wd_roots[$_SERVER['HTTP_HOST']])){
    $wd_root = test_input($wd_roots[$_SERVER['HTTP_HOST']]);
  }
  else{
    $wd_root = test_input($wd_roots['default']);
  }
  $pcolor = "#FFFFFF";
  if(isset($_SESSION["user"])){
    $back = file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Admin/back.txt');
    $color = file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Admin/color.txt');
    $wd_file = $wd_root . '/User/' . $_SESSION["user"] . '/Doc/';
    $wd_appFile = $wd_root . '/User/' . $_SESSION["user"] . '/App/';
    $wd_adminFile = $wd_root . '/User/' . $_SESSION["user"] . '/Admin/';
    $wd_extFile = $wd_root . '/User/' . $_SESSION["user"] . '/Ext/';
    $wd_tier = test_input(file_get_contents($wd_adminFile . 'tier.txt'));
    $_SESSION["uName"] = f_dec($_SESSION["user"]);
  }
  $wd_admin = $wd_root . '/Admin/';
  $wd_appr = $wd_root . '/App/';
  $wd_appDir = $wd_appr;
  
  if(!empty($_SESSION["tier"]) && ($_SESSION["tier"] != "tA") ){
    $wd_tierApps_temp = file_get_contents($wd_admin . $_SESSION["tier"] . '.json');
    $wd_tierApps_temp = json_decode($wd_tierApps_temp, TRUE);
    foreach($wd_tierApps_temp as $key => $value){
      if($key != 'HUD' && $key != 'MHUD' && $key != 'wd_chat' && $value == "Yes"){
        if (strpos($key, 'myApp_') !== false) {
          $key = str_replace("myApp_","", $key);
          $wd_tierApps[$key] = "MyApps";
        }
        else{
          $wd_tierApps[$key] = "Apps";
        }
      }
    }
  }
  else{
    $wd_tierDoc = array("all");
  }
  if(!empty($_GET["type"]) && !empty($_GET["app"]))
    $wd_appDir .= test_input($_GET["type"])."/".test_input($_GET["app"])."/";
    
  $wd_www = $wd_root . '/www/';
  if(file_exists($wd_admin . 'title.txt')){
    $wd_Title = file_get_contents($wd_admin . 'title.txt');
  }
  function get_number_of_user_alerts(){
    global $wd_root;
    $wd = 0;
    if ($handle = opendir($wd_root . '/User/' . $_SESSION["user"] . '/Sec/')) {
      while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
        $wd = $wd + 1;
        }
      }
    }
    return $wd;
  }
  if(isset($_GET['type'])){
  	$wd_type = test_input($_GET['type']);
  }
  else{
  	$wd_type = "";
  }
  if(isset($_GET['app'])){
  	$wd_app = test_input($_GET['app']);
  }
  else{
  	$wd_app = "";
  }
  if(isset($_GET['link'])){
    $urllink = test_input($_GET['link']);
    $link = explode('-', $urllink);
    if($wd_appr . $wd_app . '/' . $link[0] . '.json'){
      $obj = file_get_contents($wd_appr . 'Link/' . $link[0] . '.json');
      $obj = json_decode($obj);
      if($obj->pass == $link[1] && $obj->type != "hide"){
        if($obj->type != "up"){
        $wd_file = $wd_root . '/User/' . $obj->user . '/Doc/' . $obj->dirpath;
        }
        else{
          header("Location: desktop.php?type=Apps&app=Files&sec=up.php" . $GLOBALS['wd_url']);
      //return $wd_head;
      exit();
        }
      }
    }
  }
  if(isset($_GET['link'])){
    $GLOBALS['wd_url'] = '&link=' . $urllink;
  }
  else{
    $GLOBALS['wd_url'] = "";
  }
  function wd_url($wd_type, $app, $sec = 'start.php', $get = '') {
      echo $url = "desktop.php?type=" . $wd_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wd_url'];
     // return $url;
  }
  function wd_www($wd_page, $get = "") {
      echo $url = "index.php?page=" . $wd_page . $get . $GLOBALS['wd_url'];
     // return $url;
  }
  function wd_web($wd_type, $app, $sec, $get) {
      echo $url = "web.php?type=" . $wd_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wd_url'];
     // return $url;
  }
  function wd_var($wd_type, $app, $sec, $get) {
      $url = "desktop.php?type=" . $wd_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wd_url'];
      return $url;
  }
  function wd_urlFull($wd_type, $app, $sec, $get) {
      echo $url = "desktop_full.php?type=" . $wd_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wd_url'];
     // return $url;
  }
  function wd_varFull($wd_type, $app, $sec, $get) {
      $url = "desktop_full.php?type=" . $wd_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wd_url'];
      return $url;
  }
  function wd_urlSub($wd_type, $app, $sec, $get) {
      echo $url = "desktopSub.php?type=" . $wd_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wd_url'];
     // return $url;
  }
  function wd_webSub($wd_type, $app, $sec, $get) {
      echo $url = "webSub.php?type=" . $wd_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wd_url'];
     // return $url;
  }
  function wd_varSub($wd_type, $app, $sec, $get) {
      $url = "desktopSub.php?type=" . $wd_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wd_url'];
      return $url;
  }
  function wd_head($wd_type, $app, $sec, $get) {
      header("Location: desktop.php?type=" . $wd_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wd_url']);
      //return $wd_head;
      exit();
  }
  function wd_hweb($wd_type, $app, $sec, $get) {
      header("Location: web.php?type=" . $wd_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wd_url']);
      //return $wd_head;
      exit();
  }
  if(file_exists($wd_admin . 'appWeb.txt')){
    $wd_webRootDir = file_get_contents($wd_admin . 'appWeb.txt');
    $wd_AppWebRoot = 'web/' . $wd_webRootDir . '/';
  }
  else{
    $wd_webRoot = '';
  }
  function wd_deleteDir($dirPath) {
    
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            wd_deleteDir($file);
        } else {
            unlink($file);
        }
    }
    return rmdir($dirPath);
    
  }
  if(isset($_SESSION)){
  if(isset($_GET['wd_fullS'])){
  	if($_GET['wd_fullS'] == 'on'){
  		$_SESSION["wd_fullscreen"] = 'on';
  	}
  	else{
  		$_SESSION["wd_fullscreen"] = 'off';
  	}
  }
  }

  function wd_copy($src,$dst) {
      $dir = opendir($src);
      mkdir($dst);
      while(false !== ( $file = readdir($dir)) ) {
          if (( $file != '.' ) && ( $file != '..' )) {
              if ( is_dir($src . '/' . $file) ) {
                  wd_copy($src . '/' . $file,$dst . '/' . $file);
              }
              else {
                  copy($src . '/' . $file,$dst . '/' . $file);
              }
          }
      }
      closedir($dir);
  }
  function wd_image($image){
      //Read image path, convert to base64 encoding
      $imageData = base64_encode(file_get_contents($image));
      // Format the image SRC:  data:{mime};base64,{data};
      echo $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
  }
  function wd_zip($source, $destination)
  {
      if (!extension_loaded('zip') || !file_exists($source)) {
      //    echo 'Problem with file.<br>';
          return false;
      }
  //$destination = str_replace('\\', '/', realpath($destination));
      $zip = new ZipArchive();
      if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
    //      echo 'Problem with destination.<br>';
          return false;
      }
      else{
  		$zip->open($destination, ZIPARCHIVE::CREATE);
  	}

      //$source = str_replace('\\', '/', realpath($source));

  //    echo 'Source: ' . $source . '<br>Destination: ' . $destination . '<br>';
  //echo 'running ....<br>';
      if (is_dir($source) === true)
      {
          $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

          foreach ($files as $file)
          {
              $file = str_replace('\\', '/', $file);

              // Ignore "." and ".." folders
              if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                  continue;

             // $file = realpath($file);
  //echo $file . '<br>';
              if (is_dir($file) === true)
              {
  				$x = str_replace($source . '/', '', $file . '/');
  				//echo 'Dir: ' . $x . '<br>';
                  //$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                  $zip->addEmptyDir($x);
              }
              else if (is_file($file) === true)
              {
  				$x = str_replace($source . '/', '', $file);
  				//echo 'file: ' . $x . '<br>';
                  //$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                  $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
              }
          }
      }
      else if (is_file($source) === true)
      {
          $zip->addFromString(basename($source), file_get_contents($source));
      }

      return $zip->close();
  }

  function wd_zip_files($source, $destination)
  {
     $zip = new ZipArchive();
     if ($zip->open($destination, ZipArchive::CREATE)!==TRUE) {
      exit("cannot open <$destination>\n");
     }
    foreach (scandir($source) as $entry){
      if ($entry != "." && $entry != ".."){
        $zip->addFile($source . $entry, $entry);
      }
    }
    $zip->close();
  }

  function wd_confirm($wd_type, $app, $sec, $get, $id, $btn_text, $btn_style = "danger"){
  $link = "desktopSub.php?type=" . $wd_type . "&app=" . $app . "&sec=" . $sec . $get;
  echo '<button type="button" class="btn btn-' . $btn_style . '" data-toggle="modal" data-target="#' . $wd_type . '-' . $app . '-' . $id . '">' . $btn_text . '</button>

    <!-- Modal -->
    <div class="modal fade" id="' . $wd_type . '-' . $app . '-' . $id . '" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content shadow-lg">
          <div class="modal-header">
            <h4 class="modal-title">Warning: Are you sure?</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" style="text-align: center;">
            <p class="">You may inadvertently cause the systematic destruction of the universe and this <b>CANNOT</b> be undone!</b>
            <!--<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> -->
          </div>
          <div class="modal-footer">
            <a href="' . $link . '" class="btn btn-danger text-light">' . $btn_text . '</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>';
  }
  function wd_rand_color() {
      return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
  }
  function wd_UR_exists($url){
     $headers=get_headers($url);
     return stripos($headers[0],"200 OK")?true:false;
  }
  function wd_tier_protect($tier){
    if($tier !== $_SESSION["tier"] || "tA" !== $_SESSION["tier"]){
      session_destroy();
      header('Location: index.php?test=bad+tier');
      exit();
    }
  }
  function wd_siteDescription(){
    
    global $wd_admin;
    
    $site_name = @file_get_contents($wd_admin."description.txt");
    
    if(!$site_name)
      return "";
      
    return $site_name;
    
  }
  function wd_tier_div($tier1, $page1, $page2){
    if($tier === $_SESSION["tier"] || "tA" === $_SESSION["tier"]){
      header('Location: ' . $page1);
    }
    else{
      header('Location: ' . $page2);
    }
    exit();
  }
  function wd_owner_protect(){
    if(isset($_GET['link'])){
      session_destroy();
      header('Location: index.php?test=not owner');
      exit();
    }
  }
  function wd_owner_div($page1, $page2){
    if(!isset($_GET['link'])){
      header('Location: ' . $page1);
    }
    else{
      header('Location: ' . $page2);
    }
  }
  if(isset($_GET['link'])){
    $link = test_input($_GET['link']);
    $link = explode("-", $link);
    $link = $link[0];
    if(file_exists($wd_appr . 'Link/' . $link . '.json')){
      $wd_link = file_get_contents($wd_appr . 'Link/' . $link . '.json');
      $wd_link = json_decode($wd_link);
    }
  }
  if(isset($_SESSION['wd_adminView'])){
    $wd_file = $_SESSION['wd_adminView'];
  }
  
  function wd_nav($page, $color, $name, $login, $loc, $auto, $register){
    $nav_id = "navbar-" . rand(0,10000000);
      if(file_exists("www/Pages/nav.json")){
        if($auto == 'simple'){
          $proot = "index.php?page=";
        }
        else{
          $proot = "";
        }
        $obj = file_get_contents("www/Pages/nav.json");
        $obj = json_decode($obj);
      ?>
  <nav class="navbar navbar-expand-sm m-0 navbar-<?php echo ($color == "light") ? "light bg-light" : "inverse bg-dark"; echo ($loc == 'fixed') ? ' navbar-fixed-top': "" ?>">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#<?php echo $nav_id ?>" aria-controls="<?php echo $nav_id ?>" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars fa-fw"></i>
        </button>
        <?php
      if($name != ""){
      ?>
        <a class="navbar-brand text-dark" href="//<?php echo $_SERVER["HTTP_HOST"] ?>/index.php?page=index.php"><?php echo $name; ?></a>
        <?php
      }
      ?>
      </div>
      <div class="collapse navbar-collapse" id="<?php echo $nav_id ?>">
        <ul class="navbar-nav mr-auto">
          <?php
        $i = 1;
          while($i <= 9){
        foreach($obj as $opage){
          if($opage->par == "np" && $opage->pr == $i){
            $x = 1;
            foreach($obj as $cpage){
              if($cpage->par == $opage->page){
                $x = 2;
              }
          }
      ?>
          <li<?php if(isset($obj->$page->par)){if($x == 2 && $page == $opage->page || $obj->$page->par == $opage->page){
      echo ' class="dropdown active"';
      }else{
            if($x == 2){
        echo  ' class="dropdown"';
      }
            if($page == $opage->page){echo ' class="active"';}}}
            else{
            if($x == 2){
        echo  ' class="dropdown"';
      }
            if($page == $opage->page){echo ' class="active"';}} ?>><a<?php if($x == 2){ echo ' class="dropdown-toggle" data-toggle="dropdown"';} ?> href="<?php if($x == 2){
        echo '#';
      }
            else{ echo 'index.php?page=' . $opage->page;} ?>"><?php echo $opage->title; if($x == 2){ echo '<span class="caret"></span>';} ?></a>
  <?php
            if($x == 2){
             ?>
          <ul class="dropdown-menu">
            <li><a href="<?php echo 'index.php?page=' . $opage->page; ?>"><?php echo $opage->title; ?></a></li>
            <?php
              $z = 1;
          while($z <= 9){
              foreach($obj as $spage){
                if($spage->par == $opage->page && $spage->pr == $z){
              ?>
            <li><a href="<?php echo 'index.php?page=' . $spage->page; ?>"><?php echo $spage->title; ?></a></li>
            <?php
                }
              }
            $z = $z + 1;
          }
              ?>
          </ul>
          <?php
            }
          ?>
          </li>
            <?php
          }
      }
            $i = $i + 1;
          }
      ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
      if($register != ""){
      ?>
          <li class="<?php echo ($register == $page) ? 'active' : ''; ?>"><a href="<?php echo $proot . $register; ?>" class="text-dark"><i class="fa fa-user fa-fw"></i> Sign Up</a></li>
          <?php
      }
      if($login == "yes"){
      ?>
          <li><a href="index.php?page=login.php" class="text-dark"><i class="fa fa-sign-in-alt fa-fw"></i> Login</a></li>
          <?php
    }
      ?>
        </ul>
      </div>
    </div>
  </nav>
  <?php
    }
  }
}
include 'webHull.php';
?>
