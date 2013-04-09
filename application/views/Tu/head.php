<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $mh['0']['jianjie']; ?></title>
    <script type="text/javascript" src="/public/js/jquery.min.js"></script>
    <script src="/public/js/jquery-migrate-1.1.1.js"></script>
    <script type="text/javascript" src="/public/js/jquery-ui-1.10.2.custom.js"></script>
    <script type="text/javascript" src="/public/js/Tucao.js"></script>


    <script type="text/javascript" src="/public/js/colorpicker.js"></script>
    <script type="text/javascript" src="/public/js/eye.js"></script>
    <script type="text/javascript" src="/public/js/utils.js"></script>
    <script type="text/javascript" src="/public/js/layout.js?ver=1.0.2"></script>

    <link rel="stylesheet" href="/Public/css/colorpicker.css" type="text/css" />
    <link rel="stylesheet" media="screen" type="text/css" href="/Public/css/layout.css" />
    <link type="text/css" rel="stylesheet" href="/Public/css/moren.css" id="moren_css" />
    <link rel="stylesheet" href="/Public/css/global.css" type="text/css" />

</head>

<body >
<?php
$p_id_add=$p_id+1;
@$next="?zhangjie={$p_id}&id={$next_id['id']}"; //下一页
$str="?zhangjie={$p_id_add}";                    //下一章
$url_next=isset($next_id['id']) ? $next : $str;     //如果下一页存在则取下一页，否则取下一章
$is_spill=isset($p_id) ? $p_id_add : $p_id;     //下一章
$next_chapter="<a href=".site_url("tu")."?zhangjie={$is_spill}>下一章</a>"; //下一章

//分割
$p_idjian=$p_id-1;  //上一章
$first=$this->db->from("mhpath")->order_by("id","desc")->select("id")->limit("1")->where("zjid =",$p_idjian)->get()->row_array(); //获取某张第一页

@$page_up="?zhangjie={$p_id}&id={$last_id['id']}";
@$str="?zhangjie={$p_idjian}&id={$first['id'] }";

$pageup=isset($last_id['id']) ? $page_up : $str; //上一页
$is_null=isset($last_id['id'])?$p_id:$p_idjian; //上一章
$last_chapter="<a href=".site_url("tu")."?zhangjie={$is_null}>上一章</a>";
?>
<div id="webTop" style="position: fixed;z-index: 3;">
    <div id="header" >
        <div id="logo"  ></div>
        <ul>
            <li><a href="#">首页</a></li>

            <li><a href="#">排行榜</a></li>
            <li><a href="#">我的书架</a></li>
            <li><a href="#">个人空间</a></li>
        </ul>
        <div id="btn_list" class="btn_background fl">目录</div>
        <div id="btn_up" class="btn_background fl"   p_id="<?php echo $is_null;  ?>" >
            <!--         上一章    1   -->
            <?php echo $last_chapter; ?>
        </div>
        <div id="btn_next" class="btn_background fl" p_id="<?php echo $next_chapter;  ?>">
            <?php echo $next_chapter;  ?>
        </div>

        <div id="btn_up_page" class="btn_background fl" p_id="<?php echo @$is_null?>" >
            <a href="<?php echo  $pageup ?>">上一页</a>
        </div>
        <div id="btn_next_page" class="btn_background fl">
            <a href="<?php echo $url_next ; ?>">下一页</a>

        </div>

        <div id="btn_light" class="btn_light" onclick="btn_light()">开灯</div>
    </div>
</div>