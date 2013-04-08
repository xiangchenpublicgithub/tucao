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
    <div class="clear"></div>
    <div id="" >
<!--    webBox    -->
    <div id="webContent">
         <div id="mainAnnounce"></div>
         <div id="hoverNav">
<!--        删除comic_pic可以解决布局问题     -->
            <div class="show_pic" id="show_pic">

                <div id="yuantou" style="background: #e11111">
                    <?php foreach ($tucaos as $value) {?>
                    <?php

                    $left=str_replace("px","",$value['left']);
                    $top= str_replace("px","",$value['top']);
                    $left_re=$left+100;
                    $top_re=$top-1;
                    ?>

                    <div id="drag_<?php echo  $value['id']; ?>" class="toso_dialogue" style="float: left; opacity: 0.8; z-index: 111; display: block;  position: absolute;top:<?php echo $value['top']; ?>; left: <?php echo $value['left'];?>;">
                        <div class="" style="width: 150px; cursor: pointer;">
                        </div>
                        <div style="background-color:#<?php echo $value['bgcolor_qsq'] ?>;" class="toso_content toso_font_black toso_bg_yellow" style="height: 1%; width: 138px;" title="<?php echo $value['ip'];?>的吐槽">
                            <p style="color:#<?php echo $value['fontcolor_qsq'] ?>"class="handler" onclick='zhichi(this,<?php echo $value['id'];?>,<?php echo $value['zhichi']; ?>)' ><?php echo $value['tucao'] ?></p>
                        </div>

                        <div id="" class="tusoReplyInfo" style="height: auto;  display:none ;">
                            <div class="effect">
                                <div id="tusoReplyList" class="clearfix">
                                    <?php foreach($huifu as $val){ ?>
                                    <?php  if($val['t_id']==$value['id']) { ?>
                                        <div class="tusoReply"><span style="white-space:nowrap;" class="tusoReplyContent" ><?php echo $val['reply_val']; ?></span></div>
                                        <?php }?>
                                    <?php }?>
                                </div>
                                <div id="tusoReplyInfo_title_50555" class="tusoReplyInfo_title">
                                    <span>共有<?php echo $value['zhichi']; ?>人支持</span>
                                    <a href='javascript:' class='btnReplt' onclick='btnReplt(this)'>回复</a>
                                </div>
                            </div>
                        </div>

                        <div id="tusoReply" node-type="layer" class="layer_add_topictag" style=" display:none">
                            <a action-type="hide_layer" onclick="closeReply(this);" class="W_close"></a>
                            <div class="tagsAdd_con">
                                <div class="tagsAdd_input">
                                    <input  type="text" id="W_input_re" class="W_input" >
                                    <a action-type="add_topic" onclick="replySub(this,'<?php echo  $value['id']; ?>')" class="btnRepltContent"><span>发回复</span></a></div>
                                <p node-type="tip" class="tagsAdd_note W_textb">回复:'<?php echo $value['tucao'] ?>'</p>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
                </div>
                <div onclick="return false;" id="CRviewer"
                     class="CRviewer" style="height: auto; width: 900px; left: 0px;">
                    <img class="piclist" style="padding-top: 100px;padding-bottom: 30px;max-width: 900px; max-height: 10000px; vertical-align: middle; display: inline;" src="<?php echo $mh['0']['path']; ?>" onerror="this.style.display='none'" id="myImgs">
                    <div id="tusoContainer" onclick="mouseClick(this, event);"></div>
                </div>


                <div class="hoverNav">
                    <a class="prevLink pt" id="a_pt" style="cursor:pointer" mce_style="cursor:pointer" href="<?php echo $pageup; ?>"></a>
                    <a class="nextLink nt" id="a_nt" style="cursor:pointer" mce_style="cursor:pointer" href="<?php echo $url_next; ?>"></a>
                </div>
            </div>
         </div>
    </div>
    </div>
    <div id="TusoBar">
        <div id="mainTusoBar">
             <div id="bgcolor"   class="Btn_TouserBack" >
                 <input type="text" maxlength="6" size="6" id="bgcolor_qsq" value="背景颜色" class="Btn_TouserBack" >
             </div>

            <div id="fontcolor" class=" Btn_TouserBack">
                <input type="text" maxlength="6" size="6" id="fontcolor_qsq" value="字体颜色" class="Btn_TouserBack">
            </div>
             <div id="TusorInputDiv"> <input type="text" id="text1" width="229px" placeholder="请输入吐槽内容" /></div>
             <div   ><a class="Btn_TouserBack_TZ" href="javascript:" onclick="tucao()">吐遭</a></div>
             <div class="Btn_TouserBack" id="hide_tucao">隐藏吐遭</div>
             <div class="TouserShowMessage">共有<span><?php echo count($tucaos) ?></span>个吐遭，欢迎大家吐遭！</div>
        </div>
    </div>
<!--吐槽内容显示-->
<?php // foreach ($tucaos as $value) { ?>
<!--<div class="dv1 --><?php //echo  $value['id; ?><!--" id="--><?php //echo  $value['id; ?><!--" style="opacity: 1;font-size: 122; cursor: move; left: --><?php //echo $value['left;?><!--; top:--><?php //echo $value['top; ?><!--" ">-->
<!--<p style="background-color:#--><?php //echo $value['bgcolor_qsq ?><!--;color:#--><?php //echo $value['fontcolor_qsq ?><!--"class="handler" onclick='zhichi(this,--><?php //echo $value['id;?><!--,--><?php //echo $value['zhichi; ?><!--)' >--><?php //echo $value['tucao ?>
<!--</p>-->
<!--<div class="huifu" style="display:none"><span>共有<a class="zhichi">--><?php //echo $value['zhichi;  ?>
<!--</a>个人支持</span> <a href="javascript:" onclick="reply(this)">点击回复</a>-->
<!---->
<?php //foreach($huifu as $val){ ?>
<?php // if($val['t_id']==$value['id) { ?>
<!--<a style='background: #2948f1'>--><?php //echo $val['reply_val']; ?><!-- </a>-->
<?php //} ?>
<?php //} ?>
<!--    </div>-->

<!--吐槽内容结束-->

<!--吐槽内容显示-->


    <!--吐槽内容结束-->
    <input type="hidden" id="bgcolor_val" >
    <input type="hidden" id="fontcolor_val" >
    <input type="hidden" id="tucao_a">
    <input type="hidden" id="flag_ag" >
 <script type="text/javascript">
     $(function(){

//         $( ".toso_dialogue").draggable({
//             containment: "#show_pic img", scroll: false,opacity: 0.5
//
//         })
     })
        $(function(){

            //var flag_ag =false;
        })
	   function tucao(){
//           var tucao1=$("#tucao1").val();
           var bgcolor_qsq="";  //背景色
           var fontcolor_qsq="";  //字体色
           $("#flag_ag").val("true");//默认为true
           var val=$("#text1").val();   //获取吐槽内容
           var space_filter=val.replace(/(^\s*)|(\s*$)/g, "");  //过滤空格
            if(space_filter==""){
                alert("请输入有意义的评论")
                return false;
            }




         }
       $("#show_pic").click(function(e){

           var flag=$("#flag_ag").val();

           if(flag!=""){

               bgcolor_qsq=$("#bgcolor_val").val();  //背景色
               fontcolor_qsq=$("#fontcolor_val").val();  //字体色
               var tucao1=$("#text1").val();
               var left=e.pageX+"px";
               var top= e.pageY+"px";

               var left_re=e.pageX+150+"px";
               var top_re=e.pageY-1+"px";
               var img_id="<?php echo $mhid; ?>";
               var bgcolor_qsq=$("#bgcolor_val").val();  //背景色
               var fontcolor_qsq=$("#fontcolor_val").val();  //字体色
               $.post("<?php echo site_url('tu/addtu')?>",{"left":left,"top":top,"tucao":tucao1,"img_id":img_id,"bgcolor_qsq":bgcolor_qsq,"fontcolor_qsq":fontcolor_qsq},function(msg){
                  var msg_n=JSON.parse(msg);
                  var msg=msg_n['id'];     //返回ID
                  var msg_ip=msg_n['ip'];  //返回ip
                  var url='<div id="drag_'+msg+'"    class="toso_dialogue"   style="float: left; opacity: 0.8; z-index: 111; display: block;  position: absolute;top:'+top+'; left: '+left+'; " >'+
                           '<div id="drag_'+msg+'"    class="toso_title2" style="width: 150px; cursor: pointer;top:">'+
                            '</div>'+
//                           '<div style="background-color:#'+bgcolor_qsq+';" class="toso_content toso_font_black toso_bg_yellow" style="height: 1%; width: 138px;" title="'+msg_ip+'">'+
                           '<div style="background-color:#'+bgcolor_qsq+';"  class="toso_content toso_font_black toso_bg_yellow" style="height: 1%; width: 138px;" title="">'+
                           '<p style="color:#'+fontcolor_qsq+'"   class="handler"  onclick="zhichi(this,'+msg+')" >'+tucao1+'</p>'+
                           '</div>'+
                           '<div id="tusoReplyInfo_50555" class="tusoReplyInfo" style="height: auto; left: right; display: none;">'+
                          '<div class="effect">'+
                          '<div id="tusoReplyList">'+
                          '</div>'+
                          '<div id="tusoReplyInfo_title_50555" class="tusoReplyInfo_title">'+
                          '<span>共有0人支持</span>'+
                          "<a href='javascript:' class='btnReplt' onclick='btnReplt(this)'>回复</a>"+
                          ' </div>'+
                          ' </div>'+
                           ' </div>'+
                          '<div id="tusoReply" node-type="layer" class="layer_add_topictag" style=" display:none">'+
                          '<a action-type="hide_layer" onclick="closeReply(this);" class="W_close"></a>'+
                           '<div class="tagsAdd_con">'+
                           '<div class="tagsAdd_input">'+
                           '<input node-type="input" type="text" id="W_input_re" class="W_input" >'+
//                           '<a action-type="add_topic" onclick="replySub('+msg+',this,'+msg_ip+')" class="btnRepltContent"><span>发回复</span></a></div>'+
                           "<a action-type='add_topic' onclick='replySub(this,"+msg+")' class='btnRepltContent'><span>发回复</span></a></div>"+
                          '<p node-type="tip" class="tagsAdd_note W_textb">回复:'+tucao1+'</p>'+
                           '</div>'+
                          '</div>'+
                          '</div>';
//                   var arr = new Array()
//                       arr[0] = '<div id="drag_'+msg+'"    class="toso_dialogue"   style="float: left; opacity: 0.8; z-index: 111; display: block;  position: absolute;top:'+top+'; left: '+left+'; " >';
//                       arr[1] ='<div id="drag_'+msg+'"    class="toso_title2" style="width: 150px; cursor: pointer;top:">';
//                       arr[2] = '</div>';
//                       arr[3] = '<div style="background-color:#'+bgcolor_qsq+';"  class="toso_content toso_font_black toso_bg_yellow" style="height: 1%; width: 138px;" title="">';
//                       arr[4] = '<p style="color:#'+fontcolor_qsq+'"   class="handler"  onclick="zhichi(this,'+msg+')" >'+tucao1+'</p>';
//                       arr[5] = '</div>';
//                       arr[6] = '<div id="tusoReplyInfo_50555" class="tusoReplyInfo" style="height: auto; left: right; display: none;">';
//                       arr[7] = '<span>共有0人支持</span>';
//                       arr[8] = "<a href='javascript:' class='btnReplt' onclick='btnReplt(this)'>回复</a>";
//                       arr[9]= ' </div> </div></div>';
//                       arr[10]= '<div id="tusoReply" node-type="layer" class="layer_add_topictag" style=" display:none">';
//                       arr[11]= '<a action-type="hide_layer" onclick="closeReply(this);" class="W_close"></a>';
//                       arr[12]= '<div class="tagsAdd_con"><div class="tagsAdd_input"><input node-type="input" type="text" id="W_input_re" class="W_input" >';
//                       arr[13] ="<a action-type='add_topic' onclick='replySub(this,"+msg+")' class='btnRepltContent'><span>发回复</span></a></div>";
//                       arr[14]=  '<p node-type="tip" class="tagsAdd_note W_textb">回复:'+tucao1+'</p>';
//                       arr[15]= '</div></div></div>';
//                   var url=arr.join(" ")
//                   document.write(url);
//                   return false;
                   $("body").append(url);
                   var t_num= $(".TouserShowMessage span").html();
                   $(".TouserShowMessage span").html(++t_num);
                   $( "#drag_"+msg ).draggable({
                       containment: "#show_pic img", scroll: false,opacity: 0.5

                           },
                           {stop:function(e,ui){
                               var id=$("#drag_"+msg);
                               var left=id.css("left");
                               var top= id.css("top");
                               $.post("<?php echo site_url('tu/edittu')?>",{"id":msg,"left":left,"top":top},function(msg){})} }
                   )
               })
           }
           $("#flag_ag").val("");



       })





         /**
          * 点击发回复，发送至服务器
          * @id  吐槽id
          */
         function replySub(sthis,t_id){
             var re_val=$(sthis).prev().val();


             if(re_val!=""){
                 $.post("<?php echo site_url('tu/reply')?>",{"re_val":re_val,"t_id":t_id},function(){
                     var url='<div class="tusoReply"><span style="white-space:nowrap;" class="tusoReplyContent" >'+re_val+'</span></div>';
                     var parent = $(sthis).parent().parent().parent().prev().find("#tusoReplyList");
                     parent.append(url);
                     $(sthis).parent().parent().parent().hide();
                 })
             }
             else {
             alert('请输入有意义的评论!!')
             return false;
             }
            // var re_val=$("#W_input_re").val("不能取值");



         }

     /**
      *点击 支持
      * @param sthis 对象本身
      * @param id    吐槽ID
      * @param zhichi_id 支持数
      */
     function zhichi(sthis,id){
         $.post("<?php echo site_url('tu/zhichi')?>",{"id":id},function(msg){
               var msg=JSON.parse(msg);

               $(sthis).parent().next().find(".tusoReplyInfo_title span").html("共有"+msg.num+"人支持"); //返回最新支持人数
                if(msg.flag==3)
                 alert("您已经支持过了")
             else{

                }
         })
         event.stopPropagation();
     }

     $(function(){
         $("#btn_light").toggle(
                 function(){
                     $("#webContent").css("background","rgb(255,255,255)");
                     $(this).html("关灯")
         },
                 function(){
                     $("#webContent").css("background","rgb(0,0,0)");
                     $(this).html("开灯")

                 }
         )
     })
 </script>



</body>
</html>
