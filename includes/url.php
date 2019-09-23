<?php

function redirect($path){
    header("Location: http://" . $_SERVER['HTTP_HOST'] . $path);
}
