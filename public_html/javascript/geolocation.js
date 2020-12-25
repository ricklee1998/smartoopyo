
    var sdN="";
    var sgn="";
    var dong="";
	var GWJC_sgN="";
	var GCJC_sgN="";
	
    var mapOptions = {
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    function checkBrowser() {
        if( navigator.geolocation ) {
            navigator.geolocation.getCurrentPosition(updateLocation, handlerLocationError);
        }
    }
    var clicklat;
    var clicklon;
    var temp="";

    function updateLocation(position) {

        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        var accuracy = position.coords.accuracy;
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;
        map.setCenter(new google.maps.LatLng(latitude, longitude));
        geocodeLatLng1(geocoder, map, infowindow, latitude, longitude);

		var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200){
					GWJC_sgN = this.responseText;
                    var scrollPosition = $(document.getElementById("tab")).offset().top;
                    $("body").animate({
                        scrollTop: scrollPosition
                    }, 500);
				}
			};
			xhttp.open("POST", "GWJC_eu_sgn.php",true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("dong_Name="+dong+"&do_Name="+sdN);



			
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200){
					GCJC_sgN = this.responseText;
				}
			};
			xhttp.open("POST", "GCJC_eu_sgn.php",true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("dong_Name="+dong+"&do_Name="+sdN);


             


        google.maps.event.addListener(map, 'click', function(event) {
            getlatlon(map, event.latLng);
            geocodeLatLng1(geocoder, map, infowindow, clicklat, clicklon);



			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200){
					GWJC_sgN = this.responseText;
				}
			};
			xhttp.open("POST", "GWJC_eu_sgn.php",true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("dong_Name="+dong+"&do_Name="+sdN);



			
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200){
					GCJC_sgN = this.responseText;
				}
			};
			xhttp.open("POST", "GCJC_eu_sgn.php",true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("dong_Name="+dong+"&do_Name="+sdN);




        });
        document.getElementById('submit').addEventListener('click', function() {
            geocodeLatLng2(geocoder, map, infowindow, clicklat, clicklon);



			
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200){
					GWJC_sgN = this.responseText;
				}
			};
			xhttp.open("POST", "GWJC_eu_sgn.php",true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("dong_Name="+dong+"&do_Name="+sdN);



			
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200){
					GCJC_sgN = this.responseText;
				}
			};
			xhttp.open("POST", "GCJC_eu_sgn.php",true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("dong_Name="+dong+"&do_Name="+sdN);


			
        });
    }

    function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                resultsMap.setCenter(results[0].geometry.location);
                clicklat=results[0].geometry.location.lat();
                clicklon=results[0].geometry.location.lng();
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

    function handlerLocationError(error) {
        alert( );
    }

    function getlatlon(map, location) {
        clicklat=location.lat();
        clicklon=location.lng();
    }
    function getsdN(fullname)
    {
        var list=fullname.split(' ');
        if(list[1][list[1].length-3]=="특" && list[1][list[1].length-2]=="별" && list[1][list[1].length-1]=="시")
        {
            sdN=list[1]; //특별시
        }
        else if(list[1][list[1].length-3]=="광" && list[1][list[1].length-2]=="역" && list[1][list[1].length-1]=="시")
        {
            sdN=list[1]; //광역시
        }
        else if(list[1][list[1].length-1]=="도")
        {
            sdN=list[1]; //도
        }
        else
        {
            for(var i=0; i<sgNlist.length; i++)
            {
                for(var j=0; j<sgNlist[i].length; j++)
                {
                    if(sgNlist[i][j]==sgn)
                    {
                        sdN=sdNlist[i];
                    }
                }
            }
        }
    }    function getsgN(fullname)
    {
        var list=fullname.split(' ');
        if(list[2][list[2].length-1]=="구")
        {
            sgn=list[2]; //특별시/광역시->구
        }
        else if(list[2][list[2].length-1]=="군")
        {
            sgn=list[2]; //특별시/광역시->군
        }
        else if(list[2][list[2].length-1]=="시")
        {
            sgn=list[2]; //일반 도->시
        }
        else
        {
            sgn=" ";
        }
    }
    function getdong(fullname)
    {
        var list=fullname.split(' ');
        for(var i=list.length-1; i>=0; i--)
        {
           if(list[i][list[i].length-1]=="동")
           {
               dong=list[i];
                break;
           }
           else if(list[i][list[i].length-1]=="읍")
           {
               dong=list[i];
               break;
           }
           else if(list[i][list[i].length-1]=="면")
           {
               dong=list[i];
               break;
           }
           else
               dong="";
        }
    }
    function geocodeLatLng1(geocoder, map, infowindow, lat, lng)
    {

        var latlng = {lat: lat, lng: lng};
        geocoder.geocode({'location': latlng}, function (results, status) {
            if (status === 'OK') {
                if (results[2]) {
                    if(temp!=results[2].formatted_address)
                    {
                        map.setZoom(15);
                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map
                        });
                        infowindow.setContent(results[2].formatted_address);
                        //window.alert(results[2].formatted_address);
                        infowindow.open(map, marker);
                        getsdN(results[2].formatted_address);
                        getsgN(results[2].formatted_address);
                        getdong(results[2].formatted_address);
                        temp=results[2].formatted_address;
                    }


                } else {
                    window.alert('No results found');
                }
            } else {
                window.alert('Geocoder failed due to: ' + status);
            }
        });
    }

    function geocodeLatLng2(geocoder, map, infowindow, lat, lng)
    {

        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                map.setCenter(results[0].geometry.location);
                clicklat=results[0].geometry.location.lat();
                clicklon=results[0].geometry.location.lng();

            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
        var latlng = {lat: clicklat, lng: clicklon};

        //이 다음줄에서 잠깐 멈춤
        geocoder.geocode({'location': latlng}, function (results, status) {

            if (status === 'OK') {

                if (results[1]) {
                    //alert(temp+"전에 저장된 것");
                    //alert(results[1].formatted_address+"지금 저장된 것");
                    if(temp!=results[2].formatted_address)
                    {
                        map.setZoom(15);
                        map.setCenter(results[0].geometry.location);
                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map
                        });
                        infowindow.setContent(results[2].formatted_address);
                        //window.alert(results[2].formatted_address);
                        infowindow.open(map, marker);
                        getsdN(results[2].formatted_address);
                        getsgN(results[2].formatted_address);
                        getdong(results[2].formatted_address);
                        temp=results[2].formatted_address;
                    }


                } else {
                    window.alert('No results found');
                }
            } else {
                window.alert('Geocoder failed due to: ' + status);
            }
        });
    }