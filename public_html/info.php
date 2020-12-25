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

	for($i=0; $i<$total; $i++){
		
		$obj_addr = $xml->body[0]->items[0]->item[$i];

		echo "
			<div class='card col s4 l3 tab' style='background: #E5E5E5	'>
            <h5 style='font-weight: bold; color:#424242'>$obj_addr->name</h5>
            <div class='card-action'>
				<a>$obj_addr->giho</a><br/>
				<a>$obj_addr->jdName</a><br/>
				<a>$obj_addr->gender</a><br/>
				<a>$obj_addr->age</a><br/>
				<a>$obj_addr->job</a><br/>
				<a>$obj_addr->edu</a><br/>
			";
			
		if($obj_addr->career1 != null){
			echo "
				<a>$obj_addr->career1</a><br/>
				";
		}
		
		if($obj_addr->career2 != null){
			echo "
				<a>$obj_addr->career2</a><br/>
				";
		}
		
		echo "
			</div>
            </div>
			";
	}

?>
