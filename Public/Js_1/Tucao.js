/**
 * 关闭回复
 * @param sthis 关闭回复框
 */

function x(sthis){

    $(sthis).parent().parent().attr("style","display:none");

}
/**
 * 划过显示回复栏
 */
$(function(){
    $(".tusoReplyInfo").live({
        mouseenter:
            function()
            {
                //$(this).find(".huifu").attr("style","display:");
                $(this).show();

            },
        mouseleave:
            function()
            {
//                $(this).find(".huifu").attr("style","display:none");
                $(this).hide();
            }
    });


    $(".handler").live({
        mouseenter:
            function()
            {
                //$(this).find(".huifu").attr("style","display:");
                $(this).parent().parent().next().show()

            },
        mouseleave:
            function()
            {
//                $(this).find(".huifu").attr("style","display:none");
                $(this).parent().parent().next().hide()
            }
    });
    /**
     * 回复划过
     */



    $("#hide_tucao").toggle(
        function () {
            $(".dv1").hide()
            $(this).html("显示吐槽");
        },
        function () {
            $(".dv1").show()
            $(this).html("隐藏吐槽");
        }
    );
})

/**
 * 点击回复 出现回复框
 * @param sthis
 */
function reply(sthis){

    $(".dv1 div").each(function(){
        $(this).attr("style","display:none")
    })
    $(sthis).parent().attr("style","display:none");
    $(sthis).parent().next().attr("style","display:")

}
/**
 * 判断是否已经到达最前面的章节，
 */
$(function(){
    $("#btn_up_page a").click(function(){
        var is_null=$(this).parent().attr("p_id");
        if(!is_null || is_null==0) return false;
    })
    $("#btn_up a").click(function(){
        var is_null=$(this).parent().attr("p_id");
       
        if(!is_null || is_null==0) return false;
    })
    /**
     * 颜色选择器
     */
    $('#bgcolor_qsq').ColorPicker({
        onSubmit: function(hsb, hex, rgb, el) {

            $(el).val(hex);
            $(el).ColorPickerHide();

            $("#bgcolor_val").val(hex);
            $("#bgcolor_qsq").val("背景颜色")


        },
        onBeforeShow: function () {
            $(this).ColorPickerSetColor(this.value);
        }
    })
    /**
     * 字体选择器
     */
    $('#fontcolor_qsq').ColorPicker({
        onSubmit: function(hsb, hex, rgb, el) {

            $(el).val(hex);
            $(el).ColorPickerHide();

            $("#fontcolor_val").val(hex);
            $("#fontcolor_qsq").val("字体颜色")



        },
        onBeforeShow: function () {
            $(this).ColorPickerSetColor(this.value);
        }
    })
})

