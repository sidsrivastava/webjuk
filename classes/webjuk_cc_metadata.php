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
class webjuk_cc_metadata
{
  /*
    Extracts Creative Commons licensing information from a media file
      $file_path -- Path to a media file
  */
  function get_license_from_file($file_path)
  {
    $getID3 = new getID3;
    $getID3_metadata = $getID3->analyze($file_path);
    $id3v2_metadata = $getID3_metadata['id3v2'];

    /* Get copyright notice embedded in the file */
    $copyright_notice = $id3v2_metadata['comments']['copyright'][0];

    /* Make sure it's the notice is for a Creative Commons license */
    if ($copyright_notice == NULL)
      return NULL;

    return webjuk_cc_metadata::get_license_from_notice($copyright_notice);
  }

  /*
    Extracts Creative Commons licensing information from the copyright notice of a media file.
      $file_path -- Path to a media file
  */
  function get_license_from_notice($copyright_notice)
  {
    /* Make sure it's the notice is for a Creative Commons license */
    if ($copyright_notice == NULL)
      return NULL;

    /* Parse URLs. TODO: clean up regexp code */
    $urls_pattern = "/http\:\/\/.*/";
    preg_match($urls_pattern, $copyright_notice, $matches);
    $urls = split(" verify at ",$matches[0]);
    $cc_license_uri =  $urls[0];

    /* Remove the trailing slash in the Creative Commons license URI */
    if (substr($cc_license_uri, -1) == "/")
      $cc_license_uri = substr($cc_license_uri, 0, -1);

    /* Find the corresponding Creative Commons license for this work */
    return find_license_by_uri ($cc_license_uri);
  }

  /*
    Determines whether a copyright notice contains Creative Commons licensing information
      $copyright_notice -- Copyright notice embedded in a media file.
  */
  function has_license($copyright_notice)
  {
    /* Determine whether the notice is for a Creative Commons license */
    /* TODO: find a better way to detect Creative Commons license */
    return ($copyright_notice != NULL);
  }
}
?>
