<?php
    define("HOSTNAME","localhost");
    define("USERNAME","root");
    define("PASSWORD","");
    define("DBNAME","fileupload");

    $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DBNAME) or die("Can't connect to database");

    // if($con){
    //     echo "Connection stublished";
    // }

?>