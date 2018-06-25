<?php

require "app/start.php";

$queryFileName = 'me_arquivo';
$contentType = 'txt';

//Creating a presigned URL
$cmd = $s3->getCommand('putObject', [
    'Bucket' => $config['s3']['bucket'],
    'Key'    => $queryFileName,
    'ContentType' => $contentType,
    'ACL' => 'public-read'
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

    <?php echo var_dump($presignedUrl); ?>
    
</body>
</html>