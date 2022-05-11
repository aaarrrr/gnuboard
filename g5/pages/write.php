<?php 
    include_once('_common.php');
    include_once('head.php');

    $wr_id = $_GET['wr_id'] ? $wr_id : '';

    if($wr_id){
        $sql = 'select * from g5_arbbs where wr_id = '.$wr_id;
        $detail = sql_fetch($sql); 
    }
?>

<div id="wrapper">
    <div id="container_wr">
        <div id="container">
        <h2 id="container_title"><span title="아라게시판 글쓰기">아라게시판 <?php if(!$wr_id){ ?>글쓰기<?php }else{?>수정<?php }?></span></h2><!-- skin : basic -->
        <section id="bo_w">
        <h2 class="sound_only">아라게시판 <?php if(!$wr_id){ ?>글쓰기<?php }else{?>수정<?php }?></h2>

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo G5_ARBBS_URL.'/insert_write.php'?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:100%">
    <input type="hidden" name="wr_id" id="wr_id" value="<?=$wr_id?>">
    <input type="hidden" name="mode" id ="mode" value="insert">

    <div class="bo_w_info write_div">
	    	        <label for="wr_name" class="sound_only">이름<strong>필수</strong></label>
	        <input type="text" name="wr_name" value="" id="wr_name" required="" class="frm_input half_input required" placeholder="이름">
	    	
	    	        <label for="wr_password" class="sound_only">비밀번호<strong>필수</strong></label>
	        <input type="password" name="wr_password" id="wr_password" required="" class="frm_input half_input required" placeholder="비밀번호">
	    	
	    			<label for="wr_email" class="sound_only">이메일</label>
			<input type="text" name="wr_email" value="" id="wr_email" class="frm_input half_input email " placeholder="이메일">
	    	    
	
	    	        <label for="wr_homepage" class="sound_only">홈페이지</label>
	        <input type="text" name="wr_homepage" value="" id="wr_homepage" class="frm_input half_input" size="50" placeholder="홈페이지">
	    	</div>
	
        <div class="write_div">
    </div>
    
    <div class="bo_w_tit write_div">
        <label for="wr_subject" class="sound_only">제목<strong>필수</strong></label>
        
        <div id="autosave_wrapper" class="write_div">
            <input type="text" name="wr_subject" value="" id="wr_subject" required="" class="frm_input full_input required" size="50" maxlength="255" placeholder="제목">
                    </div>
        
    </div>

    <div class="write_div">
        <label for="wr_content" class="sound_only">내용<strong>필수</strong></label>
        <div class="wr_content ">
            <span class="sound_only">웹에디터 시작</span>
            <textarea id="wr_content" name="wr_content" class="" maxlength="65536" style="width:100%;height:300px"></textarea>
            <span class="sound_only">웹 에디터 끝</span>                    
        </div>
    </div>

        <div class="bo_w_link write_div">
        <label for="wr_link1"><i class="fa fa-link" aria-hidden="true"></i><span class="sound_only"> 링크  #1</span></label>
        <input type="text" name="wr_link1" value="" id="wr_link1" class="frm_input full_input" size="50">
    </div>
        <div class="bo_w_link write_div">
        <label for="wr_link2"><i class="fa fa-link" aria-hidden="true"></i><span class="sound_only"> 링크  #2</span></label>
        <input type="text" name="wr_link2" value="" id="wr_link2" class="frm_input full_input" size="50">
    </div>
    
        <div class="bo_w_flie write_div">
        <div class="file_wr write_div">
            <label for="bf_file_1" class="lb_icon"><i class="fa fa-folder-open" aria-hidden="true"></i><span class="sound_only"> 파일 #1</span></label>
            <input type="file" name="bf_file[]" id="bf_file_1" title="파일첨부 1 : 용량 1,048,576 바이트 이하만 업로드 가능" class="frm_file ">
        </div>
        
                
    </div>
        <div class="bo_w_flie write_div">
        <div class="file_wr write_div">
            <label for="bf_file_2" class="lb_icon"><i class="fa fa-folder-open" aria-hidden="true"></i><span class="sound_only"> 파일 #2</span></label>
            <input type="file" name="bf_file[]" id="bf_file_2" title="파일첨부 2 : 용량 1,048,576 바이트 이하만 업로드 가능" class="frm_file ">
        </div>
        
                
    </div>
    

        <div class="write_div">
        
<script>var g5_captcha_url  = "http://localhost/g5/gnuboard5-5.5.7.1/plugin/kcaptcha";</script>
<script src="http://localhost/g5/gnuboard5-5.5.7.1/plugin/kcaptcha/kcaptcha.js"></script>
<fieldset id="captcha" class="captcha">
<legend><label for="captcha_key">자동등록방지</label></legend>
<img src="http://localhost/g5/gnuboard5-5.5.7.1/plugin/kcaptcha/kcaptcha_image.php?t=1651631409143" alt="" id="captcha_img"><input type="text" name="captcha_key" id="captcha_key" required="" class="captcha_box required" size="6" maxlength="6">
<button type="button" id="captcha_mp3"><span></span>숫자음성듣기</button>
<button type="button" id="captcha_reload"><span></span>새로고침</button>
<span id="captcha_info">자동등록방지 숫자를 순서대로 입력하세요.</span>
</fieldset>    
    </div>
    
    <div class="btn_confirm write_div">
        <a href="http://localhost/g5/gnuboard5-5.5.7.1/bbs/board.php?bo_table=free" class="btn_cancel btn">취소</a>
        <button type="submit" id="btn_submit" accesskey="s" class="btn_submit btn">작성완료</button>
    </div>
    </form>

    <script>
        function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
      
        var wr_name = $('#wr_name').val();
        var wr_password = $('#wr_password').val();
 
        var wr_subject = $('#wr_subject').val();
        var wr_content = $('#wr_content').val();

        if(wr_name && wr_password && wr_subject && wr_content){
            $.ajax({
                url: "./bbs/ajax.filter.php",
                type: "POST",
                data: {
                    "subject": wr_subject,
                    "content": wr_content
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function(data, textStatus) {
                    subject = data.subject;
                    content = data.content;
                }
            });

            if (subject) {
                alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
                f.wr_subject.focus();
                return false;
            }

            if (content) {
                alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
                if (typeof(ed_wr_content) != "undefined")
                    ed_wr_content.returnFalse();
                else
                    f.wr_content.focus();
                return false;
            }
        }else{
            alert('필수 항목 모두 입력해주세요.');
            return false;
        }
    
        if (!chk_captcha()) return false;

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->
    </div>
    <div id="aside"></div>
</div>

</div>

<?php 
    include_once('foot.php');
?>