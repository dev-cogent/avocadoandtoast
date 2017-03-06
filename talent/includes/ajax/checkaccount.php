<?php
session_start();
if(isset($_SESSION['project_id']))
  echo 1;
else
  echo 0;
?>