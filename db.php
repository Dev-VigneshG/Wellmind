<?php
$db=new mysqli("localhost","root","","wellmind");
if($db->connect_error){
    echo "Database Connection Error: ".$db->connect_error;
}

?>