<?php
	$sggN = $_POST["sgg_Name"];
   	$sgT = $_POST["sg_Typecode"];
	$sdN = $_POST["sd_Name"];
	$ch = curl_init();
	$url = 'http://apis.data.go.kr/9760000/PofelcddInfoInqireService/getPofelcddRegistSttusInfoInqire'; /*URL*/
	$queryParams = '?' . urlencode('ServiceKey') . '=u33oktn6pirdBCqqn8WRVxtDSum2vtxW9MBKGwfl6KxNJdvBuHzXnV4qmOCecyZ8So0Xx3W26icNpgqwDiTh3g%3D%3D'; /*Service Key*/
	$queryParams .= '&' . urlencode('ServiceKey') . '=' . urlencode('-'); /*공공데이터포털에서 받은 인증키*/
	$queryParams .= '&' . urlencode('sgId') . '=' . urlencode('20180613'); /*선거ID*/
	$queryParams .= '&' . urlencode('sgTypecode') . '=' . urlencode($sgT); /*선거종류코드*/
	$queryParams .= '&' . urlencode('sggName') . '=' . urlencode($sggN); /*선거구명*/
	$queryParams .= '&' . urlencode('sdName') . '=' . urlencode($sdN); /*시도명*/

	curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	$response = curl_exec($ch);
	curl_close($ch);


	$xml = simplexml_load_string($response);
	$total = $xml->body[0]->totalCount[0];

	echo"
		<span style='visibility:hidden' id='total_candi'>$total</span>
	";
	
	for($i=0; $i<$total; $i++){
		$obj_addr = $xml->body[0]->items[0]->item[$i];
		
		echo "
			<h10 style='visibility:hidden'>$obj_addr->name</h10>
			<h11 style='visibility:hidden'>$obj_addr->jdName</h11>
			";
	}

?>
