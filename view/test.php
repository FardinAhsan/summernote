<?php
/**
 * Created by PhpStorm.
 * User: Fardin
 * Date: 5/13/2018
 * Time: 12:51 PM
 */

if ($_FILES['file']['name']) {
    if (!$_FILES['file']['error']) {
        $name = md5(rand(100, 200));
        $ext = explode('.', $_FILES['file']['name']);
        $filename = $name . '.' . $ext[1];
        $destination = 'image/' . $filename; //change this directory
        $location = $_FILES["file"]["tmp_name"];
        move_uploaded_file($location, $destination);
        echo 'http://test.yourdomain.al/images/' . $filename;//change this URL
    }
    else
    {
        echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
    }
}