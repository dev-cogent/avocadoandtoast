<?php
error_reporting(0);
session_start();
if(!$_SESSION['project_id']){
  $isLoggedin = false;
}else{
  $isLoggedin = true;
}
