<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
//session_start();
//include("testInput.php");
$dir = test_input($_POST["dir"]);
$file = test_input($_POST["file"]);
$con = htmlspecialchars_decode($wd_POST["con"], ENT_QUOTES);
file_put_contents($_SESSION['root'] . $dir . $file, $con);
wd_head($wd_type, $wd_app, 'MyPage.php', '&dir=' . $dir . '&file=' . $file . '&wd_as=Saved!');
?>
