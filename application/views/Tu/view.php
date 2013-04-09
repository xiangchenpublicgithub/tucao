<!--载入头文件-->
<?php include("head.php")   ?>

<!--    webBox    -->
    <div id="webContent">
         <div id="mainAnnounce"></div>
         <div id="hoverNav">
            <div class="show_pic" id="show_pic">
                <div id="yuantou" style="background: #e11111">
<!--         循环吐槽           -->
                    <?php foreach ($tucaos as $value) {?>

                    <?php include("list.php")  ?>
                    <?php } ?>
<!--          循环吐槽结束          -->
                </div>
<!--          加载图片      -->
                <div onclick="return false;" id="CRviewer"
                     class="CRviewer" style="height: auto; width: 900px; left: 0px;">
                    <img class="piclist" style="padding-top: 100px;padding-bottom: 30px;max-width: 900px; max-height: 10000px; vertical-align: middle; display: inline;" src="<?php echo $mh['0']['path']; ?>" onerror="this.style.display='none'" id="myImgs">
                    <div id="tusoContainer" onclick="mouseClick(this, event);"></div>
                </div>
<!--          加载图片结束    -->

<!--                上一页    下一页-->
                <div class="hoverNav">
                    <a class="prevLink pt" id="a_pt" style="cursor:pointer" mce_style="cursor:pointer" href="<?php echo $pageup; ?>"></a>
                    <a class="nextLink nt" id="a_nt" style="cursor:pointer" mce_style="cursor:pointer" href="<?php echo $url_next; ?>"></a>
                </div>
<!--             end   -->
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
    <input type="hidden" id="bgcolor_val" >
    <input type="hidden" id="fontcolor_val" >
    <input type="hidden" id="tucao_a">
    <input type="hidden" id="flag_ag" >
 <script type="text/javascript">
    function tucao(){
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
                           "<a action-type='add_topic' onclick='replySub(this,"+msg+")' class='btnRepltContent'><span>发回复</span></a></div>"+
                          '<p node-type="tip" class="tagsAdd_note W_textb">回复:'+tucao1+'</p>'+
                           '</div>'+
                          '</div>'+
                          '</div>';
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
