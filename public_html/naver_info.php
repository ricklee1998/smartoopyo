<?php
  $client_id = "vodhYhhZWHJIsfZH36Ee";
  $client_secret = "ivXU7_b2hF";
  $encText = $_POST["text_Text"];
  
  //$url = "https://openapi.naver.com/v1/search/news?query=".urlencode($encText)."&display=4&start=1&sort=sim"; // json 결과
  $url = "https://openapi.naver.com/v1/search/news.xml?query=".urlencode($encText)."&display=10&start=1&sort=sim"; // xml 결과
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close ($ch);

  $xml = simplexml_load_string($response);
  $total = $xml->channel[0]->display[0];
  for($i=0; $i<$total; $i++){
		
		$obj_addr = $xml->channel[0]->item[$i];
		
		echo "
			
			<div class='card col s12'>
				<h5 id='newstitle' class='fontBold textPadding2'><a href=$obj_addr->link target='_blank' style='color: #424242;'>$obj_addr->title</a></h5>
				<div class='row'>
					<div class='card-action'>
						<a href=$obj_addr->link target='_blank'  id='newsdescription'>$obj_addr->description</a>
			";
		echo "
			</div>
            </div>
			</div>
			";
  }
?>
	

