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
/* Wrapper for getID3() */
class webjuk_id3_metadata
{
  /*
    Returns an array containing ID3 tag information, Creative Commons licensing information, and other metadata for a media file
      $file_path -- Path to the file
      $config -- Configuration variables
  */
  function get_metadata($file_path, &$config)
  {
    $getID3 = new getID3;
    $getID3_metadata = $getID3->analyze($file_path);
    $id3v1_metadata = $getID3_metadata['id3v1'];
    $id3v2_metadata = $getID3_metadata['id3v2'];

    $webjuk_metadata = array();

    /* Map getID3() metadata to our own metadata format */
    foreach ($config['cc_tags_full'] as $tag)
    {
      if ($tag == "copyright")
      {
        $webjuk_metadata[$tag] = $id3v2_metadata['comments']['copyright'][0];
      }
      else
        $webjuk_metadata[$tag] = $id3v1_metadata[$tag];
    }
    return $webjuk_metadata;
  }

  /*
    Returns an array containing only certain metadata for a media file 
      $file_path -- Path to the file
  */
  
  /*
    Returns an array containing ID3 tag information, Creative Commons licensing information, and other metadata for a media file
      $file_path -- Path to the file
      $config -- Configuration variables
  */
  function get_metadata_light($file_path, &$config)
  {
    $full_webjuk_metadata = webjuk_id3_metadata::get_metadata($file_path, $config);
    $light_webjuk_metadata = array();

    foreach ($config['cc_tags_light'] as $tag)
      $light_webjuk_metadata[$tag] = $full_webjuk_metadata[$tag];
    return $light_webjuk_metadata;
  }

}
