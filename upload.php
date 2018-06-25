<?php

use Aws\S3\Exception\S3Exception;

require 'app/start.php';

if(isset($_FILES['file'])){
    
    $file = $_FILES['file'];

    //File details
    $name = $file['name'];
    $tmp_name = $file['tmp_name'];

    $extension = explode('.', $name);
    $extension = strtolower(end($extension));
    
    // Temp Details
    $key = md5(uniqid());
    $tmp_file_name = "{$key}.{$extension}";
    $tmp_file_path = "files/{$tmp_file_name}";

    //Move the file
    move_uploaded_file($tmp_name,$tmp_file_path);

    try{
        
        $s3->putObject([
            'Bucket' => $config['s3']['bucket'],
            'Key' => "uploads/{$name}",
            'Body' => fopen($tmp_file_path, 'rb'),
            'ACL' => 'public-read'
        ]);
        
        //Remove the file
        unlink($tmp_file_path);
    
    } catch(S3Exception $e){
        die("There was an error uploading that file.");
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
   <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="Upload">
   </form> 
</body>
</html>