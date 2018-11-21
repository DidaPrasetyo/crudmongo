<?php

use \MongoDB\BSON\ObjectID as MongoId;
require_once __DIR__ . "/vendor/autoload.php";

$connection = new MongoDB\Driver\Manager();

$collection = (new MongoDB\Client)->telkom->siswa;
 
//getting id of the data from url
$id = $_GET['id'];
 
//deleting the row from table/collection
$collection->deleteOne(array('_id' => new MongoId($id)));
 
//redirecting to the display page (index.php in our case)
header("Location:index.php");
?>