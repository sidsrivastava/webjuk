<?php
/*
  Copyright (C) 2006 Sid Srivastava 
 
  Permission is hereby granted, free of charge, to any person obtaining a
  copy of this software and associated documentation files (the
  "Software"), to deal in the Software without restriction, including
  without limitation the rights to use, copy, modify, merge, publish,
  distribute, sublicense, and/or sell copies of the Software, and to
  permit persons to whom the Software is furnished to do so, subject to
  the following conditions:
 
  The above copyright notice and this permission notice shall be included
  in all copies or substantial portions of the Software.
 
  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
  OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
  MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
  IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
  CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
  TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
  SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/
?>
<?php
  /* Non-user-interface libraries */
  require_once("classes/webjuk_playlist.php");
  require_once("classes/webjuk_url.php");
  require_once("classes/webjuk_file_utilities.php");
  require_once("classes/webjuk_events.php");
  require_once("classes/webjuk_cc_metadata.php");
  require_once("classes/webjuk_id3_metadata.php");
  require_once("classes/webjuk_permissions.php");

  /* User_interface libraries */
  require_once("classes/webjuk_html_utilities.php");
  require_once("classes/webjuk_file.php");
  require_once("classes/webjuk_folder.php");
  require_once("classes/webjuk_navigation.php");

  /* Third-party librariesraries */
  require_once("libraries/getID3/getid3.php");
  require_once("libraries/cc-license/cc-license.php");

  /* Config */
  require_once("config.php");
?>
<?php
  $submit_button = $HTTP_POST_VARS['submit'];
  $file_checkboxes = $HTTP_POST_VARS['file'];
  $folder_checkboxes = $HTTP_POST_VARS['folder']; 
  $stream_url_argument = $HTTP_GET_VARS['stream'];
  $path_url_argument = $HTTP_GET_VARS['path'];

  if ($_SERVER["SCRIPT_NAME"])
    $config['script_name'] = $_SERVER["SCRIPT_NAME"];
  else
    $config['script_name'] = $_SERVER["PHP_SELF"];
  $path = webjuk_url::get_path($path_url_argument, $config);
  if (!$path)
    $path = $config['base_folder_path'];

  if ($submit_button != NULL)
    webjuk_events::play($file_checkboxes, $folder_checkboxes, $config);

  if ($stream_url_argument == TRUE)
    webjuk_events::stream($path, $config);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo $config['css']; ?>" />
<script language="JavaScript" type="text/javascript">
<!--
function check_all() {
  for(i=0; i<document.forms[0].elements.length; i++) {
    document.forms[0].elements[i].checked=true;
  }
}
function uncheck_all() {
  for(i=0; i<document.forms[0].elements.length; i++) {
    document.forms[0].elements[i].checked=false;
  }
}
//-->
</script>
<title>webjuk</title>
</head>

<body>
<h1>webjuk</h1>

<form name="webjuk" method="post">

<div id="breadcrumb-trail">
<?php print webjuk_navigation::breadcrumb_trail($path, $config); ?>
</div>

<p>
<?php print webjuk_navigation::dropdown_siblings($path, $config); ?>
</p>

<?php if (is_dir($path)) {?>
<?php print webjuk_folder::contents($path, $config); ?>
<?php } ?>

<?php if (is_file($path)) {?>
<?php print webjuk_file::info($path, $config); ?>
<?php } ?>

<?php if (is_dir($path)) {?>
<p>
<a href="javascript:check_all()">[check all]</a>&nbsp;
<a href="javascript:uncheck_all()">[uncheck all]</a>
</p>
<?php } ?>

<?php if (is_dir($path)) {?>
<p><input type="submit" name="submit" value="stream" class="stream" /></p>
<?php } ?>

</form>
</body>
</html>
