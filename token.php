<?php

require "app/start.php";

$object = 'uploads/uploadme.txt';

// $url = $s3->getObjectUrl($config['s3']['bucket'], $object, '+ 1 minute');

//Creating a presigned URL
$cmd = $s3->getCommand('GetObject', [
    'Bucket' => $config['s3']['bucket'],
    'Key'    => $object
]);

$request = $s3->createPresignedRequest($cmd, '+2 minutes');

// Get the actual presigned-url
$presignedUrl = (string) $request->getUri();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Token</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <a href="<?php echo $presignedUrl; ?>">Download</a>
</body>
</html>