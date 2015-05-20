<?php 	
  /* Absolute path to the base folder containing all the media files. */
  /* The trailing slash must NOT be included. */
  $config['base_folder_path'] = "/home/Sid/code/projects/webjuk/demo/music";

  /* Alias to the base folder path. If no such alias exists, you have to create one. */
  /* Also note that the the trailing slash must NOT be included. */
  $config['alias'] = "/music";

  /* Host name of your server. */
  $config['host_name'] = "localhost";

  /* File types the user is allowed to view */
  $config['allowed_file_types'] = array("mp3", "ogg", "avi");

  /**********************************************************************************/
  /* Don't worry about the configurations below */
  /**********************************************************************************/

  /* CSS config */
  $config['css'] = "resources/css/style.css";
  
  /* Images configs */
  $config['folder_icon'] = "resources/images/folder.gif";
  $config['file_icon'] = "resources/images/file.gif";

  /* ID3 tags that will be displayed in the full view */
  $config['cc_tags_full'] = array("artist", "album", "track", "title", "year", "copyright");

  /* ID3 tags that will be displayed in the light view */
  $config['cc_tags_light'] = array("artist", "album", "track", "title", "copyright");

  $config['cc_logo'] = "resources/images/cc-standard.gif";

  $config['http://creativecommons.org/icon/by/standard.gif'] = "resources/images/cc-by.gif";
  $config['http://creativecommons.org/icon/nd/standard.gif'] = "resources/images/cc-nd.gif";
  $config['http://creativecommons.org/icon/nc/standard.gif'] = "resources/images/cc-nc.gif";
  $config['http://creativecommons.org/icon/sa/standard.gif'] = "resources/images/cc-sa.gif";
?>
