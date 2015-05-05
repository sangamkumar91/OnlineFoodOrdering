<?php
    session_start();
    $_SESSION['order_id'] = $_GET['order_id'];
    
    $postdata = array(
                "error" => $_SESSION['order_id'],
                "tttt" => 'asdva',
                );

    echo json_encode($postdata);
    //header('Location: menu.php');
    //die();
?>