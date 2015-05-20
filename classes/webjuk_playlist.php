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
class webjuk_playlist
{
  /*
    Serves an M3U playlist containing links to media files, or all the media files under certain folders
      $folders -- Array of paths to different folders
      $files -- Array of paths to different files
      $config -- Configuration variables
  */
  function serve_playlist($files, $folders, $config)
  {
    /* Creates headers for an M3U file, named playlist.m3u */
    header("Content-type: audio/x-mpegurl");
    header("Content-disposition: inline; filename=playlist.m3u");

    $playlist = "";
    $playlist .= "#EXTM3U\n";

    for ($i = 0; $i < count($files); $i++)
      webjuk_playlist::add_file($files[$i], $playlist, $config);
    for ($i = 0; $i < count($folders); $i++)
      webjuk_playlist::add_folder($folders[$i], $playlist, $config);

    echo $playlist;
  }

  /*  
    Recursively adds every media file in a folder to the playlist
      $folder_path -- Path to the folder
      $playlist -- Playlist, as a string
      $config -- Configuration variables
  */
  function add_folder($folder_path, &$playlist, $config)
  {
    $subfolders = webjuk_file_utilities::get_subfolders($folder_path);
    $subfiles = webjuk_file_utilities::get_subfiles($folder_path);
    
    for ($i = 0; $i < count($subfolders); $i++)
      webjuk_playlist::add_folder($subfolders[$i], $playlist, $config);
    for ($i = 0; $i < count($subfiles); $i++)
      webjuk_playlist::add_file($subfiles[$i], $playlist, $config);
  }

  /*  
    Adds a file to the playlist
      $file_path -- Path to the file
      $playlist -- Playlist, as a string
      $config -- Configuration variables
  */
  function add_file($file_path, &$playlist, $config)
  {
    $playlist .=  webjuk_url::get_m3u_url($file_path, $config) . "\n";
  }
}
