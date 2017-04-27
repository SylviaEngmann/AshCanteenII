<?php
    $pid = $_SESSION['person_id'];
    include('objects.php');
    $obj=new object();
    $result=$obj->viewUserOrders($pid);
    if($result==false){
    echo '{"result":0,"message":"Not found"}';
    }
    else{
    $row=$obj->fetch();
    echo '{"result":1 , "order":[';
    while($row){
      echo json_encode($row);
      $row=$obj->fetch();
      if($row!=false){
        echo ",";
            }
        }
        echo "]}";
    }
?> 
