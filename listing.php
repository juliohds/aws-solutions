<?php

require "app/start.php";


$objects =  $s3->getIterator('ListObjects', [

    'Bucket' => $config['s3']['bucket']

]);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Listing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>File</th>
                <th>Visualizar</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            
            <?php foreach($objects as $object): ?>
            <tr>
            <td><?php echo $object['Key']; ?></td>
            <td><a href="<?php echo $s3->getObjectUrl($config['s3']['bucket'], $object['Key']); ?>">Visualizar</a></td>
            <td><a href="#" Download="<?php $object['Key']; ?>">Download</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>