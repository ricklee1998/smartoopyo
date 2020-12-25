defaultSet();
function moveToTab (){
    var scrollPosition = $(document.getElementById("tab")).offset().top;
    $("html, body").animate({ scrollTop: scrollPosition });
    console.log(top);
}

var schtxt1;
function defaultSet(){
    d="서울특별시";
    var sgT = "3";
    g="서울특별시";
    var a = new XMLHttpRequest();
    a.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            document.getElementById("demo").innerHTML = this.responseText;
            $(document.getElementById("cand0")).addClass('whiteGrey');
            clickCandi(document.getElementById("cand0"));
            moveToTab();
        }
    };
    a.open("POST", "info_1.php",true);
    a.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    a.send("sgg_Name="+g+"&sg_Typecode="+sgT+"&sd_Name="+d);



    var b = new XMLHttpRequest();
    b.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            document.getElementById("demo3").innerHTML = this.responseText;
            
            moveToTab();
        }
    };
    b.open("POST", "info_2.php",true);
    b.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    b.send("sgg_Name="+g+"&sg_Typecode="+sgT+"&sd_Name="+d);




    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            document.getElementById("demo4").innerHTML = this.responseText;
           
            trend();
            moveToTab();
        }
    };
    xhttp.open("POST", "info_3.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("sgg_Name="+g+"&sg_Typecode="+sgT+"&sd_Name="+d);
}

function clickTab(clicked) {
    var tagId = $(clicked).attr('id');
    $('.tabs .tab').removeClass('darkGrey');
    $(clicked).addClass('darkGrey');
    $('.tabs .tab a').removeClass('whiteText');
    $($(clicked).children('a')).addClass('grey-text');
    $($(clicked).children('a')).addClass('whiteText');


    //후보자 목록 수정
    if(tagId == 3){

        sgn = sdN;
        var sgT = "3";

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("demo").innerHTML = this.responseText;
                $(document.getElementById("cand0")).addClass('whiteGrey')
                clickCandi(document.getElementById("cand0"));
               
            }
        };
        xhttp.open("POST", "info_1.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("sgg_Name="+sgn+"&sg_Typecode="+sgT+"&sd_Name="+sdN);





        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("demo3").innerHTML = this.responseText;
                              
            }
        };
        xhttp.open("POST", "info_2.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("sgg_Name="+sgn+"&sg_Typecode="+sgT+"&sd_Name="+sdN);





        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("demo4").innerHTML = this.responseText;
               
                trend();
            }
        };
        xhttp.open("POST", "info_3.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("sgg_Name="+sgn+"&sg_Typecode="+sgT+"&sd_Name="+sdN);




    }

    else if(tagId == 4){
        sgn=temp.split(' ')[1];


        var sgT = "4";


        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("demo").innerHTML = this.responseText;
                $(document.getElementById("cand0")).addClass('whiteGrey');
                clickCandi(document.getElementById("cand0"));
                
            }

        };
        xhttp.open("POST", "info_1.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("sgg_Name="+sgn+"&sg_Typecode="+sgT+"&sd_Name="+sdN);




        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("demo3").innerHTML = this.responseText;
                                
            }
        };
        xhttp.open("POST", "info_2.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("sgg_Name="+sgn+"&sg_Typecode="+sgT+"&sd_Name="+sdN);

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("demo4").innerHTML = this.responseText;
                
                trend();
            }
        };
        xhttp.open("POST", "info_3.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("sgg_Name="+sgn+"&sg_Typecode="+sgT+"&sd_Name="+sdN);

    }

    else if(tagId == 5){

        var sgT = "5";

        if(GWJC_sgN=="")
        {
            document.getElementById("demo").innerHTML="해당 읍/면/동이 중앙선거관리위원회에 존재하지 않습니다";
      return;
        }

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("demo").innerHTML = this.responseText;
                $(document.getElementById("cand0")).addClass('whiteGrey');
                clickCandi(document.getElementById("cand0"));
                
            }
        };
        xhttp.open("POST", "info_1.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("sgg_Name="+GWJC_sgN+"&sg_Typecode="+sgT+"&sd_Name="+sdN);




        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("demo3").innerHTML = this.responseText;
                              
            }
        };
        xhttp.open("POST", "info_2.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("sgg_Name="+GWJC_sgN+"&sg_Typecode="+sgT+"&sd_Name="+sdN);




        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("demo4").innerHTML = this.responseText;
                
                trend();
            }
        };
        xhttp.open("POST", "info_3.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("sgg_Name="+GWJC_sgN+"&sg_Typecode="+sgT+"&sd_Name="+sdN);

    }

    else if(tagId == 6){

        var sgT = "6";
   if(GCJC_sgN=="")
        {
            document.getElementById("demo").innerHTML="해당 읍/면/동이 중앙선거관리위원회에 존재하지 않습니다";
      return;
        }



        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("demo").innerHTML = this.responseText;
                $(document.getElementById("cand0")).addClass('whiteGrey');
                clickCandi(document.getElementById("cand0"));
                
            }
        };
        xhttp.open("POST", "info_1.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhttp.send("sgg_Name="+GCJC_sgN+"&sg_Typecode="+sgT+"&sd_Name="+sdN);





        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("demo3").innerHTML = this.responseText;

                               
            }
        };
        xhttp.open("POST", "info_2.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("sgg_Name="+GCJC_sgN+"&sg_Typecode="+sgT+"&sd_Name="+sdN);




        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("demo4").innerHTML = this.responseText;
                
                trend();
            }
        };
        xhttp.open("POST", "info_3.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("sgg_Name="+GCJC_sgN+"&sg_Typecode="+sgT+"&sd_Name="+sdN);


    }

    else if(tagId == 11){
        sgn = sdN;
        var sgT = "11";

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("demo").innerHTML = this.responseText;
                $(document.getElementById("cand0")).addClass('whiteGrey');
                clickCandi(document.getElementById("cand0"));
                
            }
        };
        xhttp.open("POST", "info_1.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("sgg_Name="+sgn+"&sg_Typecode="+sgT+"&sd_Name="+sdN);





        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("demo3").innerHTML = this.responseText;
                                
            }
        };
        xhttp.open("POST", "info_2.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("sgg_Name="+sgn+"&sg_Typecode="+sgT+"&sd_Name="+sdN);





        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("demo4").innerHTML = this.responseText;
                
                trend();
            }
        };
        xhttp.open("POST", "info_3.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("sgg_Name="+sgn+"&sg_Typecode="+sgT+"&sd_Name="+sdN);

    }
}

function clickCandi(clicked){

    //뉴스 목록 및 후보자 정보 수정

    var num1 = $($(clicked).children('h5')).attr('id');
    $('.row .card').removeClass('whiteGrey');
    $(clicked).addClass('whiteGrey');
    //후보자 정보
    $('.card.row').addClass('collapsible');
    $(document.getElementById($(clicked).attr('id')+'_info')).removeClass('collapsible');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200)
        {
            document.getElementById("nnews").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "naver_info.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var text1 = document.getElementById(num1).innerHTML;
    var text2 = text1.substring(7);
    schtxt1 = text2;
    xhttp.send("text_Text="+text2);
}

function searchNews() {

    var txtsch1 = document.getElementById('search').value;
    var text3 = schtxt1 + " " +txtsch1;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200)
        {
            document.getElementById("nnews").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "naver_info.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhttp.send("text_Text="+text3);
    //clicked 이름 있는 class 찾아서 text합쳐서 news 업데이트
}