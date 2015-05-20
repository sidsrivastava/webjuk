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
class webjuk_folder
{
  /*
    Returns the HTML markup for a listing of all the folders and media files under a given folder
      $folder_path -- Path to the parent folder
      $config -- Configuration variables
  */
  function contents($folder_path, $config)
  {
    $content = "";
    $subfolders = webjuk_file_utilities::get_subfolders($folder_path);
    $subfiles = webjuk_file_utilities::get_subfiles($folder_path);

    $content .= "<table>";
    foreach ($subfolders as $key => $folder)
    {
      $content .= "<tr>";
      $content .= "<td>";
      $content .= "<input type=\"checkbox\" name=\"folder[]\" value=\"" . webjuk_url::get_path_url_argument($folder, $config) . "\" />";
      $content .= webjuk_html_utilities::html_img($config['folder_icon'], "folder icon");
      $content .= webjuk_html_utilities::html_link($config['script_name'] . "?path=" . webjuk_url::get_path_url_argument($folder, $config), webjuk_file_utilities::get_name_from_path($folder));
      $content .= "</td>";
      /* For folders, span each <td> so that it accounts for the ID3 tags displayed for the files */
      $content .= "<td colspan=\"" . count($config['cc_tags_light']) . "\"></td>";


      $content .= "<td width=\"5%\">";
      $content .= webjuk_html_utilities::html_link($config['script_name'] . "?stream=1&amp;path=" . webjuk_url::get_path_url_argument($folder, $config), "[stream]");
      $content .= "</td>";
      $content .= "</tr>";
    }

    foreach ($subfiles as $key => $file)
    {
      if (webjuk_permissions::file_viewable($file, $config))
      {
        $metadata = webjuk_id3_metadata::get_metadata_light($file, $config);

        $content .= "<tr>";
        $content .= "<td>";
        $content .= "<input type=\"checkbox\" name=\"file[]\" value=\"" . webjuk_url::get_path_url_argument($file, $config) . "\" />";
        $content .= webjuk_file::get_icon_graphic($file, $config);
        $content .= webjuk_html_utilities::html_link($config['script_name'] . "?path=" . webjuk_url::get_path_url_argument($file, $config), webjuk_file_utilities::get_name_from_path($file));
        $content .= "</td>";

       foreach($metadata as $key => $value)
       {
         $content .= "<td class=\"small\">";
         if ($key == "copyright")
         {
           if (webjuk_cc_metadata::has_license($metadata['copyright']))
             $content .= webjuk_html_utilities::html_img($config['cc_logo'], "Creative Commons");
         }
         else
           $content .= $value;
         $content .= "</td>";
       }

        $content .= "<td width=\"5%\">";
        $content .= webjuk_html_utilities::html_link($config['script_name'] . "?stream=1&amp;path=" . webjuk_url::get_path_url_argument($file, $config), "[stream]");
        $content .= "</td>";
        $content .= "</tr>";
      }
    }
    $content .= "</table>";

    return $content;
  }
}
?>
