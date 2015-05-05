<?php

function connect()
{
    
    $link = mysql_connect("localhost", "root" , "");
    if (!$link) 
    {
        die('Could not connect: ' . mysql_error());
    }

    $db_selected = mysql_select_db('futurecaptcha', $link);

    if (!$db_selected)
    {
        die ("Can\'t use test_db : " . mysql_error());
    }

    //echo 'Connected Successfully <br>';


}


?>