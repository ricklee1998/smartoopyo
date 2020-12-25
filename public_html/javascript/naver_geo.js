var sdN="";
var sgn="";
var dong="";
var temp="";
var a=0;
var b=0;
function getsdN(fullname)
{
    var list=fullname.split(' ');
    if(list[0][list[0].length-3]=="특" && list[0][list[0].length-2]=="별" && list[0][list[0].length-1]=="시")
    {
        sdN=list[0]; //특별시
    }
    else if(list[0][list[0].length-3]=="광" && list[0][list[0].length-2]=="역" && list[0][list[0].length-1]=="시")
    {
        sdN=list[0]; //광역시
    }
    else if(list[0][list[0].length-1]=="도")
    {
        sdN=list[0]; //도
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
}
function getsgN(fullname)
{
    var list=fullname.split(' ');
    if(list[1][list[1].length-1]=="구")
    {
        sgn=list[1]; //특별시/광역시->구
    }
    else if(list[1][list[1].length-1]=="군")
    {
        sgn=list[1]; //특별시/광역시->군
    }
    else if(list[1][list[1].length-1]=="시")
    {
        sgn=list[1]; //일반 도->시
    }
    else
    {
        sgn="";
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
var infowindow = new naver.maps.InfoWindow();

function onSuccessGeolocation(position) {
    var location = new naver.maps.LatLng(position.coords.latitude,
                                         position.coords.longitude);

    map.setCenter(location); // 얻은 좌표를 지도의 중심으로 설정합니다.
    map.setZoom(10); // 지도의 줌 레벨을 변경합니다.
	
	var center = map.getCenter();
	var mm = new naver.maps.LatLng(center.lat(), center.lng());
	searchCoordinateToAddress(mm);
	
    //infowindow.setContent('<div style="padding:20px;">' +
    //    'latitude: '+ location.lat() +'<br />' +
       // 'longitude: '+ location.lng() +'</div>');

   // infowindow.open(map, location);
}

function onErrorGeolocation() {
    var center = map.getCenter();

    infowindow.setContent('<div style="padding:20px;">' +
        '<h5 style="margin-bottom:5px;color:#f00;">Geolocation failed!</h5>'+ "latitude: "+ center.lat() +"<br />longitude: "+ center.lng() +'</div>');

    infowindow.open(map, center);
}

$(window).on("load", function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(onSuccessGeolocation, onErrorGeolocation);
    } else {
        var center = map.getCenter();
		var mm = new naver.maps.LatLng(center.lat(), center.lng());
		searchCoordinateToAddress(mm);
        //infowindow.setContent('<div style="padding:20px;"><h5 style="margin-bottom:5px;color:#f00;">Geolocation not supported</h5>'+ "latitude: "+ center.lat() +"<br />longitude: "+ center.lng() +'</div>');
        //infowindow.open(map, center);
    }
});

var map = new naver.maps.Map("map", {
    center: new naver.maps.LatLng(a, b),
    zoom: 10,
    mapTypeControl: true
});

var infoWindow = new naver.maps.InfoWindow({
    anchorSkew: true
});

map.setCursor('pointer');

// search by tm128 coordinate
var latlng = new naver.maps.LatLng(a, b);

function searchCoordinateToAddress(latlng) {
    var tm128 = naver.maps.TransCoord.fromLatLngToTM128(latlng);
    var string="";
    infoWindow.close();

    naver.maps.Service.reverseGeocode({
        location: tm128,
        coordType: naver.maps.Service.CoordType.TM128
    }, function(status, response) {
        if (status === naver.maps.Service.Status.ERROR) {
            return alert('Something Wrong!');
        }

        var items = response.result.items,
            htmlAddresses = [];

        item = items[0];
        addrType = item.isRoadAddress ? '[도로명 주소]' : '[지번 주소]';

        htmlAddresses.push(item.address);
        temp=item.address;
        getsdN(item.address);
        getsgN(item.address);
        getdong(item.address);

        infoWindow.setContent([
            '<div style="padding:10px;min-width:200px;line-height:150%;">',
            '<h4 style="margin-top:5px;"></h4><br />',
            htmlAddresses.join('<br />'),
            '</div>'
        ].join('\n'));
        infoWindow.open(map, latlng);
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

// result by latlng coordinate
function searchAddressToCoordinate(address) {
    naver.maps.Service.geocode({
        address: address
    }, function(status, response) {
        if (status === naver.maps.Service.Status.ERROR) {
            return alert('Something Wrong!');
        }

        var item = response.result.items[0],
            addrType = item.isRoadAddress ? '[도로명 주소]' : '[지번 주소]',
            point = new naver.maps.Point(item.point.x, item.point.y);
        temp=item.address;
        getsdN(item.address);
        getsgN(item.address);
        getdong(item.address);
        infoWindow.setContent([
            '<div style="padding:10px;min-width:200px;line-height:150%;">',
            '<h4 style="margin-top:5px;">검색 주소 : '+ response.result.userquery +'</h4><br />',
            addrType +' '+ item.address +'<br />',
            '</div>'
        ].join('\n'));


        map.setCenter(point);
        infoWindow.open(map, point);

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

function initGeocoder() {
    map.addListener('click', function(e) {
        searchCoordinateToAddress(e.coord);
    });

    $('#address').on('keydown', function(e) {
        var keyCode = e.which;

        if (keyCode === 13) { // Enter Key
            searchAddressToCoordinate($('#address').val());
        }
    });

    $('#submit').on('click', function(e) {
        e.preventDefault();

        searchAddressToCoordinate($('#address').val());
    });

    //searchAddressToCoordinate('정자동 178-1');
}

naver.maps.onJSContentLoaded = initGeocoder;
