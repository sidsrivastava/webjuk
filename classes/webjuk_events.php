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
class webjuk_events
{
  /*
    Event triggered when the play button is pushed
      $file_checkboxes -- Array of files that have been checkboxed
      $folder_checkboxes -- Array of folders that have been checkboxed
      $config -- Configuration variables
  */
  function play($file_checkboxes, $folder_checkboxes, $config)
  {
    $files = array();
    $folders = array();

    /* Convert the file and folder URL arguments into paths */
    for ($i = 0; $i < count($file_checkboxes); $i++) 
    {
      $files[] = webjuk_url::get_path($file_checkboxes[$i], $config);
    }
    for ($i = 0; $i < count($folder_checkboxes); $i++) 
    {
      $folders[] = webjuk_url::get_path($folder_checkboxes[$i], $config);
    }
    if ($files || $folders) 
    {
      webjuk_playlist::serve_playlist($files, $folders, $config);
      die();
    }
  }

  /* '
    Event triggered when the stream flag is passed as a URL argument
      $path -- Path to the file or folder represented by the URL argument
      $config -- Configuration variables
  */
  function stream($path, $config)
  {
    if (is_file($path))
      webjuk_playlist::serve_playlist(array($path), array(), $config);
    if (is_dir($path))
      webjuk_playlist::serve_playlist(array(), array($path), $config);
    die();
  }
}
