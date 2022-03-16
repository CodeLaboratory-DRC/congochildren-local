<?php

$targetFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage/app/public';
$linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/public/storage';
// symlink($targetFolder, $linkFolder);
// echo 'Symlink process successfully completed <br />';

if (file_exists($linkFolder)) {
    echo ("$linkFolder exist! <br/>");
} else {
    echo ("$linkFolder not exist! <br/>");
}


if (is_link($linkFolder)) {
    echo ("$linkFolder is a symbolic link!");
} else {
    echo ("$linkFolder is not a symbolic link!");
}
