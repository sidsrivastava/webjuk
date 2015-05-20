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
class webjuk_navigation
{
  /*
    Returns the HTML markup for a breadcrumb trail for navigation
      $path -- Path to a file or folder
      $config -- Configuration variables
  */
  function breadcrumb_trail($path, $config)
  {
    /* NEEDS: This whole function is too much of a hack */

    $folder_fragments = explode("/", $path);
    $new_path = "";
    $content = "";
    $start_yet = FALSE;

    for ($i = 1; $i < count($folder_fragments); $i++) {
      $new_path .= "/" . $folder_fragments[$i];
      if ($new_path == $config['base_folder_path'])
        $start_yet = TRUE;
      if ($start_yet)
        $content .= webjuk_html_utilities::html_link($config['script_name'] . "?path=" . webjuk_url::get_path_url_argument($new_path, $config), $folder_fragments[$i]) . " / ";
    }
    return $content;
  }

  /*
    Returns the HTML markup for a drop-down menu that lets the user quickly browse to the folder "siblings" of a 
    given file or folder path
      $path -- Path to the file or folder
      $config -- Configuration variables 
  */
  function dropdown_siblings($path, $config)
  {
    if ($path == $config['base_folder_path'])
      return NULL;

    $siblings = webjuk_file_utilities::get_subfolders(webjuk_file_utilities::get_parent_folder($path));
    if (count($siblings) == 0)
      return NULL;

    $content = "";
 
    $content .= "<select name=\"siblings\" onChange=\"javascript:window.location.href='?path=' + options[selectedIndex].value;\">";

    for ($i = 0; $i < count($siblings); $i++) {
      $content .= "<option ";
      if ($siblings[$i] == $path)
        $content .= " selected ";
      $content .= " value=\"" . webjuk_url::get_path_url_argument($siblings[$i], $config) . "\">" . webjuk_file_utilities::get_name_from_path($siblings[$i]) . "</option>";
    }
    $content .= "</select>";
    return $content;
  }
}
?>
