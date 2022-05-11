<?php
    include_once('./_common.php');
    include_once(G5_LIB_PATH.'/naver_syndi.lib.php');
    include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
    $msg = array();

    $wr_subject = '';
    $bo_table = 'arbbs'; 
    $write_table = 'arbbs';
    if (isset($_POST['wr_subject'])) {
        $wr_subject = substr(trim($_POST['wr_subject']),0,255);
        $wr_subject = preg_replace("#[\\\]+$#", "", $wr_subject);
    }

    $wr_content = '';
    if (isset($_POST['wr_content'])) {
        $wr_content = substr(trim($_POST['wr_content']),0,65536);
        $wr_content = preg_replace("#[\\\]+$#", "", $wr_content);
    }

    $wr_link1 = '';
    if (isset($_POST['wr_link1'])) {
        $wr_link1 = substr($_POST['wr_link1'],0,1000);
        $wr_link1 = trim(strip_tags($wr_link1));
        $wr_link1 = preg_replace("#[\\\]+$#", "", $wr_link1);
    }

    $wr_link2 = '';
    if (isset($_POST['wr_link2'])) {
        $wr_link2 = substr($_POST['wr_link2'],0,1000);
        $wr_link2 = trim(strip_tags($wr_link2));
        $wr_link2 = preg_replace("#[\\\]+$#", "", $wr_link2);
    }

    if (substr_count($wr_content, '&#') > 50) {
        alert('내용에 올바르지 않은 코드가 다수 포함되어 있습니다.');
        exit;
    }

    $upload_max_filesize = ini_get('upload_max_filesize');

    if (empty($_POST)) {
        alert("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=".$upload_max_filesize."\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");
    }

    $wr_password = isset($_POST['wr_password']) ? $_POST['wr_password'] : '';
    $_POST['html'] = isset($_POST['html']) ? clean_xss_tags($_POST['html'], 1, 1) : '';
    $_POST['email'] = isset($_POST['email']) ? clean_xss_tags($_POST['email'], 1, 1) : '';

    $html = '';
    if (isset($_POST['html']) && $_POST['html']) {
        if(preg_match('#html(1|2)#', strtolower($_POST['html']), $matches))
            $html = $matches[0];
    }

    $email = '';
    if (isset($_POST['email']) && $_POST['email']) {
        if(preg_match('#email', strtolower($_POST['email']), $matches))
            $mail = $matches[0];
    }

    $mb_id = '';
    // 비회원의 경우 이름이 누락되는 경우가 있음
    $wr_name = clean_xss_tags(trim($_POST['wr_name']));
    $wr_password = get_encrypt_string($wr_password);
    $wr_email = get_email_address(trim($_POST['wr_email']));
    $wr_homepage = clean_xss_tags($wr_homepage);


    $wr_num = get_next_num($write_table);
    $wr_reply = '';
    $wr_seo_title = exist_seo_title_recursive('bbs', generate_seo_title($wr_subject), $write_table, $wr_id);


    $sql = " insert into g5_arbbs
                set wr_num = '$wr_num',
                     wr_reply = '$wr_reply',
                     wr_comment = 0,
                     ca_name = '',
                     wr_option = '',
                     wr_subject = '$wr_subject',
                     wr_content = '$wr_content',
                     wr_seo_title = '$wr_seo_title',
                     wr_link1 = '$wr_link1',
                     wr_link2 = '$wr_link2',
                     wr_link1_hit = 0,
                     wr_link2_hit = 0,
                     wr_hit = 0,
                     wr_good = 0,
                     wr_nogood = 0,
                     mb_id = '',
                     wr_password = '$wr_password',
                     wr_name = '$wr_name',
                     wr_email = '$wr_email',
                     wr_homepage = '$wr_homepage',
                     wr_datetime = '".G5_TIME_YMDHIS."',
                     wr_last = '".G5_TIME_YMDHIS."',
                     wr_ip = '{$_SERVER['REMOTE_ADDR']}',
                     wr_1 = '$wr_1',
                     wr_2 = '$wr_2',
                     wr_3 = '$wr_3',
                     wr_4 = '$wr_4',
                     wr_5 = '$wr_5',
                     wr_6 = '$wr_6',
                     wr_7 = '$wr_7',
                     wr_8 = '$wr_8',
                     wr_9 = '$wr_9',
                     wr_10 = '$wr_10' ";

    sql_query($sql);

    $wr_id = sql_insert_id();


// 파일개수 체크
$file_count   = 0;
$upload_count = (isset($_FILES['bf_file']['name']) && is_array($_FILES['bf_file']['name'])) ? count($_FILES['bf_file']['name']) : 0;

for ($i=0; $i<$upload_count; $i++) {
    if($_FILES['bf_file']['name'][$i] && is_uploaded_file($_FILES['bf_file']['tmp_name'][$i]))
        $file_count++;
}

// if($file_count > $board['bo_upload_count'])
// alert('첨부파일을 '.number_format($board['bo_upload_count']).'개 이하로 업로드 해주십시오.');

// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
@mkdir(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

// 가변 파일 업로드
$file_upload_msg = '';
$upload = array();

if(isset($_FILES['bf_file']['name']) && is_array($_FILES['bf_file']['name'])) {
    for ($i=0; $i<count($_FILES['bf_file']['name']); $i++) {
        $upload[$i]['file']     = '';
        $upload[$i]['source']   = '';
        $upload[$i]['filesize'] = 0;
        $upload[$i]['image']    = array();
        $upload[$i]['image'][0] = 0;
        $upload[$i]['image'][1] = 0;
        $upload[$i]['image'][2] = 0;
        $upload[$i]['fileurl'] = '';
        $upload[$i]['thumburl'] = '';
        $upload[$i]['storage'] = '';

        // 삭제에 체크가 되어있다면 파일을 삭제합니다.
        if (isset($_POST['bf_file_del'][$i]) && $_POST['bf_file_del'][$i]) {
            $upload[$i]['del_check'] = true;

            $row = sql_fetch(" select * from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");

            $delete_file = run_replace('delete_file_path', G5_DATA_PATH.'/file/'.$bo_table.'/'.str_replace('../', '', $row['bf_file']), $row);
            if( file_exists($delete_file) ){
                @unlink($delete_file);
            }
            // 썸네일삭제
            if(preg_match("/\.({$config['cf_image_extension']})$/i", $row['bf_file'])) {
                delete_board_thumbnail($bo_table, $row['bf_file']);
            }
        }
        else
            $upload[$i]['del_check'] = false;

        $tmp_file  = $_FILES['bf_file']['tmp_name'][$i];
        $filesize  = $_FILES['bf_file']['size'][$i];
        $filename  = $_FILES['bf_file']['name'][$i];
        $filename  = get_safe_filename($filename);

        // 서버에 설정된 값보다 큰파일을 업로드 한다면
        if ($filename) {
            if ($_FILES['bf_file']['error'][$i] == 1) {
                $file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
                continue;
            }
            else if ($_FILES['bf_file']['error'][$i] != 0) {
                $file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
                continue;
            }
        }

        if (is_uploaded_file($tmp_file)) {
            // 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
            // if (!$is_admin && $filesize > $board['bo_upload_size']) {
            //     $file_upload_msg .= '\"'.$filename.'\" 파일의 용량('.number_format($filesize).' 바이트)이 게시판에 설정('.number_format($board['bo_upload_size']).' 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n';
            //     continue;
            // }

            //=================================================================\
            // 090714
            // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
            // 에러메세지는 출력하지 않는다.
            //-----------------------------------------------------------------
            $timg = @getimagesize($tmp_file);
            // image type
            if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
                 preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
                if ($timg['2'] < 1 || $timg['2'] > 18)
                    continue;
            }
            //=================================================================

            $upload[$i]['image'] = $timg;

            // 4.00.11 - 글답변에서 파일 업로드시 원글의 파일이 삭제되는 오류를 수정
            if ($w == 'u') {
                // 존재하는 파일이 있다면 삭제합니다.
                $row = sql_fetch(" select * from {$g5['board_file_table']} where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
                
                if(isset($row['bf_file']) && $row['bf_file']){
                    $delete_file = run_replace('delete_file_path', G5_DATA_PATH.'/file/'.$bo_table.'/'.str_replace('../', '', $row['bf_file']), $row);
                    if( file_exists($delete_file) ){
                        @unlink(G5_DATA_PATH.'/file/'.$bo_table.'/'.$row['bf_file']);
                    }
                    // 이미지파일이면 썸네일삭제
                    if(preg_match("/\.({$config['cf_image_extension']})$/i", $row['bf_file'])) {
                        delete_board_thumbnail($bo_table, $row['bf_file']);
                    }
                }
            }

            // 프로그램 원래 파일명
            $upload[$i]['source'] = $filename;
            $upload[$i]['filesize'] = $filesize;

            // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
            $filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc|phar)/i", "$0-x", $filename);

            shuffle($chars_array);
            $shuffle = implode('', $chars_array);

            // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
            $upload[$i]['file'] = md5(sha1($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

            $dest_file = G5_DATA_PATH.'/file/'.$bo_table.'/'.$upload[$i]['file'];

            // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
            $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);

            // 올라간 파일의 퍼미션을 변경합니다.
            chmod($dest_file, G5_FILE_PERMISSION);

            $dest_file = run_replace('write_update_upload_file', $dest_file, $board, $wr_id, $w);
            $upload[$i] = run_replace('write_update_upload_array', $upload[$i], $dest_file, $board, $wr_id, $w);
        }
    }   // end for
}   // end if

// 나중에 테이블에 저장하는 이유는 $wr_id 값을 저장해야 하기 때문입니다.
for ($i=0; $i<count($upload); $i++)
{
    $upload[$i]['source'] = sql_real_escape_string($upload[$i]['source']);
    $bf_content[$i] = isset($bf_content[$i]) ? sql_real_escape_string($bf_content[$i]) : '';
    $bf_width = isset($upload[$i]['image'][0]) ? (int) $upload[$i]['image'][0] : 0;
    $bf_height = isset($upload[$i]['image'][1]) ? (int) $upload[$i]['image'][1] : 0;
    $bf_type = isset($upload[$i]['image'][2]) ? (int) $upload[$i]['image'][2] : 0;

    $row = sql_fetch(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = 'arbbs' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");
    if ($row['cnt'])
    {
        // 삭제에 체크가 있거나 파일이 있다면 업데이트를 합니다.
        // 그렇지 않다면 내용만 업데이트 합니다.
        if ($upload[$i]['del_check'] || $upload[$i]['file'])
        {
            $sql = " update {$g5['board_file_table']}
                        set bf_source = '{$upload[$i]['source']}',
                             bf_file = '{$upload[$i]['file']}',
                             bf_content = '{$bf_content[$i]}',
                             bf_fileurl = '{$upload[$i]['fileurl']}',
                             bf_thumburl = '{$upload[$i]['thumburl']}',
                             bf_storage = '{$upload[$i]['storage']}',
                             bf_filesize = '".(int)$upload[$i]['filesize']."',
                             bf_width = '".$bf_width."',
                             bf_height = '".$bf_height."',
                             bf_type = '".$bf_type."',
                             bf_datetime = '".G5_TIME_YMDHIS."'
                      where bo_table = 'arbbs'
                                and wr_id = '{$wr_id}'
                                and bf_no = '{$i}' ";
            sql_query($sql);
        }
        else
        {
            $sql = " update {$g5['board_file_table']}
                        set bf_content = '{$bf_content[$i]}'
                        where bo_table = '{$bo_table}'
                                  and wr_id = '{$wr_id}'
                                  and bf_no = '{$i}' ";
            sql_query($sql);
        }
    }
    else
    {
        $sql = " insert into {$g5['board_file_table']}
                    set bo_table = '{$bo_table}',
                         wr_id = '{$wr_id}',
                         bf_no = '{$i}',
                         bf_source = '{$upload[$i]['source']}',
                         bf_file = '{$upload[$i]['file']}',
                         bf_content = '{$bf_content[$i]}',
                         bf_fileurl = '{$upload[$i]['fileurl']}',
                         bf_thumburl = '{$upload[$i]['thumburl']}',
                         bf_storage = '{$upload[$i]['storage']}',
                         bf_download = 0,
                         bf_filesize = '".(int)$upload[$i]['filesize']."',
                         bf_width = '".$bf_width."',
                         bf_height = '".$bf_height."',
                         bf_type = '".$bf_type."',
                         bf_datetime = '".G5_TIME_YMDHIS."' ";
        sql_query($sql);

        run_event('write_update_file_insert', $bo_table, $wr_id, $upload[$i], $w);
    }
}

// 업로드된 파일 내용에서 가장 큰 번호를 얻어 거꾸로 확인해 가면서
// 파일 정보가 없다면 테이블의 내용을 삭제합니다.
$row = sql_fetch(" select max(bf_no) as max_bf_no from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ");
for ($i=(int)$row['max_bf_no']; $i>=0; $i--)
{
    $row2 = sql_fetch(" select bf_file from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");

    // 정보가 있다면 빠집니다.
    if (isset($row2['bf_file']) && $row2['bf_file']) break;

    // 그렇지 않다면 정보를 삭제합니다.
    sql_query(" delete from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");
}

// 파일의 개수를 게시물에 업데이트 한다.
$row = sql_fetch(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ");
sql_query(" update {$write_table} set wr_file = '{$row['cnt']}' where wr_id = '{$wr_id}' ");

// 자동저장된 레코드를 삭제한다.
sql_query(" delete from {$g5['autosave_table']} where as_uid = '{$uid}' ");
//------------------------------------------------------------------------------

// 비밀글이라면 세션에 비밀글의 아이디를 저장한다. 자신의 글은 다시 비밀번호를 묻지 않기 위함
if ($secret)
    set_session("ss_secret_{$bo_table}_{$wr_num}", TRUE);

// 사용자 코드 실행
@include_once($board_skin_path.'/write_update.skin.php');
@include_once($board_skin_path.'/write_update.tail.skin.php');

delete_cache_latest($bo_table);

$redirect_url = run_replace('write_update_move_url', short_url_clean(G5_ARBBS_URL.'/detail.php?wr_id='.$wr_id.$qstr), $board, $wr_id, $w, $qstr, $file_upload_msg);

run_event('write_update_after', $board, $wr_id, $w, $qstr, $redirect_url);

if ($file_upload_msg)
    alert($file_upload_msg, $redirect_url);
else
    goto_url($redirect_url);