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
