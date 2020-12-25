<?php

  $dong = $_POST["dong_Name"];
  $do = $_POST["do_Name"];

  $conn = new mysqli("localhost", "root", "tmakxnvy", "smartvote");
  if ($conn->connect_error){
    echo "접속 실패";
    exit();
  }
  
  
  
  $result = $conn -> query("SELECT * FROM GcCongress WHERE dong like '%".$dong."%' AND city like '%".$do."%'");
  
  while($row = $result -> fetch_assoc()){
	  $sgName = $row["sggu"]; 
	  echo "$sgName";
	  break;
  }
    $conn->close();
?>