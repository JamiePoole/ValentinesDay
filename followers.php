<?php
require('require.php');

$followers = $_tf->getFollowers();

echo '<pre>';
var_dump($followers);
echo '</pre>';