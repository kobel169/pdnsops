<?php
$host = $_SERVER['HTTP_HOST'];

return CMap::mergeArray(
        require(dirname(__FILE__).'/'.$host.'.php'),
        array()
);


