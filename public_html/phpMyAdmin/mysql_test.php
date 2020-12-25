<meta charset="UTF-8">
<?php
  $conn = new mysqli("localhost", "root", "tmakxnvy", "smartvote");
  if ($conn->connect_error){
    echo "접속 실패";
    exit();
  }
  
  
  
  $result = $conn -> query("SELECT * FROM GCJC WHERE dong like '%청운효자동%' AND city like '%서울특별시%'");
  
  while($row = $result -> fetch_assoc()){
	  $sgName = $row["sggu"]; 
	  echo "$sgName";
  }
?>

