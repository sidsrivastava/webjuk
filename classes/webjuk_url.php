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
class webjuk_url
{
  /*
    Converts a URL argument into a path
      $path_url_argument -- Path represented by a URL argument
      $config -- Configuration variables
  */
  function get_path($path_url_argument, $config)
  {
    /* Decode the URL argument */
    $path = urldecode(stripslashes($path_url_argument));

    /* Make sure falls under the alias to the folder containing the media files */
    if (substr($path, 0, strlen($config['alias'])) != $config['alias'])
      return NULL;

    $new_path = $config['base_folder_path'] . substr($path, strlen($config['alias']), strlen($path) - 1);

    if (is_dir($new_path) || is_file($new_path))
      return $new_path;

    return NULL;
  }

  /* 
    Converts a path into a URL argument
      $path -- Path to the file or folder
      $config -- Configuration variables
  */
  function get_path_url_argument($path, $config)
  {
    /* Make sure the path points to an existing file or folder */
    if (!is_dir($path) && !is_file($path))
      return NULL;

    /* Make sure the path falls under the base folder containing the media files */
    if (substr($path, 0, strlen($config['base_folder_path'])) != $config['base_folder_path'])
      return NULL;

    $new_path = $config['alias'] . substr($path, strlen($config['base_folder_path']), strlen($path) - 1);

    /* Encode the path */
    return urlencode(stripslashes($new_path));
  }

  /* 
    Returns the M3U URL for a path
      $path -- Path to a file or folder
      $config -- Configuration variables
  */
  function get_m3u_url($path, $config)
  {
    /* Make sure the path points to an existing file or folder */
    if (!is_dir($path) && !is_file($path))
      return NULL;

    /* Make sure the path falls under the base folder containing the media files */
    if (substr($path, 0, strlen($config['base_folder_path'])) != $config['base_folder_path'])
      return NULL;

    $new_path = $config['alias'] . substr($path, strlen($config['base_folder_path']), strlen($path) - 1);

    /* Encode the path */
    $encoded_path = str_replace(" ", "%20", $new_path);
    return "http://" . $config['host_name'] . $encoded_path;
  }
}
