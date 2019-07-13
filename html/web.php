<?php
include("testInput.php");
include("function.php");
if(isset($_GET["app"]) and isset($_GET["sec"])){
        $app = test_input($_GET["app"]); 
        $sec = test_input($_GET["sec"]); 
        if(isset($_GET["type"])){
        $type = test_input($_GET["type"]);
       }
       elseif(is_dir('Apps/' . $app)){
         $type = 'Apps/';
       }
       elseif(is_dir('MyApps/' . $app)){
         $type = 'MyApps/';
       }
       else{
         header('Location: desktop.php');
         exit();
       }
    }
if(isset($_GET["app"])){
    if(file_exists($type . "/" . $app . "/functions.php")){
        include($type . "/" . $app . "/functions.php");
	}
    if(isset($sec) && file_exists($type . "/" . $app . "/functions_" . $sec)){
        include($type . "/" . $app . "/functions_" . $sec);
    }
}
?>
<!DOCTYPE html>
<!--<Webdesk.me Making web aplications easy.>
    Copyright (C) 2017  Adam W. Telford

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
    
    
    While using this site, you agree to have read and accepted our terms 
    of use, cookie and privacy policy. Copyright 2017 Adam W. Telford. 
    All Rights Reserved.
    
    A link to the terms of use, cookie and privacy policy, and licences
    can be found at the bottom right corner of the menu bar by clicking 
    the exlmation point once loged in, and in the menu of the login page.-->
<html>
<head>
    <meta charset="utf-8">
<title><?php echo $wd_Title; ?></title>
   <meta http-equiv="content-language" content="ll-cc">
    <meta name="language" content="English">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="<?php echo $wd_Title; ?>">
    <meta name="description" content="Welcome to <?php echo $wd_Title; ?>.">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" width="device-width">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="copyright" content="&copy; <?php echo date("Y") . ' ' . $wd_Title; ?>">
    <link rel="apple-touch-icon" href="favicon.ico">
    <link rel="apple-touch-startup-image" href="favicon.ico">
<link rel="stylesheet" href="Plugins/bootstrap-4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="Plugins/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="Plugins/context.standalone.css">
<link href="Plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet"/>
<link href="Plugins/fullcalendar/fullcalendar.print.min.css" rel="stylesheet" media="print" />
<link rel="stylesheet" type="text/css" href="Theme/default.php">
<script src="Plugins/jquery.min.js"></script>
<script src="Plugins/bootstrap-4.3.1/js/bootstrap.min.js"></script>
<script src="Plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="Plugins/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="Plugins/fullcalendar/lib/moment.min.js"></script>
<script src="Plugins/fullcalendar/fullcalendar.min.js"></script>
<script defer src="Plugins/fontawesome-free/svg-with-js/js/fontawesome-all.min.js"></script>
<style>
  body:has(.sticky-top),body:has(.fixed-top),body:has(.sticky-top),body:has(.fixed-top){
    padding-top: 75px;
  }
</style>
<?php
include 'wd_ch.php';
if(isset($_GET["app"])){
        if(file_exists($type . "/" . $app . "/header.php")){
            include($type . "/" . $app . "/header.php");
		}
        if(isset($sec) && file_exists($type . "/" . $app . "/header_" . $sec)){
            include($type . "/" . $app . "/header_" . $sec);
		}
        if(file_exists($type . "/" . $app . "/style.css")){
          ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $type . "/" . $app . "/style.css"; ?>">
                                                                                          <?php
		}
        if(isset($sec) && file_exists($type . "/" . $app . "/style_" . $sec)){
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $type . "/" . $app . "/style_" . $sec; ?>">
  <?php
		}
    }
?>
  </head>
  <body>
    <!--<br><br><br>-->
  <div>
    <?php
  if(isset($_GET['wd_as'])){ ?>
<div class="alert alert-success alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success:</strong> <?php $wd = test_input($_GET['wd_as']); echo $wd; ?>
  </div>
<?php } if(isset($_GET['wd_ai'])){ ?>
<div class="alert alert-info alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Info:</strong> <?php $wd = test_input($_GET['wd_ai']); echo $wd; ?>
  </div>
<?php } if(isset($_GET['wd_aw'])){ ?>
 <div class="alert alert-warning alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning:</strong> <?php $wd = test_input($_GET['wd_aw']); echo $wd; ?>
  </div>
<?php } if(isset($_GET['wd_ad'])){ ?>
<div class="alert alert-danger alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Danger:</strong> <?php $wd = test_input($_GET['wd_ad']); echo $wd; ?>
  </div>
    <?php 
    }
    if(isset($_GET['link'])){ 
      ?>
<div class="alert alert-info alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Link <?php echo $wd_link->name; ?>:</strong><span> To close the conection to the shared folder open and return to you own files please <a href="desktop.php" class="alert-link">click here</a>.</span>
  </div>
  <?php
}
if(isset($_GET["app"]) and isset($_GET["sec"])){
  $sec = test_input($_GET["sec"]);
  if(isset($sec) && file_exists($type . "/" . $app . "/web-banner_" . $sec)){
    include($type . "/" . $app . "/web-banner_" . $sec);
  }
  elseif(file_exists($type . "/" . $app . "/web-banner.php")){
    include($type . "/" . $app . "/web-banner.php");
  }
  if(file_exists($type . "/" . $app . "/web-" . $sec)){
        include($type . "/" . $app . "/web-" . $sec);
  }
  if(isset($sec) && file_exists($type . "/" . $app . "/web-footer_" . $sec)){
    include($type . "/" . $app . "/web-footer_" . $sec);
  }
  elseif(file_exists($type . "/" . $app . "/web-footer.php")){
    include($type . "/" . $app . "/web-footer.php");
  }
  else{
    //include("404.php");
  }
}
    else{
?>
<h1>Welcome</h1>
<hr>
<p>To start an application just go to the app tab and click on the tab of your choice. You will see the application name on this tab. Click it to view.</p>
<p><b>Version: </b>1.0</p>
<a href="#">License</a><br>
<a href="#">Terms of Use</a><br>
<a href="#">Pricay Policy</a>
<?php
    }
     ?>
    <script src="Plugins/context.js"></script>
<?php
if(isset($_GET["app"])){
        if(file_exists($type . "/" . $app . "/script.js")){
          ?>
            <script src="<?php echo $type . "/" . $app . "/script.js"; ?>"></script>
                                                                                          <?php
		}
        if(isset($sec) && file_exists($type . "/" . $app . "/script_" . $sec)){
            ?>
            <script src="<?php echo $type . "/" . $app . "/script_" . $sec; ?>"></script>
  <?php
		}
    }
?>
    </div>
  </body>
</html>
