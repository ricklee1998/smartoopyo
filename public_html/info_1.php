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
	$sPicture1 = "http://info.nec.go.kr/photo_20180613/Sd1100/Sgg";
	$sPicture2 = "110000/Hb100131769/gicho/100131769.JPG";
	$sPicture3 = $sPicture1.urlencode($sgT).$sPicture2;
	
	$xml = simplexml_load_string($response);
	$total = $xml->body[0]->totalCount[0];
	
	for($i=0; $i<$total; $i++){
		$candiman = "candiman".urlencode($i).'_'.urlencode($sgT);
		$obj_addr = $xml->body[0]->items[0]->item[$i];
		$ID_addr = $xml->body[0]->items[0]->item[$i]->huboid[0];
		$SG_name = $xml->body[0]->items[0]->item[$i]->sggName[0];
		$sPicture4 = str_replace("100131769", $ID_addr, $sPicture3);
		if($SG_name=="서울특별시"){
			$sPicture5 = str_replace("1100","1100",$sPicture4);
		}else if($SG_name=="부산광역시"){
			$sPicture5 = str_replace("1100","2600",$sPicture4);
		}else if($SG_name=="대구광역시"){
			$sPicture5 = str_replace("1100","2700",$sPicture4);
		}else if($SG_name=="인천광역시"){
			$sPicture5 = str_replace("1100","2800",$sPicture4);
		}else if($SG_name=="광주광역시"){
			$sPicture5 = str_replace("1100","2900",$sPicture4);
		}else if($SG_name=="대전광역시"){
			$sPicture5 = str_replace("1100","3000",$sPicture4);
		}else if($SG_name=="울산광역시"){
			$sPicture5 = str_replace("1100","3100",$sPicture4);
		}else if($SG_name=="서울특별자치시"){
			$sPicture5 = str_replace("1100","5100",$sPicture4);
		}else if($SG_name=="경기도"){
			$sPicture5 = str_replace("1100","4100",$sPicture4);
		}else if($SG_name=="강원도"){
			$sPicture5 = str_replace("1100","4200",$sPicture4);
		}else if($SG_name=="충청북도"){
			$sPicture5 = str_replace("1100","4300",$sPicture4);
		}else if($SG_name=="충청남도"){
			$sPicture5 = str_replace("1100","4400",$sPicture4);
		}else if($SG_name=="전라북도"){
			$sPicture5 = str_replace("1100","4500",$sPicture4);
		}else if($SG_name=="전라남도"){
			$sPicture5 = str_replace("1100","4600",$sPicture4);
		}else if($SG_name=="경상북도"){
			$sPicture5 = str_replace("1100","4700",$sPicture4);
		}else if($SG_name=="경상남도"){
			$sPicture5 = str_replace("1100","4800",$sPicture4);
		}else if($SG_name=="제주특별자치도"){
			$sPicture5 = str_replace("1100","4900",$sPicture4);
		}
		echo "
			<div id='cand{$i}' class='card col s4 l3' onclick='clickCandi(this)' style='margin:0.5em 0'>
           	    <h5 style='text-align: center;' id= '$candiman' class='fontBold'>기호 $obj_addr->giho 번 $obj_addr->name</h5>
           		
			</div>
			";
	}

?>
