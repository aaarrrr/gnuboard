
<hr>

<!-- 하단 시작 { -->
<div id="ft">

    <div id="ft_wr">
        <div id="ft_link" class="ft_cnt">
            <a href="http://localhost/g5/gnuboard5-5.5.7.1/bbs/content.php?co_id=company">회사소개</a>
            <a href="http://localhost/g5/gnuboard5-5.5.7.1/bbs/content.php?co_id=privacy">개인정보처리방침</a>
            <a href="http://localhost/g5/gnuboard5-5.5.7.1/bbs/content.php?co_id=provision">서비스이용약관</a>
            <a href="http://localhost/g5/gnuboard5-5.5.7.1/bbs/board.php?bo_table=free&amp;wr_id=2&amp;device=mobile">모바일버전</a>
        </div>
        <div id="ft_company" class="ft_cnt">
        	<h2>사이트 정보</h2>
	        <p class="ft_info">
	        	회사명 : 회사명 / 대표 : 대표자명<br>
				주소  : OO도 OO시 OO구 OO동 123-45<br>
				사업자 등록번호  : 123-45-67890<br>
				전화 :  02-123-4567  팩스  : 02-123-4568<br>
				통신판매업신고번호 :  제 OO구 - 123호<br>
				개인정보관리책임자 :  정보책임자명<br>
			</p>
	    </div>
        
<div class="notice ft_cnt">
    <h2><a href="http://localhost/g5/gnuboard5-5.5.7.1/bbs/board.php?bo_table=notice">공지사항</a></h2>
    <ul>
            <li class="empty_li">게시물이 없습니다.</li>
        </ul>
</div>
        
		
<!-- 접속자집계 시작 { -->
<section id="visit" class="ft_cnt">
    <h2>접속자집계</h2>
    <dl>
        <dt><span></span> 오늘</dt>
        <dd><strong>1</strong></dd>
        <dt><span></span> 어제</dt>
        <dd><strong>1</strong></dd>
        <dt><span></span> 최대</dt>
        <dd><strong>1</strong></dd>
        <dt><span></span> 전체</dt>
        <dd><strong>2</strong></dd>
    </dl>
    </section>
<!-- } 접속자집계 끝 -->	</div>      
        <!-- <div id="ft_catch"><img src="http://localhost/g5/gnuboard5-5.5.7.1/img/ft_logo.png" alt="그누보드5"></div> -->
        <div id="ft_copy">Copyright © <b>소유하신 도메인.</b> All rights reserved.</div>
    
    
    <button type="button" id="top_btn">
    	<i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span>
    </button>
    <script>
    $(function() {
        $("#top_btn").on("click", function() {
            $("html, body").animate({scrollTop:0}, '500');
            return false;
        });
    });
    </script>
</div>


<!-- } 하단 끝 -->

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>



<!-- ie6,7에서 사이드뷰가 게시판 목록에서 아래 사이드뷰에 가려지는 현상 수정 -->
<!--[if lte IE 7]>
<script>
$(function() {
    var $sv_use = $(".sv_use");
    var count = $sv_use.length;

    $sv_use.each(function() {
        $(this).css("z-index", count);
        $(this).css("position", "relative");
        count = count - 1;
    });
});
</script>
<![endif]-->





<!-- 사용스킨 : basic -->
</body></html>