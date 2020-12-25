<?php
  // 네이버 데이터랩 통합검색어 트렌드 Open API 예제
  $client_id = "ADe0KPRyIZUOAqv7USkx"; // 네이버 개발자센터에서 발급받은 CLIENT ID
  $client_secret = "DOEPOzwoYO";// 네이버 개발자센터에서 발급받은 CLIENT SECRET
  $url = "https://openapi.naver.com/v1/datalab/search";
  $startDate = $_POST["startDate"];
  $endDate = $_POST["endDate"];
  $timeUnit = $_POST["timeUnit"];
  $group0 = $_POST["group0"];
  $group1 = $_POST["group1"];
  $group2 = $_POST["group2"];
  $group3 = $_POST["group3"];
  $group4 = $_POST["group4"];
  $group5 = $_POST["group5"];
  $group6 = $_POST["group6"];
  $group7 = $_POST["group7"];
  $group8 = $_POST["group8"];
  $group9 = $_POST["group9"];
  
/*  $group = array("1"=>$group1,"2"=>$group2,"3"=>$group3,"4"=>$group4,"5"=>$group5,"6"=>$group6);
  
  $body_group;
  for($group as $value){
	  echo $value;
	  if($value!=""){
		$body_group .= ",$value";
	  }
  }
  */
  
  $group = "[";
  if($group0!=""){
		$group .= "$group0";
	}
  if($group1!=""){
		$group .= ",$group1";
	}
  if($group2!=""){
		$group .= ",$group2";
	}
  if($group3!=""){
		$group .= ",$group3";
	}
  if($group4!=""){
		$group .= ",$group4";
	}
  if($group5!=""){
		$group .= ",$group5";
	}
  if($group6!=""){
		$group .= ",$group6";
  }
  if($group7!=""){
		$group .= ",$group7";
	}
  if($group8!=""){
		$group .= ",$group8";
	}
  if($group9!=""){
		$group .= ",$group9";
	}

  $group .= "]";
 
  
  
  $body = "{\"startDate\":\"$startDate\",
  \"endDate\":\"$endDate\",
  \"timeUnit\":\"$timeUnit\",
  \"keywordGroups\":$group}";
  
  echo $group, "<br>", $body,  "<br>";
 /* $body = "{\"startDate\":\"2018-03-03\",
  \"endDate\":\"2018-05-27\",
  \"timeUnit\":\"date\",
  \"keywordGroups\":
[{\"groupName\":\"moon\",\"keywords\":[\"korean\"]},
{\"groupName\":\"\",\"keywords\":[\"english\"]}],
\"device\":\"pc\",
\"ages\":[\"1\",\"2\"],
\"gender\":\"f\"}";
*/

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  $headers[] = "Content-Type: application/json";
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  // SSL 이슈가 있을 경우, 아래 코드 주석 해제
  // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "status_code:".$status_code." ";
  curl_close ($ch);
  if($status_code == 200) {
      echo $response;
  } else {
      echo "Error 내용:".$response;
  }
  
?>