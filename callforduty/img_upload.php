<?php
$target_dir = "images/profile/";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_dir . basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION));

session_start();
$target_file = $target_dir . $_SESSION["id"];

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

$fileTypes = ["jpg", "png", "jpeg", "gif"];

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

if (!in_array($imageFileType, $fileTypes)) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;

}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    for ($i = 0; $i < count($fileTypes); $i++) {
        if (file_exists($target_file . $fileTypes[$i])) {
            unlink($target_file . $fileTypes[$i]);
        }
    }
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file . "." . $imageFileType)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

header("refresh:5;url=profile_page.php");
exit();
?>