<html lang="ko"><head>
<meta charset="utf-8">
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>222 &gt; 자유게시판 | 그누보드5</title>
<link rel="stylesheet" href="http://localhost/g5/gnuboard5-5.5.7.1/theme/basic/css/default.css?ver=210618">
<link rel="stylesheet" href="http://localhost/g5/gnuboard5-5.5.7.1/js/font-awesome/css/font-awesome.min.css?ver=210618">
<link rel="stylesheet" href="http://localhost/g5/gnuboard5-5.5.7.1/theme/basic/skin/connect/basic/style.css?ver=210618">
<link rel="stylesheet" href="http://localhost/g5/gnuboard5-5.5.7.1/theme/basic/skin/popular/basic/style.css?ver=210618">
<link rel="stylesheet" href="http://localhost/g5/gnuboard5-5.5.7.1/skin/board/basic/style.css?ver=210618">
<link rel="stylesheet" href="http://localhost/g5/gnuboard5-5.5.7.1/theme/basic/skin/outlogin/basic/style.css?ver=210618">
<link rel="stylesheet" href="http://localhost/g5/gnuboard5-5.5.7.1/theme/basic/skin/latest/notice/style.css?ver=210618">
<link rel="stylesheet" href="http://localhost/g5/gnuboard5-5.5.7.1/theme/basic/skin/visit/basic/style.css?ver=210618">
<link rel="stylesheet" href="http://localhost/g5/gnuboard5-5.5.7.1/js/owlcarousel/owl.carousel.min.css?ver=210618">
<!--[if lte IE 8]>
<script src="http://localhost/g5/gnuboard5-5.5.7.1/js/html5.js"></script>
<![endif]-->
<script>
// 자바스크립트에서 사용하는 전역변수 선언
var g5_url       = "http://localhost/g5/gnuboard5-5.5.7.1";
var g5_bbs_url   = "http://localhost/g5/gnuboard5-5.5.7.1/bbs";
var g5_is_member = "";
var g5_is_admin  = "";
var g5_is_mobile = "";
var g5_bo_table  = "free";
var g5_sca       = "";
var g5_editor    = "";
var g5_cookie_domain = "";
var g5_theme_shop_url = "http://localhost/g5/gnuboard5-5.5.7.1/theme/basic/shop";
var g5_shop_url = "http://localhost/g5/gnuboard5-5.5.7.1/shop";
</script>
<script src="http://localhost/g5/gnuboard5-5.5.7.1/js/jquery-1.12.4.min.js?ver=210618"></script>
<script src="http://localhost/g5/gnuboard5-5.5.7.1/js/jquery-migrate-1.4.1.min.js?ver=210618"></script>
<script src="http://localhost/g5/gnuboard5-5.5.7.1/js/jquery.menu.js?ver=210618"></script>
<script src="http://localhost/g5/gnuboard5-5.5.7.1/js/common.js?ver=210618"></script>
<script src="http://localhost/g5/gnuboard5-5.5.7.1/js/wrest.js?ver=210618"></script>
<script src="http://localhost/g5/gnuboard5-5.5.7.1/js/placeholders.min.js?ver=210618"></script>
<script src="http://localhost/g5/gnuboard5-5.5.7.1/js/owlcarousel/owl.carousel.min.js?ver=210618"></script>
<script src="http://localhost/g5/gnuboard5-5.5.7.1/js/jquery.bxslider.js?ver=210618"></script>
</head>
<body>

<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1">222 &gt; 자유게시판</h1>
    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

        <div id="tnb">
    	<div class="inner">
                		<ul id="hd_define">
    			<li class="active"><a href="http://localhost/g5/gnuboard5-5.5.7.1/">커뮤니티</a></li>
                    			<li><a href="http://localhost/g5/gnuboard5-5.5.7.1/shop/">쇼핑몰</a></li>
                    		</ul>
            			<ul id="hd_qnb">
	            <li><a href="http://localhost/g5/gnuboard5-5.5.7.1/bbs/faq.php">FAQ</a></li>
	            <li><a href="http://localhost/g5/gnuboard5-5.5.7.1/bbs/qalist.php">Q&amp;A</a></li>
	            <li><a href="http://localhost/g5/gnuboard5-5.5.7.1/bbs/new.php">새글</a></li>
	            <li><a href="http://localhost/g5/gnuboard5-5.5.7.1/bbs/current_connect.php" class="visit">접속자<strong class="visit-num">
1</strong></a></li>
	        </ul>
		</div>
    </div>
    <div id="hd_wrapper">

        <div id="logo">
            <a href="http://localhost/g5/gnuboard5-5.5.7.1"><img src="http://localhost/g5/gnuboard5-5.5.7.1/img/logo.png" alt="그누보드5"></a>
        </div>
    
        <div class="hd_sch_wr">
            <fieldset id="hd_sch">
                <legend>사이트 내 전체검색</legend>
                <form name="fsearchbox" method="get" action="http://localhost/g5/gnuboard5-5.5.7.1/bbs/search.php" onsubmit="return fsearchbox_submit(this);">
                <input type="hidden" name="sfl" value="wr_subject||wr_content">
                <input type="hidden" name="sop" value="and">
                <label for="sch_stx" class="sound_only">검색어 필수</label>
                <input type="text" name="stx" id="sch_stx" maxlength="20" placeholder="검색어를 입력해주세요">
                <button type="submit" id="sch_submit" value="검색"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
                </form>

                <script>
                function fsearchbox_submit(f)
                {
                    if (f.stx.value.length < 2) {
                        alert("검색어는 두글자 이상 입력하십시오.");
                        f.stx.select();
                        f.stx.focus();
                        return false;
                    }

                    // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
                    var cnt = 0;
                    for (var i=0; i<f.stx.value.length; i++) {
                        if (f.stx.value.charAt(i) == ' ')
                            cnt++;
                    }

                    if (cnt > 1) {
                        alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
                        f.stx.select();
                        f.stx.focus();
                        return false;
                    }

                    return true;
                }
                </script>

            </fieldset>
                
            
<!-- 인기검색어 시작 { -->
<section id="popular">
    <h2>인기검색어</h2>
    <div class="popular_inner">
	    <ul>
	    	        <li class="item"><a href="http://localhost/g5/gnuboard5-5.5.7.1/bbs/search.php?sfl=wr_subject&amp;sop=and&amp;stx=ddd">ddd</a></li>
	        	    </ul>
        <span class="popular_btns">
            <a href="#" class="pp-next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="pp-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </span>
    </div>
</section>

<script>
jQuery(function($){
    
    var popular_el = ".popular_inner ul",
        p_width = $(popular_el).width(),
        c_width = 0;

    $(popular_el).children().each(function() {
        c_width += $(this).outerWidth( true );
    });

    if( c_width > p_width ){
        var $popular_btns = $(".popular_inner .popular_btns");
        $popular_btns.show();

        var p_carousel = $(popular_el).addClass("owl-carousel").owlCarousel({
            items:5,
            loop:true,
            nav:false,
            dots:false,
            autoWidth:true,
            mouseDrag:false,
        });

        $popular_btns.on("click", ".pp-next", function(e) {
            e.preventDefault();
            p_carousel.trigger('next.owl.carousel');
        })
        .on("click", ".pp-prev", function(e) {
            e.preventDefault();
            p_carousel.trigger('prev.owl.carousel');
        });
    }

});
</script>
<!-- } 인기검색어 끝 -->        </div>
        <ul class="hd_login">        
                        <li><a href="http://localhost/g5/gnuboard5-5.5.7.1/bbs/register.php">회원가입</a></li>
            <li><a href="http://localhost/g5/gnuboard5-5.5.7.1/bbs/login.php">로그인</a></li>
            
        </ul>
    </div>
    
    <nav id="gnb">
        <h2>메인메뉴</h2>
        <div class="gnb_wrap">
            <ul id="gnb_1dul">
                <li class="gnb_1dli gnb_mnal"><button type="button" class="gnb_menu_btn" title="전체메뉴"><i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only">전체메뉴열기</span></button></li>
                                    <li class="gnb_empty">메뉴 준비 중입니다.</li>
                            </ul>
            <div id="gnb_all">
                <h2>전체메뉴</h2>
                <ul class="gnb_al_ul">
                                            <li class="gnb_empty">메뉴 준비 중입니다.</li>
                                    </ul>
                <button type="button" class="gnb_close_btn"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div id="gnb_all_bg"></div>
        </div>
    </nav>
    <script>
    
    $(function(){
        $(".gnb_menu_btn").click(function(){
            $("#gnb_all, #gnb_all_bg").show();
        });
        $(".gnb_close_btn, #gnb_all_bg").click(function(){
            $("#gnb_all, #gnb_all_bg").hide();
        });
    });

    </script>
</div>
<!-- } 상단 끝 -->


<hr>