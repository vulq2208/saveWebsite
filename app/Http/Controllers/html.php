<?php

$iframe_urls = array(
    $iframe
 );
 $ids = array();
 foreach ($iframe_urls as $url) {
     $id = substr($url, strpos($url, "=") + 1);
     if ($id != '') {
         $ids[] = $id;
     }
     $string = join(',', $ids);
     echo $string;
 }
 ?>
