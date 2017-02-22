<?php
  // /data folder is forbidden
  if (preg_match('/^\/data\//', $_SERVER['REQUEST_URI'])) {
    return true;
  }

  // All other pages are served as is:
  return false;
?>