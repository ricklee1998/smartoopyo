
function trend(){
	
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200){
			obj = this.responseText;
			obj_json = JSON.parse(obj.slice(obj.indexOf("status") + 16));
			//네이버 트랜드 api 출력값 관련. 이 부분은 주석으로 설명하기 어려우니 /var/www/html에 있는 JSON.txt 파일을 읽어보세요!
			var hubo = new Array();
			//트랜드의 날짜 저장
			var color = ["#1870B9", "#C9151E", "#00B4B4", "#3EA437", "#FFCC00", "#EE5927", "#0D2680", "#DA1F49", "#00B1EB", "#7F00FF"];
			//그래프 색상. 
			var hubo_graph = new Array();
			//그래프 관련 JSON 저장.

			for(var i = 0; i < obj_json.results.length; i++) {
				hubo[i] = [];
				//생성
				for(var j = 0; j < obj_json.results[i].data.length; j++) {
					hubo[i].push({
						x: new Date(obj_json.results[i].data[j].period.slice(0, 4), obj_json.results[i].data[j].period.slice(5, 7) - 1, obj_json.results[i].data[j].period.slice(8)),
						//날짜를 new Date(yyyy, mm, dd)로 지정해야 해서, JSON 값을 뜯어서 만들었습니다.
						y: obj_json.results[i].data[j].ratio
						//값
					});
				}
			}

			for(var i = 0; i < obj_json.results.length; i++) {
				aJSON = {
					type: "line",
					name: obj_json.results[i].title,
					//JSON에서 후보자 이름 추출
					color: color[i],
					//위에서 지정한 색상
					axisYIndex: 0,
					showInLegend: true,
					dataPoints: hubo[i],
					//위에서 지정한 값
				}
				hubo_graph.push(aJSON);
			}

			//JSON이 잘 만들어졌는지 팝업으로 확인. 이 코드는 지워도 됩니다!!


			
			var chart = new CanvasJS.Chart("chartContainer", {
				title:{
					text: "후보자 검색 추이"
					//차트 제목. 곧 바꿀게요 ㅠ
				},
				axisY:[{
					title: "추이",
					lineColor: "#C24642",
					tickColor: "#C24642",
					labelFontColor: "#C24642",
					titleFontColor: "#C24642"
					//y축
				}],
				toolTip: {
					shared: true
				},
				legend: {
					cursor: "pointer",
					itemclick: toggleDataSeries
					//범-주
				},
				data: hubo_graph
				//위에서 aJSON으로 묶어버린 값
			});
			chart.render();

			function toggleDataSeries(e) {
				if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
					e.dataSeries.visible = false;
				} else {
					e.dataSeries.visible = true;
				}
				e.chart.render();
			}
		}
	};
	
	var d = new Date();
	if(d.getMonth() < 9){
	if(d.getDate() < 10){
		var today = d.getFullYear().toString()+"-"+"0"+(d.getMonth()+1).toString()+"-"+"0"+d.getDate().toString();
	}
	else var today = d.getFullYear().toString()+"-"+"0"+(d.getMonth()+1).toString()+"-"+d.getDate().toString();
	}
	else{
	if(d.getDate() < 10){
		var today = d.getFullYear().toString()+"-"+(d.getMonth()+1).toString()+"-"+"0"+d.getDate().toString();
	}
	else var today = d.getFullYear().toString()+"-"+(d.getMonth()+1).toString()+"-"+d.getDate().toString();
	}




	d.setDate(d.getDate()-7);

	if(d.getMonth() < 9){
	if(d.getDate() < 10){
		var fromday = d.getFullYear().toString()+"-"+"0"+(d.getMonth()+1).toString()+"-"+"0"+d.getDate().toString();
	}
	else var fromday = d.getFullYear().toString()+"-"+"0"+(d.getMonth()+1).toString()+"-"+d.getDate().toString();
	}
	else{
	if(d.getDate() < 10){
		var fromday = d.getFullYear().toString()+"-"+(d.getMonth()+1).toString()+"-"+"0"+d.getDate().toString();
	}
	else var fromday = d.getFullYear().toString()+"-"+(d.getMonth()+1).toString()+"-"+d.getDate().toString();
	}


	var startDate = fromday;
	var	endDate = today;
	var timeUnit = "date";
	var numhubo = parseInt(document.getElementById("total_candi").innerHTML);
	var hubo = document.querySelectorAll("h10");
	var jdn = document.querySelectorAll("h11");
	
	var group = new Array();
	var body_group = "";
	
	for(var i = 0; i < numhubo; i++){
		if(jdn[i].innerHTML != ""){
			group[i] = "{\"groupName\":\""+hubo[i].innerHTML+"\",\"keywords\":[\""+hubo[i].innerHTML+"\", \""+jdn[i].innerHTML+"\"]}";
		}
		else{
			group[i] = "{\"groupName\":\""+hubo[i].innerHTML+"\",\"keywords\":[\""+hubo[i].innerHTML+"\"]}";
		}
		body_group += "&group"+i+"="+group[i];
	}
	/*alert("startDate="+startDate+
	"&endDate="+endDate+
	"&timeUnit="+timeUnit+
	body_group);
	*/
	xhttp.open("POST", "trend.php" ,true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("startDate="+startDate+"&endDate="+endDate+"&timeUnit="+timeUnit+body_group);
	
}