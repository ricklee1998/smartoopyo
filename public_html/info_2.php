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
	if($sgT=="4"){
		$sPicture1 = "http://info.nec.go.kr/photo_20180613/Sd1100/Gsg1100/Sgg";
		$sPicture2 = "110000/Hb100131769/gicho/100131769.JPG";
		$sPicture3 = $sPicture1.urlencode($sgT).$sPicture2;
	}else if($sgT=="5"){
		$sPicture1 = "http://info.nec.go.kr/photo_20180613/Sd1100/Gsg1100/Sgg";
		$sPicture2 = "110000/Hb100131769/gicho/100131769.JPG";
		$sPicture3 = $sPicture1.urlencode($sgT).$sPicture2;
	}else if($sgT=="6"){
		$sPicture1 = "http://info.nec.go.kr/photo_20180613/Sd1100/Gsg1100/Sgg";
		$sPicture2 = "110000/Hb100131769/gicho/100131769.JPG";
		$sPicture3 = $sPicture1.urlencode($sgT).$sPicture2;
	}else if($sgT=="3"){
		$sPicture1 = "http://info.nec.go.kr/photo_20180613/Sd1100/Sgg";
		$sPicture2 = "110000/Hb100131769/gicho/100131769.JPG";
		$sPicture3 = $sPicture1.urlencode($sgT).$sPicture2;
	}else if($sgT=="11"){
		$sPicture1 = "http://info.nec.go.kr/photo_20180613/Sd1100/Sgg";
		$sPicture2 = "110000/Hb100131769/gicho/100131769.JPG";
		$sPicture3 = $sPicture1.urlencode($sgT).$sPicture2;
	}

	$xml = simplexml_load_string($response);
	$total = $xml->body[0]->totalCount[0];

	for($i=0; $i<$total; $i++){
		$xml_object = $xml->body[0]->items[0]->item[$i];
		$ID_addr = $xml->body[0]->items[0]->item[$i]->huboid[0];
		$SG_name = $xml->body[0]->items[0]->item[$i]->sggName[0];
		$sPicture4 = str_replace("100131769", $ID_addr, $sPicture3);
		if($sdN=="서울특별시"){
			$sPicture5 = str_replace("1100","1100",$sPicture4);
			if(strpos($SG_name,"종로구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1101",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41101",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="종로구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110101",$sPicture5);
					}else if($SG_name=="종로구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110102",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="종로구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110101",$sPicture5);
					}else if($SG_name=="종로구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110102",$sPicture5);
					}else if($SG_name=="종로구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110103",$sPicture5);
					}else if($SG_name=="종로구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110104",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"중구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1102",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41102",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="중구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110201",$sPicture5);
					}else if($SG_name=="중구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110202",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="중구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110201",$sPicture5);
					}else if($SG_name=="중구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110202",$sPicture5);
					}else if($SG_name=="중구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110203",$sPicture5);
					}else if($SG_name=="중구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110204",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"용산구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1103",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41103",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="용산구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110301",$sPicture5);
					}else if($SG_name=="용산구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110302",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="용산구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110301",$sPicture5);
					}else if($SG_name=="용산구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110302",$sPicture5);
					}else if($SG_name=="용산구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110303",$sPicture5);
					}else if($SG_name=="용산구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110304",$sPicture5);
					}else if($SG_name=="용산구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110305",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"성동구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1104",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41104",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="성동구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110401",$sPicture5);
					}else if($SG_name=="성동구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110402",$sPicture5);
					}else if($SG_name=="성동구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110403",$sPicture5);
					}else if($SG_name=="성동구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110404",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="성동구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110401",$sPicture5);
					}else if($SG_name=="성동구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110402",$sPicture5);
					}else if($SG_name=="성동구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110403",$sPicture5);
					}else if($SG_name=="성동구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110404",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"광진구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1105",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41105",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="광진구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110501",$sPicture5);
					}else if($SG_name=="광진구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110502",$sPicture5);
					}else if($SG_name=="광진구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110503",$sPicture5);
					}else if($SG_name=="광진구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110504",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="광진구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110501",$sPicture5);
					}else if($SG_name=="광진구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110502",$sPicture5);
					}else if($SG_name=="광진구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110503",$sPicture5);
					}else if($SG_name=="광진구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110504",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"동대문구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1106",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41106",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="동대문구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110601",$sPicture5);
					}else if($SG_name=="동대문구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110602",$sPicture5);
					}else if($SG_name=="동대문구3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110603",$sPicture5);
					}else if($SG_name=="동대문구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110604",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="동대문구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110601",$sPicture5);
					}else if($SG_name=="동대문구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110602",$sPicture5);
					}else if($SG_name=="동대문구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110603",$sPicture5);
					}else if($SG_name=="동대문구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110604",$sPicture5);
					}else if($SG_name=="동대문구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110605",$sPicture5);
					}else if($SG_name=="동대문구바선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110606",$sPicture5);
					}else if($SG_name=="동대문구사선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110607",$sPicture5);
					}else if($SG_name=="동대문구아선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110608",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"중랑구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1107",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41107",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="중랑구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110701",$sPicture5);
					}else if($SG_name=="중랑구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110702",$sPicture5);
					}else if($SG_name=="중랑구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110703",$sPicture5);
					}else if($SG_name=="중랑구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110704",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="중랑구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110701",$sPicture5);
					}else if($SG_name=="중랑구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110702",$sPicture5);
					}else if($SG_name=="중랑구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110703",$sPicture5);
					}else if($SG_name=="중랑구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110704",$sPicture5);
					}else if($SG_name=="중랑구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110705",$sPicture5);
					}else if($SG_name=="중랑구바선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110706",$sPicture5);
					}else if($SG_name=="중랑구사선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110707",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"성북구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1108",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41108",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="성북구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110801",$sPicture5);
					}else if($SG_name=="성북구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110802",$sPicture5);
					}else if($SG_name=="성북구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110803",$sPicture5);
					}else if($SG_name=="성북구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110804",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="성북구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110801",$sPicture5);
					}else if($SG_name=="성북구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110802",$sPicture5);
					}else if($SG_name=="성북구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110803",$sPicture5);
					}else if($SG_name=="성북구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110804",$sPicture5);
					}else if($SG_name=="성북구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110805",$sPicture5);
					}else if($SG_name=="성북구바선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110806",$sPicture5);
					}else if($SG_name=="성북구사선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110807",$sPicture5);
					}else if($SG_name=="성북구아선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110808",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"강북구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1109",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41109",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="강북구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110901",$sPicture5);
					}else if($SG_name=="강북구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110902",$sPicture5);
					}else if($SG_name=="강북구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110903",$sPicture5);
					}else if($SG_name=="강북구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5110904",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="강북구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110901",$sPicture5);
					}else if($SG_name=="강북구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110902",$sPicture5);
					}else if($SG_name=="강북구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110903",$sPicture5);
					}else if($SG_name=="강북구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6110904",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"도봉구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1110",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41110",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="도봉구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111001",$sPicture5);
					}else if($SG_name=="도봉구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111002",$sPicture5);
					}else if($SG_name=="도봉구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111003",$sPicture5);
					}else if($SG_name=="도봉구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111004",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="도봉구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111001",$sPicture5);
					}else if($SG_name=="도봉구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111002",$sPicture5);
					}else if($SG_name=="도봉구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111003",$sPicture5);
					}else if($SG_name=="도봉구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111004",$sPicture5);
					}else if($SG_name=="도봉구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111005",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"노원구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1111",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41111",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="노원구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111101",$sPicture5);
					}else if($SG_name=="노원구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111102",$sPicture5);
					}else if($SG_name=="노원구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111103",$sPicture5);
					}else if($SG_name=="노원구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111104",$sPicture5);
					}else if($SG_name=="노원구제5선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111105",$sPicture5);
					}else if($SG_name=="노원구제6선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111106",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="노원구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111101",$sPicture5);
					}else if($SG_name=="노원구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111102",$sPicture5);
					}else if($SG_name=="노원구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111103",$sPicture5);
					}else if($SG_name=="노원구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111104",$sPicture5);
					}else if($SG_name=="노원구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111105",$sPicture5);
					}else if($SG_name=="노원구바선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111106",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"은평구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1112",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41112",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="은평구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111201",$sPicture5);
					}else if($SG_name=="은평구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111202",$sPicture5);
					}else if($SG_name=="은평구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111203",$sPicture5);
					}else if($SG_name=="은평구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111204",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="은평구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111201",$sPicture5);
					}else if($SG_name=="은평구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111202",$sPicture5);
					}else if($SG_name=="은평구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111203",$sPicture5);
					}else if($SG_name=="은평구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111204",$sPicture5);
					}else if($SG_name=="은평구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111205",$sPicture5);
					}else if($SG_name=="은평구바선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111206",$sPicture5);
					}else if($SG_name=="은평구사선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111207",$sPicture5);
					}else if($SG_name=="은평구아선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111208",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"서대문구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1113",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41113",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="서대문구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111301",$sPicture5);
					}else if($SG_name=="서대문구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111302",$sPicture5);
					}else if($SG_name=="서대문구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111303",$sPicture5);
					}else if($SG_name=="서대문구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111304",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="서대문구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111301",$sPicture5);
					}else if($SG_name=="서대문구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111302",$sPicture5);
					}else if($SG_name=="서대문구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111303",$sPicture5);
					}else if($SG_name=="서대문구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111304",$sPicture5);
					}else if($SG_name=="서대문구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111305",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"마포구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1114",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41114",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="마포구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111401",$sPicture5);
					}else if($SG_name=="마포구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111402",$sPicture5);
					}else if($SG_name=="마포구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111403",$sPicture5);
					}else if($SG_name=="마포구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111404",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="마포구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111401",$sPicture5);
					}else if($SG_name=="마포구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111402",$sPicture5);
					}else if($SG_name=="마포구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111403",$sPicture5);
					}else if($SG_name=="마포구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111404",$sPicture5);
					}else if($SG_name=="마포구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111405",$sPicture5);
					}else if($SG_name=="마포구바선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111406",$sPicture5);
					}else if($SG_name=="마포구사선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111407",$sPicture5);
					}else if($SG_name=="마포구아선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111408",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"양천구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1115",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41115",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="양천구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111501",$sPicture5);
					}else if($SG_name=="양천구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111502",$sPicture5);
					}else if($SG_name=="양천구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111503",$sPicture5);
					}else if($SG_name=="양천구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111504",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="양천구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111501",$sPicture5);
					}else if($SG_name=="양천구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111502",$sPicture5);
					}else if($SG_name=="양천구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111503",$sPicture5);
					}else if($SG_name=="양천구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111504",$sPicture5);
					}else if($SG_name=="양천구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111505",$sPicture5);
					}else if($SG_name=="양천구바선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111506",$sPicture5);
					}else if($SG_name=="양천구사선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111507",$sPicture5);
					}else if($SG_name=="양천구아선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111508",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"강서구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1116",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41116",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="강서구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111601",$sPicture5);
					}else if($SG_name=="강서구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111602",$sPicture5);
					}else if($SG_name=="강서구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111603",$sPicture5);
					}else if($SG_name=="강서구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111604",$sPicture5);
					}else if($SG_name=="강서구제5선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111605",$sPicture5);
					}else if($SG_name=="강서구제6선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111606",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="강서구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111601",$sPicture5);
					}else if($SG_name=="강서구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111602",$sPicture5);
					}else if($SG_name=="강서구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111603",$sPicture5);
					}else if($SG_name=="강서구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111604",$sPicture5);
					}else if($SG_name=="강서구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111605",$sPicture5);
					}else if($SG_name=="강서구바선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111606",$sPicture5);
					}else if($SG_name=="강서구사선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111607",$sPicture5);
					}else if($SG_name=="강서구아선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111608",$sPicture5);
					}else if($SG_name=="강서구자선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111609",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"구로구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1117",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41117",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="구로구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111701",$sPicture5);
					}else if($SG_name=="구로구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111702",$sPicture5);
					}else if($SG_name=="구로구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111703",$sPicture5);
					}else if($SG_name=="구로구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111704",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="구로구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111701",$sPicture5);
					}else if($SG_name=="구로구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111702",$sPicture5);
					}else if($SG_name=="구로구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111703",$sPicture5);
					}else if($SG_name=="구로구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111704",$sPicture5);
					}else if($SG_name=="구로구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111705",$sPicture5);
					}else if($SG_name=="구로구바선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111706",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"금천구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1118",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41118",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="금천구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111801",$sPicture5);
					}else if($SG_name=="금천구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111802",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="금천구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111801",$sPicture5);
					}else if($SG_name=="금천구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111802",$sPicture5);
					}else if($SG_name=="금천구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111803",$sPicture5);
					}else if($SG_name=="금천구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111804",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"영등포구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1119",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41119",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="영등포구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111901",$sPicture5);
					}else if($SG_name=="영등포제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111902",$sPicture5);
					}else if($SG_name=="영등포제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111903",$sPicture5);
					}else if($SG_name=="영등포제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111904",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="영등포구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111901",$sPicture5);
					}else if($SG_name=="영등포구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111902",$sPicture5);
					}else if($SG_name=="영등포구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111903",$sPicture5);
					}else if($SG_name=="영등포구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111904",$sPicture5);
					}else if($SG_name=="영등포구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111905",$sPicture5);
					}else if($SG_name=="영등포구바선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111906",$sPicture5);
					}else if($SG_name=="영등포구사선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6111907",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"동작구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1120",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41120",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="동작구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112001",$sPicture5);
					}else if($SG_name=="동작구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112002",$sPicture5);
					}else if($SG_name=="동작구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112003",$sPicture5);
					}else if($SG_name=="동작구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112004",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="동작구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112001",$sPicture5);
					}else if($SG_name=="동작구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112002",$sPicture5);
					}else if($SG_name=="동작구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112003",$sPicture5);
					}else if($SG_name=="동작구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112004",$sPicture5);
					}else if($SG_name=="동작구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112005",$sPicture5);
					}else if($SG_name=="동작구바선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112006",$sPicture5);
					}else if($SG_name=="동작구사선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112007",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"관악구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1121",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41121",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="관악구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112101",$sPicture5);
					}else if($SG_name=="관악구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112102",$sPicture5);
					}else if($SG_name=="관악구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112103",$sPicture5);
					}else if($SG_name=="관악구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112104",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="관악구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112101",$sPicture5);
					}else if($SG_name=="관악구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112102",$sPicture5);
					}else if($SG_name=="관악구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112103",$sPicture5);
					}else if($SG_name=="관악구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112104",$sPicture5);
					}else if($SG_name=="관악구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112105",$sPicture5);
					}else if($SG_name=="관악구바선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112106",$sPicture5);
					}else if($SG_name=="관악구사선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112107",$sPicture5);
					}else if($SG_name=="관악구아선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112108",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"서초구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1122",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41122",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="서초구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112201",$sPicture5);
					}else if($SG_name=="서초구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112202",$sPicture5);
					}else if($SG_name=="서초구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112203",$sPicture5);
					}else if($SG_name=="서초구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112204",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="서초구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112201",$sPicture5);
					}else if($SG_name=="서초구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112202",$sPicture5);
					}else if($SG_name=="서초구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112203",$sPicture5);
					}else if($SG_name=="서초구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112204",$sPicture5);
					}else if($SG_name=="서초구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112205",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"강남구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1123",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41123",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="강남구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112301",$sPicture5);
					}else if($SG_name=="강남구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112302",$sPicture5);
					}else if($SG_name=="강남구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112303",$sPicture5);
					}else if($SG_name=="강남구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112304",$sPicture5);
					}else if($SG_name=="강남구제5선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112305",$sPicture5);
					}else if($SG_name=="강남구제6선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112306",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="강남구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112301",$sPicture5);
					}else if($SG_name=="강남구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112302",$sPicture5);
					}else if($SG_name=="강남구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112303",$sPicture5);
					}else if($SG_name=="강남구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112304",$sPicture5);
					}else if($SG_name=="강남구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112305",$sPicture5);
					}else if($SG_name=="강남구바선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112306",$sPicture5);
					}else if($SG_name=="강남구사선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112307",$sPicture5);
					}else if($SG_name=="강남구아선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112308",$sPicture5);
					}else if($SG_name=="강남구자선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112309",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"송파구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1124",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41124",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="송파구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5111001",$sPicture5);
					}else if($SG_name=="송파구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112402",$sPicture5);
					}else if($SG_name=="송파구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112403",$sPicture5);
					}else if($SG_name=="송파구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112404",$sPicture5);
					}else if($SG_name=="송파구제5선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112405",$sPicture5);
					}else if($SG_name=="송파구제6선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112406",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="송파구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112401",$sPicture5);
					}else if($SG_name=="송파구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112402",$sPicture5);
					}else if($SG_name=="송파구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112403",$sPicture5);
					}else if($SG_name=="송파구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112404",$sPicture5);
					}else if($SG_name=="송파구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112405",$sPicture5);
					}else if($SG_name=="송파구바선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112406",$sPicture5);
					}else if($SG_name=="송파구사선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112407",$sPicture5);
					}else if($SG_name=="송파구아선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112408",$sPicture5);
					}else if($SG_name=="송파구자선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112409",$sPicture5);
					}else if($SG_name=="송파구차선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112410",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"강동구") !== false){
				$sPicture5 = str_replace("Gsg1100","Gsg1125",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg41100","Sgg41125",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="강동구제1선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112501",$sPicture5);
					}else if($SG_name=="강동구제2선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112502",$sPicture5);
					}else if($SG_name=="강동구제3선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112503",$sPicture5);
					}else if($SG_name=="강동구제4선거구"){
						$sPicture5 = str_replace("Sgg5110000","Sgg5112504",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="강동구가선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112501",$sPicture5);
					}else if($SG_name=="강동구나선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112502",$sPicture5);
					}else if($SG_name=="강동구다선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112503",$sPicture5);
					}else if($SG_name=="강동구라선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112504",$sPicture5);
					}else if($SG_name=="강동구마선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112505",$sPicture5);
					}else if($SG_name=="강동구바선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112506",$sPicture5);
					}else if($SG_name=="강동구사선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112507",$sPicture5);
					}else if($SG_name=="강동구아선거구"){
						$sPicture5 = str_replace("Sgg6110000","Sgg6112508",$sPicture5);
					}
				}
			}
		}else if($sdN=="부산광역시"){
			$sPicture5 = str_replace("1100","2600",$sPicture4);
			if(strpos($SG_name,"중구") !== false){
				$sPicture5 = str_replace("Gsg2600","Gsg2601",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42600","Sgg42601",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="중구선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260101",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="중구가선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260101",$sPicture5);
					}else if($SG_name=="중구나선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260102",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"서구") !== false){
				$sPicture5 = str_replace("Gsg2600","Gsg2602",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42600","Sgg42602",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="서구제1선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260201",$sPicture5);
					}else if($SG_name=="서구제2선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260202",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="서구가선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260201",$sPicture5);
					}else if($SG_name=="서구나선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260202",$sPicture5);
					}else if($SG_name=="서구다선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260203",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"동구") !== false){
				$sPicture5 = str_replace("Gsg2600","Gsg2603",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42600","Sgg42603",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="동구제1선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260301",$sPicture5);
					}else if($SG_name=="동구제2선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260302",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="동구가선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260301",$sPicture5);
					}else if($SG_name=="동구나선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260302",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"영도구") !== false){
				$sPicture5 = str_replace("Gsg2600","Gsg2604",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42600","Sgg42604",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="영도구제1선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260401",$sPicture5);
					}else if($SG_name=="영도구제2선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260402",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="영도구가선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260401",$sPicture5);
					}else if($SG_name=="영도구나선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260402",$sPicture5);
					}else if($SG_name=="영도구다선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260403",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"부산진구") !== false){
				$sPicture5 = str_replace("Gsg2600","Gsg2605",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42600","Sgg42605",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="부산진구제1선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260501",$sPicture5);
					}else if($SG_name=="부산진구제2선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260502",$sPicture5);
					}else if($SG_name=="부산진구제3선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260503",$sPicture5);
					}else if($SG_name=="부산진구제4선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260504",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="부산진구가선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260501",$sPicture5);
					}else if($SG_name=="부산진구나선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260502",$sPicture5);
					}else if($SG_name=="부산진구다선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260503",$sPicture5);
					}else if($SG_name=="부산진구라선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260504",$sPicture5);
					}else if($SG_name=="부산진구마선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260505",$sPicture5);
					}else if($SG_name=="부산진구바선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260506",$sPicture5);
					}else if($SG_name=="부산진구사선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260507",$sPicture5);
					}else if($SG_name=="부산진구아선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260508",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"동래구") !== false){
				$sPicture5 = str_replace("Gsg2600","Gsg2606",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42600","Sgg42606",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="동래구제1선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260601",$sPicture5);
					}else if($SG_name=="동래구제2선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260602",$sPicture5);
					}else if($SG_name=="동래구제3선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260603",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="동래구가선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260601",$sPicture5);
					}else if($SG_name=="동래구나선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260602",$sPicture5);
					}else if($SG_name=="동래구다선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260603",$sPicture5);
					}else if($SG_name=="동래구라선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260604",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"남구") !== false){
				$sPicture5 = str_replace("Gsg2600","Gsg2607",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42600","Sgg42607",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="남구제1선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260701",$sPicture5);
					}else if($SG_name=="남구제2선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260702",$sPicture5);
					}else if($SG_name=="남구제3선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260703",$sPicture5);
					}else if($SG_name=="남구제4선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260704",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="남구가선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260701",$sPicture5);
					}else if($SG_name=="남구나선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260702",$sPicture5);
					}else if($SG_name=="남구다선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260703",$sPicture5);
					}else if($SG_name=="남구라선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260704",$sPicture5);
					}else if($SG_name=="남구마선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260705",$sPicture5);
					}else if($SG_name=="남구바선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260706",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"북구") !== false){
				$sPicture5 = str_replace("Gsg2600","Gsg2608",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42600","Sgg42608",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="북구제1선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260801",$sPicture5);
					}else if($SG_name=="북구제2선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260802",$sPicture5);
					}else if($SG_name=="북구제3선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260803",$sPicture5);
					}else if($SG_name=="북구제4선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260804",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="북구가선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260801",$sPicture5);
					}else if($SG_name=="북구나선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260802",$sPicture5);
					}else if($SG_name=="북구다선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260803",$sPicture5);
					}else if($SG_name=="북구라선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260804",$sPicture5);
					}else if($SG_name=="북구마선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260805",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"해운대구") !== false){
				$sPicture5 = str_replace("Gsg2600","Gsg2609",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42600","Sgg42609",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="해운대구제1선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260901",$sPicture5);
					}else if($SG_name=="해운대구제2선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260902",$sPicture5);
					}else if($SG_name=="해운대구제3선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260903",$sPicture5);
					}else if($SG_name=="해운대구제4선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5260904",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="해운대구가선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260901",$sPicture5);
					}else if($SG_name=="해운대구나선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260902",$sPicture5);
					}else if($SG_name=="해운대구다선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260903",$sPicture5);
					}else if($SG_name=="해운대구라선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260904",$sPicture5);
					}else if($SG_name=="해운대구마선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260905",$sPicture5);
					}else if($SG_name=="해운대구바선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260906",$sPicture5);
					}else if($SG_name=="해운대구사선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260907",$sPicture5);
					}else if($SG_name=="해운대구아선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6260908",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"기장군") !== false){
				$sPicture5 = str_replace("Gsg2600","Gsg2610",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42600","Sgg42610",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="기장군제1선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5261001",$sPicture5);
					}else if($SG_name=="기장군제2선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5261002",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="기장군가선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261001",$sPicture5);
					}else if($SG_name=="기장군나선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261002",$sPicture5);
					}else if($SG_name=="기장군다선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261003",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"사하구") !== false){
				$sPicture5 = str_replace("Gsg2600","Gsg2611",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42600","Sgg42611",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="사하구제1선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5262611",$sPicture5);
					}else if($SG_name=="사하구제2선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5261102",$sPicture5);
					}else if($SG_name=="사하구제3선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5261103",$sPicture5);
					}else if($SG_name=="사하구제4선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5261104",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="사하구가선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261101",$sPicture5);
					}else if($SG_name=="사하구나선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261102",$sPicture5);
					}else if($SG_name=="사하구다선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261103",$sPicture5);
					}else if($SG_name=="사하구라선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261104",$sPicture5);
					}else if($SG_name=="사하구마선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261105",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"금정구") !== false){
				$sPicture5 = str_replace("Gsg2600","Gsg2612",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42600","Sgg42612",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="금정구제1선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5261201",$sPicture5);
					}else if($SG_name=="금정구제2선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5261202",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="금정구가선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261201",$sPicture5);
					}else if($SG_name=="금정구나선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261202",$sPicture5);
					}else if($SG_name=="금정구다선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261203",$sPicture5);
					}else if($SG_name=="금정구라선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261204",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"강서구") !== false){
				$sPicture5 = str_replace("Gsg2600","Gsg2613",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42600","Sgg42613",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="강서구제1선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5261301",$sPicture5);
					}else if($SG_name=="강서구제2선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5261302",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="강서구가선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261301",$sPicture5);
					}else if($SG_name=="강서구나선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261302",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"연제구") !== false){
				$sPicture5 = str_replace("Gsg2600","Gsg2614",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42600","Sgg42614",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="연제구제1선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5261401",$sPicture5);
					}else if($SG_name=="연제구제2선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5261402",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="중구가선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261401",$sPicture5);
					}else if($SG_name=="연제구나선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261402",$sPicture5);
					}else if($SG_name=="연제구다선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261403",$sPicture5);
					}else if($SG_name=="연제구라선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261404",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"수영구") !== false){
				$sPicture5 = str_replace("Gsg2600","Gsg2615",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42600","Sgg42615",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="수영구제1선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5261501",$sPicture5);
					}else if($SG_name=="수영구제2선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5261502",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="수영구가선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261501",$sPicture5);
					}else if($SG_name=="수영구나선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261502",$sPicture5);
					}else if($SG_name=="수영구다선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261503",$sPicture5);
					}else if($SG_name=="수영구라선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261504",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"사상구") !== false){
				$sPicture5 = str_replace("Gsg2600","Gsg2616",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42600","Sgg42616",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="사상구제1선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5261601",$sPicture5);
					}else if($SG_name=="사상구제2선거구"){
						$sPicture5 = str_replace("Sgg5260000","Sgg5261602",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="사상구가선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261601",$sPicture5);
					}else if($SG_name=="사상구나선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261602",$sPicture5);
					}else if($SG_name=="사상구다선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261603",$sPicture5);
					}else if($SG_name=="사상구라선거구"){
						$sPicture5 = str_replace("Sgg6260000","Sgg6261604",$sPicture5);
					}
				}
			}
		}else if($sdN=="대구광역시"){
			$sPicture5 = str_replace("1100","2700",$sPicture4);
			if(strpos($SG_name,"중구") !== false){
				$sPicture5 = str_replace("Gsg2700","Gsg2701",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42700","Sgg42701",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="중구제1선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270101",$sPicture5);
					}else if($SG_name=="중구제2선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270102",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="중구가선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270101",$sPicture5);
					}else if($SG_name=="중구나선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270102",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"동구") !== false){
				$sPicture5 = str_replace("Gsg2700","Gsg2702",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42700","Sgg42702",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="동구제1선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270201",$sPicture5);
					}else if($SG_name=="동구제2선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270202",$sPicture5);
					}else if($SG_name=="동구제3선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270203",$sPicture5);
					}else if($SG_name=="동구제4선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270204",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="동구가선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270201",$sPicture5);
					}else if($SG_name=="동구나선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270202",$sPicture5);
					}else if($SG_name=="동구다선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270203",$sPicture5);
					}else if($SG_name=="동구라선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270204",$sPicture5);
					}else if($SG_name=="동구마선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270205",$sPicture5);
					}else if($SG_name=="동구바선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270206",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"서구") !== false){
				$sPicture5 = str_replace("Gsg2700","Gsg2703",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42700","Sgg42703",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="서구제1선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270301",$sPicture5);
					}else if($SG_name=="서구제2선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270302",$sPicture5);
					}else if($SG_name=="서구제3선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270303",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="서구가선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270301",$sPicture5);
					}else if($SG_name=="서구나선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270302",$sPicture5);
					}else if($SG_name=="서구다선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270303",$sPicture5);
					}else if($SG_name=="서구라선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270304",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"남구") !== false){
				$sPicture5 = str_replace("Gsg2700","Gsg2704",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42700","Sgg42704",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="남구제1선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270401",$sPicture5);
					}else if($SG_name=="남구제2선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270402",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="남구가선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270401",$sPicture5);
					}else if($SG_name=="남구나선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270402",$sPicture5);
					}else if($SG_name=="남구다선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270403",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"북구") !== false){
				$sPicture5 = str_replace("Gsg2700","Gsg2705",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42700","Sgg42705",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="북구제1선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270501",$sPicture5);
					}else if($SG_name=="북구제2선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270502",$sPicture5);
					}else if($SG_name=="북구제3선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270503",$sPicture5);
					}else if($SG_name=="북구제4선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270504",$sPicture5);
					}else if($SG_name=="북구제5선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270505",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="북구가선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270501",$sPicture5);
					}else if($SG_name=="북구나선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270502",$sPicture5);
					}else if($SG_name=="북구다선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270503",$sPicture5);
					}else if($SG_name=="북구라선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270504",$sPicture5);
					}else if($SG_name=="북구마선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270505",$sPicture5);
					}else if($SG_name=="북구바선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270506",$sPicture5);
					}else if($SG_name=="북구사선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270507",$sPicture5);
					}else if($SG_name=="북구아선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270508",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"수성구") !== false){
				$sPicture5 = str_replace("Gsg2700","Gsg2706",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42700","Sgg42706",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="수성구제1선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270601",$sPicture5);
					}else if($SG_name=="수성구제2선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270602",$sPicture5);
					}else if($SG_name=="수성구제3선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270603",$sPicture5);
					}else if($SG_name=="수성구제4선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270604",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="수성구가선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270601",$sPicture5);
					}else if($SG_name=="수성구나선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270602",$sPicture5);
					}else if($SG_name=="수성구다선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270603",$sPicture5);
					}else if($SG_name=="수성구라선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270604",$sPicture5);
					}else if($SG_name=="수성구마선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270605",$sPicture5);
					}else if($SG_name=="수성구바선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270606",$sPicture5);
					}else if($SG_name=="수성구사선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270607",$sPicture5);
					}else if($SG_name=="수성구아선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270608",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"달서구") !== false){
				$sPicture5 = str_replace("Gsg2700","Gsg2707",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42700","Sgg42707",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="달서구제1선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270701",$sPicture5);
					}else if($SG_name=="달서구제2선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270702",$sPicture5);
					}else if($SG_name=="달서구제3선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270703",$sPicture5);
					}else if($SG_name=="달서구제4선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270704",$sPicture5);
					}else if($SG_name=="달서구제5선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270705",$sPicture5);
					}else if($SG_name=="달서구제6선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270706",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="달서구가선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270701",$sPicture5);
					}else if($SG_name=="달서구나선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270702",$sPicture5);
					}else if($SG_name=="달서구다선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270703",$sPicture5);
					}else if($SG_name=="달서구라선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270704",$sPicture5);
					}else if($SG_name=="달서구마선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270705",$sPicture5);
					}else if($SG_name=="달서구바선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270706",$sPicture5);
					}else if($SG_name=="달서구사선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270707",$sPicture5);
					}else if($SG_name=="달서구아선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270708",$sPicture5);
					}else if($SG_name=="달서구자선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270709",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"달성군") !== false){
				$sPicture5 = str_replace("Gsg2700","Gsg2708",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42700","Sgg42708",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="달성군제1선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270801",$sPicture5);
					}else if($SG_name=="달성군제2선거구"){
						$sPicture5 = str_replace("Sgg5270000","Sgg5270802",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="달성군가선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270801",$sPicture5);
					}else if($SG_name=="달성군나선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270802",$sPicture5);
					}else if($SG_name=="달성군다선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270803",$sPicture5);
					}else if($SG_name=="달성군라선거구"){
						$sPicture5 = str_replace("Sgg6270000","Sgg6270804",$sPicture5);
					}
				}
			}
		}else if($sdN=="인천광역시"){
			$sPicture5 = str_replace("1100","2800",$sPicture4);
			if(strpos($SG_name,"중구") !== false){
				$sPicture5 = str_replace("Gsg2800","Gsg2801",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42800","Sgg42801",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="중구제1선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280101",$sPicture5);
					}else if($SG_name=="중구제2선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280102",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="중구가선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280101",$sPicture5);
					}else if($SG_name=="중구나선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280102",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"동구") !== false){
				$sPicture5 = str_replace("Gsg2800","Gsg2802",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42800","Sgg42802",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="동구선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280201",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="동구가선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280201",$sPicture5);
					}else if($SG_name=="동구나선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280202",$sPicture5);
					}else if($SG_name=="동구다선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280203",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"남구") !== false){
				$sPicture5 = str_replace("Gsg2800","Gsg2803",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42800","Sgg42803",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="남구제1선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280301",$sPicture5);
					}else if($SG_name=="남구제2선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280302",$sPicture5);
					}else if($SG_name=="남구제3선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280303",$sPicture5);
					}else if($SG_name=="남구제4선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280304",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="남구가선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280301",$sPicture5);
					}else if($SG_name=="남구나선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280302",$sPicture5);
					}else if($SG_name=="남구다선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280303",$sPicture5);
					}else if($SG_name=="남구라선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280304",$sPicture5);
					}else if($SG_name=="남구마선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280305",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"연수구") !== false){
				$sPicture5 = str_replace("Gsg2800","Gsg2804",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42800","Sgg42804",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="연수구제1선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280401",$sPicture5);
					}else if($SG_name=="연수구제2선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280402",$sPicture5);
					}else if($SG_name=="연수구제3선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280403",$sPicture5);
					}else if($SG_name=="연수구제4선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280404",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="연수구가선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280401",$sPicture5);
					}else if($SG_name=="연수구나선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280402",$sPicture5);
					}else if($SG_name=="연수구다선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280403",$sPicture5);
					}else if($SG_name=="연수구라선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280404",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"남동구") !== false){
				$sPicture5 = str_replace("Gsg2800","Gsg2805",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42800","Sgg42805",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="남동구제1선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280501",$sPicture5);
					}else if($SG_name=="남동구제2선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280502",$sPicture5);
					}else if($SG_name=="남동구제3선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280503",$sPicture5);
					}else if($SG_name=="남동구제4선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280504",$sPicture5);
					}else if($SG_name=="남동구제5선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280505",$sPicture5);
					}else if($SG_name=="남동구제6선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280506",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="남동구가선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280501",$sPicture5);
					}else if($SG_name=="남동구나선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280502",$sPicture5);
					}else if($SG_name=="남동구다선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280503",$sPicture5);
					}else if($SG_name=="남동구라선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280504",$sPicture5);
					}else if($SG_name=="남동구마선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280505",$sPicture5);
					}else if($SG_name=="남동구바선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280506",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"부평구") !== false){
				$sPicture5 = str_replace("Gsg2800","Gsg2806",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42800","Sgg42806",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="부평구제1선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280601",$sPicture5);
					}else if($SG_name=="부평구제2선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280602",$sPicture5);
					}else if($SG_name=="부평구제3선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280603",$sPicture5);
					}else if($SG_name=="부평구제4선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280604",$sPicture5);
					}else if($SG_name=="부평구제5선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280605",$sPicture5);
					}else if($SG_name=="부평구제6선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280606",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="부평구가선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280601",$sPicture5);
					}else if($SG_name=="부평구나선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280602",$sPicture5);
					}else if($SG_name=="부평구다선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280603",$sPicture5);
					}else if($SG_name=="부평구라선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280604",$sPicture5);
					}else if($SG_name=="부평구마선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280605",$sPicture5);
					}else if($SG_name=="부평구바선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280606",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"계양구") !== false){
				$sPicture5 = str_replace("Gsg2800","Gsg2807",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42800","Sgg42807",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="계양구제1선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280701",$sPicture5);
					}else if($SG_name=="계양구제2선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280702",$sPicture5);
					}else if($SG_name=="계양구제3선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280703",$sPicture5);
					}else if($SG_name=="계양구제4선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280704",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="계양구가선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280701",$sPicture5);
					}else if($SG_name=="계양구나선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280702",$sPicture5);
					}else if($SG_name=="계양구다선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280703",$sPicture5);
					}else if($SG_name=="계양구라선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280704",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"서구") !== false){
				$sPicture5 = str_replace("Gsg2800","Gsg2808",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42800","Sgg42808",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="서구제1선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280801",$sPicture5);
					}else if($SG_name=="서구제2선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280802",$sPicture5);
					}else if($SG_name=="서구제3선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280803",$sPicture5);
					}else if($SG_name=="서구제4선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280804",$sPicture5);
					}else if($SG_name=="서구제5선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280805",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="서구가선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280801",$sPicture5);
					}else if($SG_name=="서구나선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280802",$sPicture5);
					}else if($SG_name=="서구다선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280803",$sPicture5);
					}else if($SG_name=="서구라선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280804",$sPicture5);
					}else if($SG_name=="서구마선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280805",$sPicture5);
					}else if($SG_name=="서구바선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280806",$sPicture5);
					}else if($SG_name=="서구사선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280807",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"강화군") !== false){
				$sPicture5 = str_replace("Gsg2800","Gsg2809",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42800","Sgg42809",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="강화군선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5280901",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="강화군가선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280901",$sPicture5);
					}else if($SG_name=="강화군나선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6280902",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"옹진군") !== false){
				$sPicture5 = str_replace("Gsg2800","Gsg2810",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42800","Sgg42810",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="옹진군선거구"){
						$sPicture5 = str_replace("Sgg5280000","Sgg5281001",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="옹진군가선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6281001",$sPicture5);
					}else if($SG_name=="옹진군나선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6281002",$sPicture5);
					}else if($SG_name=="옹진군다선거구"){
						$sPicture5 = str_replace("Sgg6280000","Sgg6281003",$sPicture5);
					}
				}
			}
		}else if($sdN=="광주광역시"){
			$sPicture5 = str_replace("1100","2900",$sPicture4);
			if($strpos($SG_name,"동구") !== false){
				$sPicture5 = str_replace("Gsg2900","Gsg2901",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42900","Sgg42901",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="동구제1선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290101",$sPicture5);
					}else if($SG_name=="동구제2선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290102",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="동구가선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290101",$sPicture5);
					}else if($SG_name=="동구나선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290102",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"서구") !== false){
				$sPicture5 = str_replace("Gsg2900","Gsg2902",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42900","Sgg42902",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="서구제1선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290201",$sPicture5);
					}else if($SG_name=="서구제2선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290202",$sPicture5);
					}else if($SG_name=="서구제3선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290203",$sPicture5);
					}else if($SG_name=="서구제4선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290204",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="서구가선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290201",$sPicture5);
					}else if($SG_name=="서구나선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290202",$sPicture5);
					}else if($SG_name=="서구다선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290203",$sPicture5);
					}else if($SG_name=="서구라선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290204",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"남구") !== false){
				$sPicture5 = str_replace("Gsg2900","Gsg2903",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42900","Sgg42903",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="남구제1선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290301",$sPicture5);
					}else if($SG_name=="남구제2선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290302",$sPicture5);
					}else if($SG_name=="남구제3선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290303",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="남구가선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290301",$sPicture5);
					}else if($SG_name=="남구나선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290302",$sPicture5);
					}else if($SG_name=="남구다선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290303",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"북구") !== false){
				$sPicture5 = str_replace("Gsg2900","Gsg2904",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42900","Sgg42904",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="북구제1선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290401",$sPicture5);
					}else if($SG_name=="북구제2선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290402",$sPicture5);
					}else if($SG_name=="북구제3선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290403",$sPicture5);
					}else if($SG_name=="북구제4선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290404",$sPicture5);
					}else if($SG_name=="북구제5선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290405",$sPicture5);
					}else if($SG_name=="북구제6선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290406",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="북구가선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290401",$sPicture5);
					}else if($SG_name=="북구나선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290402",$sPicture5);
					}else if($SG_name=="북구다선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290403",$sPicture5);
					}else if($SG_name=="북구라선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290404",$sPicture5);
					}else if($SG_name=="북구마선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290405",$sPicture5);
					}else if($SG_name=="북구바선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290406",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"광산구") !== false){
				$sPicture5 = str_replace("Gsg2900","Gsg2905",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg42900","Sgg42905",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="광산구제1선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290501",$sPicture5);
					}else if($SG_name=="광산구제2선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290502",$sPicture5);
					}else if($SG_name=="광산구제3선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290503",$sPicture5);
					}else if($SG_name=="광산구제4선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290504",$sPicture5);
					}else if($SG_name=="광산구제5선거구"){
						$sPicture5 = str_replace("Sgg5290000","Sgg5290505",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="광산구가선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290501",$sPicture5);
					}else if($SG_name=="광산구나선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290502",$sPicture5);
					}else if($SG_name=="광산구다선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290503",$sPicture5);
					}else if($SG_name=="광산구라선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290504",$sPicture5);
					}else if($SG_name=="광산구마선거구"){
						$sPicture5 = str_replace("Sgg6290000","Sgg6290505",$sPicture5);
					}
				}
			}
		}else if($sdN=="대전광역시"){
			$sPicture5 = str_replace("1100","3000",$sPicture4);
			if(strpos($SG_name,"동구") !== false){
				$sPicture5 = str_replace("Gsg3000","Gsg3001",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg43000","Sgg43001",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="동구제1선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300101",$sPicture5);
					}else if($SG_name=="동구제2선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300102",$sPicture5);
					}else if($SG_name=="동구제3선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300103",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="동구가선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300101",$sPicture5);
					}else if($SG_name=="동구나선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300102",$sPicture5);
					}else if($SG_name=="동구다선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300103",$sPicture5);
					}else if($SG_name=="동구라선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300104",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"중구") !== false){
				$sPicture5 = str_replace("Gsg3000","Gsg3002",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg43000","Sgg43002",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="중구제1선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300201",$sPicture5);
					}else if($SG_name=="중구제2선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300202",$sPicture5);
					}else if($SG_name=="중구제3선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300203",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="중구가선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300201",$sPicture5);
					}else if($SG_name=="중구나선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300202",$sPicture5);
					}else if($SG_name=="중구다선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300203",$sPicture5);
					}else if($SG_name=="중구라선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300204",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"서구") !== false){
				$sPicture5 = str_replace("Gsg3000","Gsg3003",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg43000","Sgg43003",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="서구제1선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300301",$sPicture5);
					}else if($SG_name=="서구제2선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300302",$sPicture5);
					}else if($SG_name=="서구제3선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300303",$sPicture5);
					}else if($SG_name=="서구제4선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300304",$sPicture5);
					}else if($SG_name=="서구제5선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300305",$sPicture5);
					}else if($SG_name=="서구제6선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300306",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="서구가선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300301",$sPicture5);
					}else if($SG_name=="서구나선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300302",$sPicture5);
					}else if($SG_name=="서구다선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300303",$sPicture5);
					}else if($SG_name=="서구라선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300304",$sPicture5);
					}else if($SG_name=="서구마선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300305",$sPicture5);
					}else if($SG_name=="서구바선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300306",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"유성구") !== false){
				$sPicture5 = str_replace("Gsg3000","Gsg3004",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg43000","Sgg43004",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="유성구제1선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300401",$sPicture5);
					}else if($SG_name=="유성구제2선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300402",$sPicture5);
					}else if($SG_name=="유성구제3선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300403",$sPicture5);
					}else if($SG_name=="유성구제4선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300404",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="유성구가선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300401",$sPicture5);
					}else if($SG_name=="유성구나선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300402",$sPicture5);
					}else if($SG_name=="유성구다선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300403",$sPicture5);
					}else if($SG_name=="유성구라선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300404",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"대덕구") !== false){
				$sPicture5 = str_replace("Gsg3000","Gsg3005",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg43000","Sgg43005",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="대덕구제1선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300501",$sPicture5);
					}else if($SG_name=="대덕구제2선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300502",$sPicture5);
					}else if($SG_name=="대덕구제3선거구"){
						$sPicture5 = str_replace("Sgg5300000","Sgg5300503",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="대덕구가선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300501",$sPicture5);
					}else if($SG_name=="대덕구나선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300502",$sPicture5);
					}else if($SG_name=="대덕구다선거구"){
						$sPicture5 = str_replace("Sgg6300000","Sgg6300503",$sPicture5);
					}
				}
			}
		}else if($sdN=="울산광역시"){
			$sPicture5 = str_replace("1100","3100",$sPicture4);
			if(strpos($SG_name,"중구") !== false){
				$sPicture5 = str_replace("Gsg3100","Gsg3101",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg43100","Sgg43101",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="중구제1선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310101",$sPicture5);
					}else if($SG_name=="중구제2선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310102",$sPicture5);
					}else if($SG_name=="중구제3선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310103",$sPicture5);
					}else if($SG_name=="중구제4선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310104",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="중구가선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310101",$sPicture5);
					}else if($SG_name=="중구나선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310102",$sPicture5);
					}else if($SG_name=="중구다선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310103",$sPicture5);
					}else if($SG_name=="중구라선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310104",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"남구") !== false){
				$sPicture5 = str_replace("Gsg3100","Gsg3102",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg43100","Sgg43102",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="남구제1선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310201",$sPicture5);
					}else if($SG_name=="남구제2선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310202",$sPicture5);
					}else if($SG_name=="남구제3선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310203",$sPicture5);
					}else if($SG_name=="남구제4선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310204",$sPicture5);
					}else if($SG_name=="남구제5선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310205",$sPicture5);
					}else if($SG_name=="남구제6선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310206",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="남구가선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310201",$sPicture5);
					}else if($SG_name=="남구나선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310202",$sPicture5);
					}else if($SG_name=="남구다선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310203",$sPicture5);
					}else if($SG_name=="남구라선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310204",$sPicture5);
					}else if($SG_name=="남구마선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310205",$sPicture5);
					}else if($SG_name=="남구바선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310206",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"동구") !== false){
				$sPicture5 = str_replace("Gsg3100","Gsg3103",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg43100","Sgg43103",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="동구제1선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310301",$sPicture5);
					}else if($SG_name=="동구제2선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310302",$sPicture5);
					}else if($SG_name=="동구제3선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310303",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="동구가선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310301",$sPicture5);
					}else if($SG_name=="동구나선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310302",$sPicture5);
					}else if($SG_name=="동구다선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310303",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"북구") !== false){
				$sPicture5 = str_replace("Gsg3100","Gsg3104",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg43100","Sgg43104",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="북구제1선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310401",$sPicture5);
					}else if($SG_name=="북구제2선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310402",$sPicture5);
					}else if($SG_name=="북구제3선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310403",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="북구가선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310401",$sPicture5);
					}else if($SG_name=="북구나선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310402",$sPicture5);
					}else if($SG_name=="북구다선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310403",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"울주군") !== false){
				$sPicture5 = str_replace("Gsg3100","Gsg3105",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg43100","Sgg43105",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="울주군제1선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310501",$sPicture5);
					}else if($SG_name=="울주군제2선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310502",$sPicture5);
					}else if($SG_name=="울주군제3선거구"){
						$sPicture5 = str_replace("Sgg5310000","Sgg5310503",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="울주군가선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310501",$sPicture5);
					}else if($SG_name=="울주군나선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310502",$sPicture5);
					}else if($SG_name=="울주군다선거구"){
						$sPicture5 = str_replace("Sgg6310000","Sgg6310503",$sPicture5);
					}
				}
			}
		}else if($sdN=="서울특별자치시"){
			$sPicture5 = str_replace("1100","5100",$sPicture4);
		}else if($sdN=="경기도"){
			$sPicture5 = str_replace("1100","4100",$sPicture4);
			if(strpos($SG_name,"수원시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4101",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44101",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="수원시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410101",$sPicture5);
					}else if($SG_name=="수원시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410102",$sPicture5);
					}else if($SG_name=="수원시제3선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410103",$sPicture5);
					}else if($SG_name=="수원시제4선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410104",$sPicture5);
					}else if($SG_name=="수원시제5선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410105",$sPicture5);
					}else if($SG_name=="수원시제6선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410106",$sPicture5);
					}else if($SG_name=="수원시제7선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410107",$sPicture5);
					}else if($SG_name=="수원시제8선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410108",$sPicture5);
					}else if($SG_name=="수원시제9선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410109",$sPicture5);
					}else if($SG_name=="수원시제10선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410110",$sPicture5);
					}else if($SG_name=="수원시제11선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410111",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="수원시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410101",$sPicture5);
					}else if($SG_name=="수원시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410102",$sPicture5);
					}else if($SG_name=="수원시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410103",$sPicture5);
					}else if($SG_name=="수원시라선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410104",$sPicture5);
					}else if($SG_name=="수원시마선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410105",$sPicture5);
					}else if($SG_name=="수원시바선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410106",$sPicture5);
					}else if($SG_name=="수원시사선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410107",$sPicture5);
					}else if($SG_name=="수원시아선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410108",$sPicture5);
					}else if($SG_name=="수원시자선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410109",$sPicture5);
					}else if($SG_name=="수원시차선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410110",$sPicture5);
					}else if($SG_name=="수원시카선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410111",$sPicture5);
					}else if($SG_name=="수원시타선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410112",$sPicture5);
					}else if($SG_name=="수원시파선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410113",$sPicture5);
					}else if($SG_name=="수원시하선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410114",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"성남시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4102",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44102",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="성남시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410201",$sPicture5);
					}else if($SG_name=="성남시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410202",$sPicture5);
					}else if($SG_name=="성남시제3선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410203",$sPicture5);
					}else if($SG_name=="성남시제4선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410204",$sPicture5);
					}else if($SG_name=="성남시제5선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410205",$sPicture5);
					}else if($SG_name=="성남시제6선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410206",$sPicture5);
					}else if($SG_name=="성남시제7선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410207",$sPicture5);
					}else if($SG_name=="성남시제8선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410208",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="성남시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410201",$sPicture5);
					}else if($SG_name=="성남시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410202",$sPicture5);
					}else if($SG_name=="성남시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410203",$sPicture5);
					}else if($SG_name=="성남시라선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410204",$sPicture5);
					}else if($SG_name=="성남시마선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410205",$sPicture5);
					}else if($SG_name=="성남시바선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410206",$sPicture5);
					}else if($SG_name=="성남시사선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410207",$sPicture5);
					}else if($SG_name=="성남시아선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410208",$sPicture5);
					}else if($SG_name=="성남시자선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410209",$sPicture5);
					}else if($SG_name=="성남시차선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410210",$sPicture5);
					}else if($SG_name=="성남시카선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410211",$sPicture5);
					}else if($SG_name=="성남시타선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410212",$sPicture5);
					}else if($SG_name=="성남시파선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410213",$sPicture5);
					}else if($SG_name=="성남시하선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410214",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"의정부시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4103",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44103",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="의정부시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410301",$sPicture5);
					}else if($SG_name=="의정부시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410302",$sPicture5);
					}else if($SG_name=="의정부시제3선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410303",$sPicture5);
					}else if($SG_name=="의정부시제4선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410304",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="의정부시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410301",$sPicture5);
					}else if($SG_name=="의정부시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410302",$sPicture5);
					}else if($SG_name=="의정부시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410303",$sPicture5);
					}else if($SG_name=="의정부시라선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410304",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"안양시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4104",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44104",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="안양시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410401",$sPicture5);
					}else if($SG_name=="안양시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410402",$sPicture5);
					}else if($SG_name=="안양시제3선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410403",$sPicture5);
					}else if($SG_name=="안양시제4선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410404",$sPicture5);
					}else if($SG_name=="안양시제5선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410405",$sPicture5);
					}else if($SG_name=="안양시제6선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410406",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="안양시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410401",$sPicture5);
					}else if($SG_name=="안양시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410402",$sPicture5);
					}else if($SG_name=="안양시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410403",$sPicture5);
					}else if($SG_name=="안양시라선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410404",$sPicture5);
					}else if($SG_name=="안양시마선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410405",$sPicture5);
					}else if($SG_name=="안양시바선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410406",$sPicture5);
					}else if($SG_name=="안양시사선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410407",$sPicture5);
					}else if($SG_name=="안양시아선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410408",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"부천시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4105",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44105",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="부천시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410501",$sPicture5);
					}else if($SG_name=="부천시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410502",$sPicture5);
					}else if($SG_name=="부천시제3선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410503",$sPicture5);
					}else if($SG_name=="부천시제4선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410504",$sPicture5);
					}else if($SG_name=="부천시제5선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410505",$sPicture5);
					}else if($SG_name=="부천시제6선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410506",$sPicture5);
					}else if($SG_name=="부천시제7선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410507",$sPicture5);
					}else if($SG_name=="부천시제8선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410508",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="부천시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410501",$sPicture5);
					}else if($SG_name=="부천시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410502",$sPicture5);
					}else if($SG_name=="부천시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410503",$sPicture5);
					}else if($SG_name=="부천시라선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410504",$sPicture5);
					}else if($SG_name=="부천시마선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410505",$sPicture5);
					}else if($SG_name=="부천시바선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410506",$sPicture5);
					}else if($SG_name=="부천시사선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410507",$sPicture5);
					}else if($SG_name=="부천시아선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410508",$sPicture5);
					}else if($SG_name=="부천시자선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410509",$sPicture5);
					}else if($SG_name=="부천시차선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410510",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"광명시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4106",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44106",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="광명시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410601",$sPicture5);
					}else if($SG_name=="광명시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410602",$sPicture5);
					}else if($SG_name=="광명시제3선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410603",$sPicture5);
					}else if($SG_name=="광명시제4선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410604",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="광명시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410601",$sPicture5);
					}else if($SG_name=="광명시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410602",$sPicture5);
					}else if($SG_name=="광명시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410603",$sPicture5);
					}else if($SG_name=="광명시라선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410604",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"평택시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4107",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44107",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="평택시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410701",$sPicture5);
					}else if($SG_name=="평택시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410702",$sPicture5);
					}else if($SG_name=="평택시제3선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410703",$sPicture5);
					}else if($SG_name=="평택시제4선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410704",$sPicture5);
					}else if($SG_name=="평택시제5선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410705",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="평택시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410701",$sPicture5);
					}else if($SG_name=="평택시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410702",$sPicture5);
					}else if($SG_name=="평택시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410703",$sPicture5);
					}else if($SG_name=="평택시라선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410704",$sPicture5);
					}else if($SG_name=="평택시마선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410705",$sPicture5);
					}else if($SG_name=="평택시바선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410706",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"양주시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4108",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44108",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="양주시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410801",$sPicture5);
					}else if($SG_name=="양주시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410802",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="양주시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410801",$sPicture5);
					}else if($SG_name=="양주시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410802",$sPicture5);
					}else if($SG_name=="양주시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410803",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"동두천시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4109",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44109",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="동두천시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410901",$sPicture5);
					}else if($SG_name=="동두천시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5410902",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="동두천시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410901",$sPicture5);
					}else if($SG_name=="동두천시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6410902",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"안산시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4110",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44110","Sgg44110",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="안산시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411001",$sPicture5);
					}else if($SG_name=="안산시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411002",$sPicture5);
					}else if($SG_name=="안산시제3선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411003",$sPicture5);
					}else if($SG_name=="안산시제4선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411004",$sPicture5);
					}else if($SG_name=="안산시제5선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411005",$sPicture5);
					}else if($SG_name=="안산시제6선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411006",$sPicture5);
					}else if($SG_name=="안산시제7선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411007",$sPicture5);
					}else if($SG_name=="안산시제8선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411008",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="안산시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411001",$sPicture5);
					}else if($SG_name=="안산시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411002",$sPicture5);
					}else if($SG_name=="안산시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411003",$sPicture5);
					}else if($SG_name=="안산시라선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411004",$sPicture5);
					}else if($SG_name=="안산시마선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411005",$sPicture5);
					}else if($SG_name=="안산시바선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411006",$sPicture5);
					}else if($SG_name=="안산시사선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411007",$sPicture5);
					}else if($SG_name=="안산시아선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411008",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"고양시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4111",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44111",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="고양시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411101",$sPicture5);
					}else if($SG_name=="고양시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411102",$sPicture5);
					}else if($SG_name=="고양시제3선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411103",$sPicture5);
					}else if($SG_name=="고양시제4선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411104",$sPicture5);
					}else if($SG_name=="고양시제5선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411105",$sPicture5);
					}else if($SG_name=="고양시제6선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411106",$sPicture5);
					}else if($SG_name=="고양시제7선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411107",$sPicture5);
					}else if($SG_name=="고양시제8선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411108",$sPicture5);
					}else if($SG_name=="고양시제9선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411109",$sPicture5);
					}else if($SG_name=="고양시제10선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411110",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="고양시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411101",$sPicture5);
					}else if($SG_name=="고양시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411102",$sPicture5);
					}else if($SG_name=="고양시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411103",$sPicture5);
					}else if($SG_name=="고양시라선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411104",$sPicture5);
					}else if($SG_name=="고양시마선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411105",$sPicture5);
					}else if($SG_name=="고양시바선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411106",$sPicture5);
					}else if($SG_name=="고양시사선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411107",$sPicture5);
					}else if($SG_name=="고양시아선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411108",$sPicture5);
					}else if($SG_name=="고양시자선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411109",$sPicture5);
					}else if($SG_name=="고양시차선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411110",$sPicture5);
					}else if($SG_name=="고양시카선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411111",$sPicture5);
					}else if($SG_name=="고양시타선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411112",$sPicture5);
					}else if($SG_name=="고양시파선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411113",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"과천시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4112",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44112",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="과천시선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411201",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="과천시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411201",$sPicture5);
					}else if($SG_name=="과천시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411202",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"의왕시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4113",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44113",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="의왕시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411301",$sPicture5);
					}else if($SG_name=="의왕시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411302",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="의왕시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411301",$sPicture5);
					}else if($SG_name=="의왕시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411302",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"구리시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4114",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44114",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="구리시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411401",$sPicture5);
					}else if($SG_name=="구리시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411402",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="구리시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411401",$sPicture5);
					}else if($SG_name=="구리시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411402",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"남양주시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4115",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44115",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="남양주시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411501",$sPicture5);
					}else if($SG_name=="남양주시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411502",$sPicture5);
					}else if($SG_name=="남양주시제3선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411503",$sPicture5);
					}else if($SG_name=="남양주시제4선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411504",$sPicture5);
					}else if($SG_name=="남양주시제5선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411505",$sPicture5);
					}else if($SG_name=="남양주시제6선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411506",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="남양주시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411501",$sPicture5);
					}else if($SG_name=="남양주시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411502",$sPicture5);
					}else if($SG_name=="남양주시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411503",$sPicture5);
					}else if($SG_name=="남양주시라선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411504",$sPicture5);
					}else if($SG_name=="남양주시마선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411505",$sPicture5);
					}else if($SG_name=="남양주시바선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411506",$sPicture5);
					}else if($SG_name=="남양주시사선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411507",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"오산시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4116",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44116",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="오산시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411601",$sPicture5);
					}else if($SG_name=="오산시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411602",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="오산시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411601",$sPicture5);
					}else if($SG_name=="오산시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411602",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"화성시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4117",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44117",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="화성시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411701",$sPicture5);
					}else if($SG_name=="화성시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411702",$sPicture5);
					}else if($SG_name=="화성시제3선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411703",$sPicture5);
					}else if($SG_name=="화성시제4선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411704",$sPicture5);
					}else if($SG_name=="화성시제5선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411705",$sPicture5);
					}else if($SG_name=="화성시제6선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411706",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="화성시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411701",$sPicture5);
					}else if($SG_name=="화성시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411702",$sPicture5);
					}else if($SG_name=="화성시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411703",$sPicture5);
					}else if($SG_name=="화성시라선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411704",$sPicture5);
					}else if($SG_name=="화성시마선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411705",$sPicture5);
					}else if($SG_name=="화성시바선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411706",$sPicture5);
					}else if($SG_name=="화성시사선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411707",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"시흥시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4118",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44118",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="시흥시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411801",$sPicture5);
					}else if($SG_name=="시흥시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411802",$sPicture5);
					}else if($SG_name=="시흥시제3선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411803",$sPicture5);
					}else if($SG_name=="시흥시제4선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411804",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="시흥시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411801",$sPicture5);
					}else if($SG_name=="시흥시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411802",$sPicture5);
					}else if($SG_name=="시흥시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411803",$sPicture5);
					}else if($SG_name=="시흥시라선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411804",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"군포시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4119",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44119",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="군포시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411901",$sPicture5);
					}else if($SG_name=="군포시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411902",$sPicture5);
					}else if($SG_name=="군포시제3선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411903",$sPicture5);
					}else if($SG_name=="군포시제4선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5411904",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="군포시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411901",$sPicture5);
					}else if($SG_name=="군포시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411902",$sPicture5);
					}else if($SG_name=="군포시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411903",$sPicture5);
					}else if($SG_name=="군포시라선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6411904",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"하남시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4120",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44120",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="하남시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412001",$sPicture5);
					}else if($SG_name=="하남시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412002",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="하남시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412001",$sPicture5);
					}else if($SG_name=="하남시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412002",$sPicture5);
					}else if($SG_name=="하남시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412003",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"파주시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4121",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44121",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="파주시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412101",$sPicture5);
					}else if($SG_name=="파주시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412102",$sPicture5);
					}else if($SG_name=="파주시제3선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412103",$sPicture5);
					}else if($SG_name=="파주시제4선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412104",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="파주시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412101",$sPicture5);
					}else if($SG_name=="파주시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412102",$sPicture5);
					}else if($SG_name=="파주시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412103",$sPicture5);
					}else if($SG_name=="파주시라선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412104",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"여주시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4122",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44122",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="여주시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412201",$sPicture5);
					}else if($SG_name=="여주시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412202",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="여주시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412201",$sPicture5);
					}else if($SG_name=="여주시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412202",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"이천시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4123",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44123",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="이천시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412301",$sPicture5);
					}else if($SG_name=="이천시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412302",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="이천시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412301",$sPicture5);
					}else if($SG_name=="이천시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412302",$sPicture5);
					}else if($SG_name=="이천시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412303",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"용인시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4124",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44124",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="용인시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412401",$sPicture5);
					}else if($SG_name=="용인시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412402",$sPicture5);
					}else if($SG_name=="용인시제3선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412403",$sPicture5);
					}else if($SG_name=="용인시제4선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412404",$sPicture5);
					}else if($SG_name=="용인시제5선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412405",$sPicture5);
					}else if($SG_name=="용인시제6선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412406",$sPicture5);
					}else if($SG_name=="용인시제7선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412407",$sPicture5);
					}else if($SG_name=="용인시제8선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412408",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="용인시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412401",$sPicture5);
					}else if($SG_name=="용인시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412402",$sPicture5);
					}else if($SG_name=="용인시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412403",$sPicture5);
					}else if($SG_name=="용인시라선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412404",$sPicture5);
					}else if($SG_name=="용인시마선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412405",$sPicture5);
					}else if($SG_name=="용인시바선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412406",$sPicture5);
					}else if($SG_name=="용인시사선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412407",$sPicture5);
					}else if($SG_name=="용인시아선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412408",$sPicture5);
					}else if($SG_name=="용인시자선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412409",$sPicture5);
					}else if($SG_name=="용인시차선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412410",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"안성시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4125",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44125","Sgg44125",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="안성시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412501",$sPicture5);
					}else if($SG_name=="안성시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412502",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="안성시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412501",$sPicture5);
					}else if($SG_name=="안성시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412502",$sPicture5);
					}else if($SG_name=="안성시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412503",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"김포시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4126",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44126",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="김포시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412601",$sPicture5);
					}else if($SG_name=="김포시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412602",$sPicture5);
					}else if($SG_name=="김포시제3선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412603",$sPicture5);
					}else if($SG_name=="김포시제4선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412604",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="김포시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412601",$sPicture5);
					}else if($SG_name=="김포시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412602",$sPicture5);
					}else if($SG_name=="김포시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412603",$sPicture5);
					}else if($SG_name=="김포시라선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412604",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"광주시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4127",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44127",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="광주시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412701",$sPicture5);
					}else if($SG_name=="광주시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412702",$sPicture5);
					}else if($SG_name=="광주시제3선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412703",$sPicture5);
					}else if($SG_name=="광주시제4선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412704",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="광주시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412701",$sPicture5);
					}else if($SG_name=="광주시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412702",$sPicture5);
					}else if($SG_name=="광주시다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412703",$sPicture5);
					}else if($SG_name=="광주시라선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412704",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"포천시") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4128",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44128",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="포천시제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412801",$sPicture5);
					}else if($SG_name=="포천시제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412802",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="포천시가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412801",$sPicture5);
					}else if($SG_name=="포천시나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412802",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"연천군") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4129",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44129",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="연천군선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5412901",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="연천군가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412901",$sPicture5);
					}else if($SG_name=="연천군나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6412902",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"양평군") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4130",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44130",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="양평군제1선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5413001",$sPicture5);
					}else if($SG_name=="양평군제2선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5413002",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="양평군가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6413001",$sPicture5);
					}else if($SG_name=="양평군나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6413002",$sPicture5);
					}
				}
			}else if(strpos($SG_name,"가평군") !== false){
				$sPicture5 = str_replace("Gsg4100","Gsg4131",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44100","Sgg44131",$sPicture5);
				}else if($sgT=="5"){
					if($SG_name=="가평군선거구"){
						$sPicture5 = str_replace("Sgg5410000","Sgg5413101",$sPicture5);
					}
				}else if($sgT=="6"){
					if($SG_name=="가평군가선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6413101",$sPicture5);
					}else if($SG_name=="가평군나선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6413102",$sPicture5);
					}else if($SG_name=="가평군다선거구"){
						$sPicture5 = str_replace("Sgg6410000","Sgg6413103",$sPicture5);
					}
				}
			}
			
		}else if($sdN=="강원도"){
			$sPicture5 = str_replace("1100","4200",$sPicture4);
			if($SG_name=="춘천시"){
				$sPicture5 = str_replace("Gsg4200","Gsg4201",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44201",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54201",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64201",$sPicture5);
				}
			}else if($SG_name=="원주시"){
				$sPicture5 = str_replace("Gsg4200","Gsg4202",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44202",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54202",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64202",$sPicture5);
				}
			}else if($SG_name=="강릉시"){
				$sPicture5 = str_replace("Gsg4200","Gsg4203",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44203",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54203",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64203",$sPicture5);
				}
			}else if($SG_name=="동해시"){
				$sPicture5 = str_replace("Gsg4200","Gsg4204",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44204",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54204",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64204",$sPicture5);
				}
			}else if($SG_name=="삼척시"){
				$sPicture5 = str_replace("Gsg4200","Gsg4205",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44205",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54205",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64205",$sPicture5);
				}
			}else if($SG_name=="태백시"){
				$sPicture5 = str_replace("Gsg4200","Gsg4206",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44206",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54206",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64206",$sPicture5);
				}
			}else if($SG_name=="정선군"){
				$sPicture5 = str_replace("Gsg4200","Gsg4207",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44207",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54207",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64207",$sPicture5);
				}
			}else if($SG_name=="속초시"){
				$sPicture5 = str_replace("Gsg4200","Gsg4208",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44208",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54208",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64208",$sPicture5);
				}
			}else if($SG_name=="고성군"){
				$sPicture5 = str_replace("Gsg4200","Gsg4209",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44209",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54209",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64209",$sPicture5);
				}
			}else if($SG_name=="양양군"){
				$sPicture5 = str_replace("Gsg4200","Gsg4210",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44210",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54210",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64210",$sPicture5);
				}
			}else if($SG_name=="인제군"){
				$sPicture5 = str_replace("Gsg4200","Gsg4211",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44211",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54211",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64211",$sPicture5);
				}
			}else if($SG_name=="홍천군"){
				$sPicture5 = str_replace("Gsg4200","Gsg4212",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44212",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54212",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64212",$sPicture5);
				}
			}else if($SG_name=="횡성군"){
				$sPicture5 = str_replace("Gsg4200","Gsg4213",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44213",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54213",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64213",$sPicture5);
				}
			}else if($SG_name=="영월군"){
				$sPicture5 = str_replace("Gsg4200","Gsg4214",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44214",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54214",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64214",$sPicture5);
				}
			}else if($SG_name=="평창군"){
				$sPicture5 = str_replace("Gsg4200","Gsg4215",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44215",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54215",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64215",$sPicture5);
				}
			}else if($SG_name=="화천군"){
				$sPicture5 = str_replace("Gsg4200","Gsg4216",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44216",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54216",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64216",$sPicture5);
				}
			}else if($SG_name=="양구군"){
				$sPicture5 = str_replace("Gsg4200","Gsg4217",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44217",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54217",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64217",$sPicture5);
				}
			}else if($SG_name=="춸원군"){
				$sPicture5 = str_replace("Gsg4200","Gsg4218",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44200","Sgg44218",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54200","Sgg54218",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64200","Sgg64218",$sPicture5);
				}
			}
		}else if($sdN=="충청북도"){
			$sPicture5 = str_replace("1100","4300",$sPicture4);
			if($SG_name=="청주시"){
				$sPicture5 = str_replace("Gsg4300","Gsg4301",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44300","Sgg44301",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54300","Sgg54301",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64300","Sgg64301",$sPicture5);
				}
			}else if($SG_name=="충주시"){
				$sPicture5 = str_replace("Gsg4300","Gsg4302",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44300","Sgg44302",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54300","Sgg54302",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64300","Sgg64302",$sPicture5);
				}
			}else if($SG_name=="제천시"){
				$sPicture5 = str_replace("Gsg4300","Gsg4303",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44300","Sgg44303",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54300","Sgg54303",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64300","Sgg64303",$sPicture5);
				}
			}else if($SG_name=="단양군"){
				$sPicture5 = str_replace("Gsg4300","Gsg4304",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44300","Sgg44304",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54300","Sgg54304",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64300","Sgg64304",$sPicture5);
				}
			}else if($SG_name=="영동군"){
				$sPicture5 = str_replace("Gsg4300","Gsg4305",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44300","Sgg44305",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54300","Sgg54305",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64300","Sgg64305",$sPicture5);
				}
			}else if($SG_name=="보은군"){
				$sPicture5 = str_replace("Gsg4300","Gsg4306",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44300","Sgg44306",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54300","Sgg54306",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64300","Sgg64306",$sPicture5);
				}
			}else if($SG_name=="옥천군"){
				$sPicture5 = str_replace("Gsg4300","Gsg4307",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44300","Sgg44307",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54300","Sgg54307",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64300","Sgg64307",$sPicture5);
				}
			}else if($SG_name=="음성군"){
				$sPicture5 = str_replace("Gsg4300","Gsg4308",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44300","Sgg44308",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54300","Sgg54308",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64300","Sgg64308",$sPicture5);
				}
			}else if($SG_name=="진천군"){
				$sPicture5 = str_replace("Gsg4300","Gsg4309",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44300","Sgg44309",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54300","Sgg54309",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64300","Sgg64309",$sPicture5);
				}
			}else if($SG_name=="괴산군"){
				$sPicture5 = str_replace("Gsg4300","Gsg4310",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44300","Sgg44310",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54300","Sgg54310",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64300","Sgg64310",$sPicture5);
				}
			}else if($SG_name=="증평군"){
				$sPicture5 = str_replace("Gsg4300","Gsg4311",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44300","Sgg44311",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54300","Sgg54311",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64300","Sgg64311",$sPicture5);
				}
			}
		}else if($sdN=="충청남도"){
			$sPicture5 = str_replace("1100","4400",$sPicture4);
			if($SG_name=="천안시"){
				$sPicture5 = str_replace("Gsg4400","Gsg4401",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44400","Sgg44401",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54400","Sgg54401",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64400","Sgg64401",$sPicture5);
				}
			}else if($SG_name=="공주시"){
				$sPicture5 = str_replace("Gsg4400","Gsg4402",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44400","Sgg44402",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54400","Sgg54402",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64400","Sgg64402",$sPicture5);
				}
			}else if($SG_name=="보령시"){
				$sPicture5 = str_replace("Gsg4400","Gsg4403",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44400","Sgg44403",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54400","Sgg54403",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64400","Sgg64403",$sPicture5);
				}
			}else if($SG_name=="아산시"){
				$sPicture5 = str_replace("Gsg4400","Gsg4404",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44400","Sgg44404",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54400","Sgg54404",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64400","Sgg64404",$sPicture5);
				}
			}else if($SG_name=="서산시"){
				$sPicture5 = str_replace("Gsg4400","Gsg4405",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44400","Sgg44405",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54400","Sgg54405",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64400","Sgg64405",$sPicture5);
				}
			}else if($SG_name=="태안군"){
				$sPicture5 = str_replace("Gsg4400","Gsg4406",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44400","Sgg44406",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54400","Sgg54406",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64400","Sgg64406",$sPicture5);
				}
			}else if($SG_name=="금산군"){
				$sPicture5 = str_replace("Gsg4400","Gsg4407",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44400","Sgg44407",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54400","Sgg54407",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64400","Sgg64407",$sPicture5);
				}
			}else if($SG_name=="논산시"){
				$sPicture5 = str_replace("Gsg4400","Gsg4408",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44400","Sgg44408",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54400","Sgg54408",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64400","Sgg64408",$sPicture5);
				}
			}else if($SG_name=="계룡시"){
				$sPicture5 = str_replace("Gsg4400","Gsg4409",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44400","Sgg44409",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54400","Sgg54409",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64400","Sgg64409",$sPicture5);
				}
			}else if($SG_name=="당진시"){
				$sPicture5 = str_replace("Gsg4400","Gsg4410",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44400","Sgg44410",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54400","Sgg54410",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64400","Sgg64410",$sPicture5);
				}
			}else if($SG_name=="부여군"){
				$sPicture5 = str_replace("Gsg4400","Gsg4411",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44400","Sgg44411",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54400","Sgg54411",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64400","Sgg64411",$sPicture5);
				}
			}else if($SG_name=="서처군"){
				$sPicture5 = str_replace("Gsg4400","Gsg4412",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44400","Sgg44412",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54400","Sgg54412",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64400","Sgg64412",$sPicture5);
				}
			}else if($SG_name=="홍성군"){
				$sPicture5 = str_replace("Gsg4400","Gsg4413",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44400","Sgg44413",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54400","Sgg54413",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64400","Sgg64413",$sPicture5);
				}
			}else if($SG_name=="청양군"){
				$sPicture5 = str_replace("Gsg4400","Gsg4414",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44400","Sgg44414",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54400","Sgg54414",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64400","Sgg64414",$sPicture5);
				}
			}else if($SG_name=="예산군"){
				$sPicture5 = str_replace("Gsg4400","Gsg4415",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44400","Sgg44415",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54400","Sgg54415",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64400","Sgg64415",$sPicture5);
				}
			}
		}else if($sdN=="전라북도"){
			$sPicture5 = str_replace("1100","4500",$sPicture4);
			if($SG_name=="전주시"){
				$sPicture5 = str_replace("Gsg4500","Gsg4501",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44500","Sgg44501",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54500","Sgg54501",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64500","Sgg64501",$sPicture5);
				}
			}else if($SG_name=="군산시"){
				$sPicture5 = str_replace("Gsg4500","Gsg4502",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44500","Sgg44502",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54500","Sgg54502",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64500","Sgg64502",$sPicture5);
				}
			}else if($SG_name=="익산시"){
				$sPicture5 = str_replace("Gsg4500","Gsg4503",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44500","Sgg44503",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54500","Sgg54503",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64500","Sgg64503",$sPicture5);
				}
			}else if($SG_name=="정읍시"){
				$sPicture5 = str_replace("Gsg4500","Gsg4504",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44500","Sgg44504",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54500","Sgg54504",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64500","Sgg64504",$sPicture5);
				}
			}else if($SG_name=="남원시"){
				$sPicture5 = str_replace("Gsg4500","Gsg4505",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44500","Sgg44505",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54500","Sgg54505",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64500","Sgg64505",$sPicture5);
				}
			}else if($SG_name=="김제시"){
				$sPicture5 = str_replace("Gsg4500","Gsg4506",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44500","Sgg44506",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54500","Sgg54506",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64500","Sgg64506",$sPicture5);
				}
			}else if($SG_name=="완주군"){
				$sPicture5 = str_replace("Gsg4500","Gsg4507",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44500","Sgg44507",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54500","Sgg54507",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64500","Sgg64507",$sPicture5);
				}
			}else if($SG_name=="진안군"){
				$sPicture5 = str_replace("Gsg4500","Gsg4508",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44500","Sgg44508",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54500","Sgg54508",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64500","Sgg64508",$sPicture5);
				}
			}else if($SG_name=="무주군"){
				$sPicture5 = str_replace("Gsg4500","Gsg4509",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44500","Sgg44509",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54500","Sgg54509",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64500","Sgg64509",$sPicture5);
				}
			}else if($SG_name=="장수군"){
				$sPicture5 = str_replace("Gsg4500","Gsg4510",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44500","Sgg44510",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54500","Sgg54510",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64500","Sgg64510",$sPicture5);
				}
			}else if($SG_name=="임실군"){
				$sPicture5 = str_replace("Gsg4500","Gsg4511",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44500","Sgg44511",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54500","Sgg54511",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64500","Sgg64511",$sPicture5);
				}
			}else if($SG_name=="순창군"){
				$sPicture5 = str_replace("Gsg4500","Gsg4512",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44500","Sgg44512",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54500","Sgg54512",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64500","Sgg64512",$sPicture5);
				}
			}else if($SG_name=="고창군"){
				$sPicture5 = str_replace("Gsg4500","Gsg4513",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44500","Sgg44513",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54500","Sgg54513",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64500","Sgg64513",$sPicture5);
				}
			}else if($SG_name=="부안군"){
				$sPicture5 = str_replace("Gsg4500","Gsg4514",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44500","Sgg44514",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54500","Sgg54514",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64500","Sgg64514",$sPicture5);
				}
			}
		}else if($sdN=="전라남도"){
			$sPicture5 = str_replace("1100","4600",$sPicture4);
			if($SG_name=="목포시"){
				$sPicture5 = str_replace("Gsg4600","Gsg4601",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44601",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54601",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64601",$sPicture5);
				}
			}else if($SG_name=="여수시"){
				$sPicture5 = str_replace("Gsg4600","Gsg4602",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44602",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54602",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64602",$sPicture5);
				}
			}else if($SG_name=="순천시"){
				$sPicture5 = str_replace("Gsg4600","Gsg4603",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44603",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54603",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64603",$sPicture5);
				}
			}else if($SG_name=="나주시"){
				$sPicture5 = str_replace("Gsg4600","Gsg4604",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44604",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54604",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64604",$sPicture5);
				}
			}else if($SG_name=="광양시"){
				$sPicture5 = str_replace("Gsg4600","Gsg4605",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44605",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54605",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64605",$sPicture5);
				}
			}else if($SG_name=="담양군"){
				$sPicture5 = str_replace("Gsg4600","Gsg4606",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44606",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54606",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64606",$sPicture5);
				}
			}else if($SG_name=="장성군"){
				$sPicture5 = str_replace("Gsg4600","Gsg4607",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44607",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54607",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64607",$sPicture5);
				}
			}else if($SG_name=="곡성군"){
				$sPicture5 = str_replace("Gsg4600","Gsg4608",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44608",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54608",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64608",$sPicture5);
				}
			}else if($SG_name=="구례군"){
				$sPicture5 = str_replace("Gsg4600","Gsg4609",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44609",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54609",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64609",$sPicture5);
				}
			}else if($SG_name=="고흥군"){
				$sPicture5 = str_replace("Gsg4600","Gsg4610",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44610",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54610",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64610",$sPicture5);
				}
			}else if($SG_name=="보성군"){
				$sPicture5 = str_replace("Gsg4600","Gsg4611",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44611",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54611",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64611",$sPicture5);
				}
			}else if($SG_name=="화순군"){
				$sPicture5 = str_replace("Gsg4600","Gsg4612",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44612",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54612",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64612",$sPicture5);
				}
			}else if($SG_name=="장흥군"){
				$sPicture5 = str_replace("Gsg4600","Gsg4613",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44613",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54613",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64613",$sPicture5);
				}
			}else if($SG_name=="강진군"){
				$sPicture5 = str_replace("Gsg4600","Gsg4614",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44614",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54614",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64614",$sPicture5);
				}
			}else if($SG_name=="완도군"){
				$sPicture5 = str_replace("Gsg4600","Gsg4615",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44615",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54615",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64615",$sPicture5);
				}
			}else if($SG_name=="해남군"){
				$sPicture5 = str_replace("Gsg4600","Gsg4616",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44616",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54616",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64616",$sPicture5);
				}
			}else if($SG_name=="진도군"){
				$sPicture5 = str_replace("Gsg4600","Gsg4617",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44617",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54617",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64617",$sPicture5);
				}
			}else if($SG_name=="영암군"){
				$sPicture5 = str_replace("Gsg4600","Gsg4618",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44618",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54618",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64618",$sPicture5);
				}
			}else if($SG_name=="무안군"){
				$sPicture5 = str_replace("Gsg4600","Gsg4619",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44619",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54619",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64619",$sPicture5);
				}
			}else if($SG_name=="영광군"){
				$sPicture5 = str_replace("Gsg4600","Gsg4620",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44620",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54620",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64620",$sPicture5);
				}
			}else if($SG_name=="함평군"){
				$sPicture5 = str_replace("Gsg4600","Gsg4621",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44621",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54621",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64621",$sPicture5);
				}
			}else if($SG_name=="신안군"){
				$sPicture5 = str_replace("Gsg4600","Gsg4622",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44600","Sgg44622",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54600","Sgg54622",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64600","Sgg64622",$sPicture5);
				}
			}
		}else if($sdN=="경상북도"){
			$sPicture5 = str_replace("1100","4700",$sPicture4);
			if($SG_name=="포항시"){
				$sPicture5 = str_replace("Gsg4700","Gsg4701",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44701",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54701",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64701",$sPicture5);
				}
			}else if($SG_name=="울릉군"){
				$sPicture5 = str_replace("Gsg4700","Gsg4702",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44702",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54702",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64702",$sPicture5);
				}
			}else if($SG_name=="경주시"){
				$sPicture5 = str_replace("Gsg4700","Gsg4703",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44703",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54703",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64703",$sPicture5);
				}
			}else if($SG_name=="김천시"){
				$sPicture5 = str_replace("Gsg4700","Gsg4704",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44704",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54704",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64704",$sPicture5);
				}
			}else if($SG_name=="안동시"){
				$sPicture5 = str_replace("Gsg4700","Gsg4705",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44705",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54705",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64705",$sPicture5);
				}
			}else if($SG_name=="구미시"){
				$sPicture5 = str_replace("Gsg4700","Gsg4706",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44706",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54706",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64706",$sPicture5);
				}
			}else if($SG_name=="영주시"){
				$sPicture5 = str_replace("Gsg4700","Gsg4707",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44707",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54707",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64707",$sPicture5);
				}
			}else if($SG_name=="영천시"){
				$sPicture5 = str_replace("Gsg4700","Gsg4708",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44708",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54708",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64708",$sPicture5);
				}
			}else if($SG_name=="상주시"){
				$sPicture5 = str_replace("Gsg4700","Gsg4709",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44709",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54709",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64709",$sPicture5);
				}
			}else if($SG_name=="문경시"){
				$sPicture5 = str_replace("Gsg4700","Gsg4710",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44710",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54710",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64710",$sPicture5);
				}
			}else if($SG_name=="예천군"){
				$sPicture5 = str_replace("Gsg4700","Gsg4711",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44711",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54711",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64711",$sPicture5);
				}
			}else if($SG_name=="경산시"){
				$sPicture5 = str_replace("Gsg4700","Gsg4712",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44712",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54712",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64712",$sPicture5);
				}
			}else if($SG_name=="청도군"){
				$sPicture5 = str_replace("Gsg4700","Gsg4713",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44713",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54713",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64713",$sPicture5);
				}
			}else if($SG_name=="고령군"){
				$sPicture5 = str_replace("Gsg4700","Gsg4714",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44714",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54714",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64714",$sPicture5);
				}
			}else if($SG_name=="성주군"){
				$sPicture5 = str_replace("Gsg4700","Gsg4715",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44715",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54715",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64715",$sPicture5);
				}
			}else if($SG_name=="칠곡군"){
				$sPicture5 = str_replace("Gsg4700","Gsg4716",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44716",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54716",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64716",$sPicture5);
				}
			}else if($SG_name=="군위군"){
				$sPicture5 = str_replace("Gsg4700","Gsg4717",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44717",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54717",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64717",$sPicture5);
				}
			}else if($SG_name=="의성군"){
				$sPicture5 = str_replace("Gsg4700","Gsg4718",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44718",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54718",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64718",$sPicture5);
				}
			}else if($SG_name=="청송군"){
				$sPicture5 = str_replace("Gsg4700","Gsg4719",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44719",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54719",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64719",$sPicture5);
				}
			}else if($SG_name=="영양군"){
				$sPicture5 = str_replace("Gsg4700","Gsg4720",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44720",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54720",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64720",$sPicture5);
				}
			}else if($SG_name=="영덕군"){
				$sPicture5 = str_replace("Gsg4700","Gsg4721",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44721",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54721",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64721",$sPicture5);
				}
			}else if($SG_name=="봉화군"){
				$sPicture5 = str_replace("Gsg4700","Gsg4722",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44722",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54722",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64722",$sPicture5);
				}
			}else if($SG_name=="울진군"){
				$sPicture5 = str_replace("Gsg4700","Gsg4723",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44700","Sgg44723",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54700","Sgg54723",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64700","Sgg64723",$sPicture5);
				}
			}
		}else if($sdN=="경상남도"){
			$sPicture5 = str_replace("1100","4800",$sPicture4);
			if($SG_name=="창원시"){
				$sPicture5 = str_replace("Gsg4800","Gsg4801",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44801",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54801",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64801",$sPicture5);
				}
			}else if($SG_name=="진주시"){
				$sPicture5 = str_replace("Gsg4800","Gsg4802",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44802",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54802",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64802",$sPicture5);
				}
			}else if($SG_name=="통영시"){
				$sPicture5 = str_replace("Gsg4800","Gsg4803",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44803",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54803",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64803",$sPicture5);
				}
			}else if($SG_name=="고성군"){
				$sPicture5 = str_replace("Gsg4800","Gsg4804",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44804",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54804",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64804",$sPicture5);
				}
			}else if($SG_name=="사천시"){
				$sPicture5 = str_replace("Gsg4800","Gsg4805",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44805",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54805",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64805",$sPicture5);
				}
			}else if($SG_name=="김해시"){
				$sPicture5 = str_replace("Gsg4800","Gsg4806",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44806",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54806",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64806",$sPicture5);
				}
			}else if($SG_name=="밀양시"){
				$sPicture5 = str_replace("Gsg4800","Gsg4807",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44807",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54807",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64807",$sPicture5);
				}
			}else if($SG_name=="거제시"){
				$sPicture5 = str_replace("Gsg4800","Gsg4808",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44808",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54808",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64808",$sPicture5);
				}
			}else if($SG_name=="의령군"){
				$sPicture5 = str_replace("Gsg4800","Gsg4809",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44809",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54809",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64809",$sPicture5);
				}
			}else if($SG_name=="함안군"){
				$sPicture5 = str_replace("Gsg4800","Gsg4810",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44810",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54810",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64810",$sPicture5);
				}
			}else if($SG_name=="창녕군"){
				$sPicture5 = str_replace("Gsg4800","Gsg4811",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44811",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54811",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64811",$sPicture5);
				}
			}else if($SG_name=="양산시"){
				$sPicture5 = str_replace("Gsg4800","Gsg4812",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44812",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54812",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64812",$sPicture5);
				}
			}else if($SG_name=="하동군"){
				$sPicture5 = str_replace("Gsg4800","Gsg4813",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44813",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54813",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64813",$sPicture5);
				}
			}else if($SG_name=="남해군"){
				$sPicture5 = str_replace("Gsg4800","Gsg4814",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44814",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54814",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64814",$sPicture5);
				}
			}else if($SG_name=="함양군"){
				$sPicture5 = str_replace("Gsg4800","Gsg4815",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44815",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54815",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64815",$sPicture5);
				}
			}else if($SG_name=="산청군"){
				$sPicture5 = str_replace("Gsg4800","Gsg4816",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44816",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54816",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64816",$sPicture5);
				}
			}else if($SG_name=="거창군"){
				$sPicture5 = str_replace("Gsg4800","Gsg4817",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44817",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54817",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64817",$sPicture5);
				}
			}else if($SG_name=="합천군"){
				$sPicture5 = str_replace("Gsg4800","Gsg4818",$sPicture5);
				if($sgT=="4"){
					$sPicture5 = str_replace("Sgg44800","Sgg44818",$sPicture5);
				}else if($sgT=="5"){
					$sPicture5 = str_replace("Sgg54800","Sgg54818",$sPicture5);
				}else if($sgT=="6"){
					$sPicture5 = str_replace("Sgg64800","Sgg64818",$sPicture5);
				}
			}
		}else if($sdN=="제주특별자치도"){
			$sPicture5 = str_replace("1100","4900",$sPicture4);
		}
		$sPicture6 = str_replace("JPG","JPEG",$sPicture5);
		echo"
		 <div id ='cand{$i}_info' class='card row collapsible'>
		    <div class='card-image waves-effect waves-block waves-light col l2 s4' style='position: relative;'>
				<img class='activator' style='position: absolute; top: 10px; left: 10px' src='$sPicture6' alt=''>
				<img class='activator' style='position: relative; top: 0; left: 0' src='$sPicture5' alt=''>
                
				
            </div>
			<div class='card-content col l4 s8'>
				<span class='card-title activator grey-text text-darken-4'></span>
				<p style='font-size: 1.6em; font-weight: bold; text-align: left'>$xml_object->name</p>
				<p class='personal'>$xml_object->age , $xml_object->gender</p>
				<p class='party'>$xml_object->jdName</p>
				<p class='info'>$xml_object->job</p>
			</div>
			<div class='card-content col l4 s12'>
				<span class='card-title grey-text text-darken-4'></span>
				<p class='study'>$xml_object->edu</p>
				
		";
		
		if($xml_object->career1 != null){
				echo "
					<p class='base'>$xml_object->career1</p>
					";
		}
			
		if($xml_object->career2 != null){
			echo "
				<p class='base'>$xml_object->career2</p>
				";
		}
		echo"
			</div>
		</div>
		";
	}
?>