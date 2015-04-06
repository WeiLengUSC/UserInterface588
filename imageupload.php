<?php
$target_dir = "uploads/";
$pos= stripos($_FILES["image"]["name"], '.');
$total= strlen($_FILES["image"]["name"]);
$extension = substr($_FILES["image"]["name"], $pos, $total-$pos); 
$_FILES["image"]["name"]=isset($_POST["userid"])?$_POST["userid"].$extension:"imagefile".$extension;
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check file size
if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
       $querystr="";
       $querystr.=$_POST["userid"];
       $querystr.="&".$_POST["gender"];
       $querystr.="&".$_POST["address"];
       $querystr.="&".$_POST["phone"];
       $querystr.="&".$_POST["email"];
       $querystr.="&".$_POST["autograph"];
        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.".$querystr;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>