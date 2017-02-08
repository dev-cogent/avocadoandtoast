<?php

session_start(); 
if(isset($_SESSION['project_id'])){
//...continue on bro 💩
}
else 
header('Location: /login');
//we re locate to the login page.
