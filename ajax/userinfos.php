<?php
$dest= "";
$sujet= "Ceci est un test";
$message= "Ceci est un test";
$header= "From: $dest";

mail($dest, $sujet, $message, $header);
?>