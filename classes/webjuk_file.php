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
class webjuk_file
{
  /*
    Returns the HTML markup for detailed information about a media file
      $file_path -- Path to the file
      $config -- Configuration variables
  */
  function info($file_path, $config)
  {
    $content = "<h2>metadata</h2>";

    $metadata = webjuk_id3_metadata::get_metadata($file_path, $config);

    /* Creative Commons section */
    $cc_license = webjuk_cc_metadata::get_license_from_notice($metadata['copyright']);
    $content .= webjuk_file::cc_license_notice($cc_license, $config);


    $content .= "<table>";
    $content .= "<tr><th>file:</th><td>" . webjuk_file_utilities::get_name_from_path($file_path) .  "</td></tr>";

    foreach($metadata as $key => $value)
      $content .= "<tr><th>$key</th><td>$value</td></tr>";
    $content .= "</table>";


    $content .= "<p>" . webjuk_html_utilities::html_link( webjuk_url::get_m3u_url($file_path, $config), "[download]") . "&nbsp;" . webjuk_html_utilities::html_link($config['script_name'] . "?stream=1&amp;path=" . webjuk_url::get_path_url_argument($file_path, $config), "[stream]") . "</p>";

    return $content;
  }

  /*
    Displays a box containing Creative Commons licensing information 
      $cc_license -- Creative Commons license
      $config -- Configuration variables
  */
  function cc_license_notice(&$cc_license, $config)
  {
    if (!$cc_license) return NULL;
    $content .= "<div id=\"cc-license\">";

    /* Display symbols for Creative Commons permissions */
    $symbols = $cc_license->get_symbols();
    foreach ($symbols as $alt => $src)
      $content .= webjuk_html_utilities::html_img($config[$src], $alt);

    $content .= "<br />This work is licensed under a <a href=\"" . $cc_license->uri . "\">" . $cc_license->name . "</a> license";

    $content .= "</div>";
    return $content;
  }

  /*
    Returns the markup for an icon graphic corresponding to a particular file
      $file_path -- Path to a file
      $config -- Configuration variables
  */
  function get_icon_graphic($file_path, $config)
  {
    if (!is_file($file_path))
      return NULL;
    return webjuk_html_utilities::html_img($config['file_icon'], "Icon graphic");
  }
}
?>
