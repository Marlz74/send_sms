<?php
function sanitize_data($input){
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    $input = strip_tags($input);
    return $input;
}
function isEmpty($str) {
    return strlen(trim($str)) === 0;
  }
  