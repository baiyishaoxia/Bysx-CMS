/**
 * 
 */
$(function () { 
	//最新文章
	$(".J_lastTime ul li").eq(0).addClass("hov");
	$(".J_lastTime ul li").hover(function(){
		var id = $(this).index();
		$(".J_lastTime ul li").removeClass("hov").eq(id).addClass("hov");
	})
	
	//说一说
	$(".j-feed").click(function(){
		var url = $(this).attr("data-url");
		var content = $("textarea").val(); //获取文本框内容
		
		if(content == ''){
			$(".field-feed-content").addClass("has-error");
			return false;
		}
			
		
		$.ajax(url,{
			type:"post",
			dataType:"json",
			data:{ content:content },
			success:function(data){
				if(data.status){
					location.reload();
				}else{
					alert(data.msg);
				}
			},
		})
	})
	
//	$("button").click(function(){
//        var url = "";  //调用的地址
//        var content = $("textarea").val(); //获取文本框内容
//        $.ajax(url,{
//            type : "get",
//            dataType : "json",
//            data:{ content:content },
//            success : function (data) {
//                if(data.status == 0){
//                    //成功后执行的代码写在这里
//                }
//                else{
//                    alert(data.msg);
//                    return false;
//                }
//            },
//            error : function () {
//                alert("接口网络错误");
//                return false;
//            }
//        })
//    })

});

//轮播控制函数
$(function(){
	$('#myCarousel').carousel({
           //循环轮播的速度
	    interval: 2500
			})
});

//签到
$(".j_Sign").click(function(){
        var url = $(this).attr("data-url");
        var obj = $(this);
        if(obj.hasClass("signed")){
                return false;
        }else{
                $.ajax(url,{
                        type:"post",
                        dataType:"json",
                        success:function(d){
                                if(d.status){
                                        obj.find(".j_Curtime").html(d.data.curtime);
                                        obj.find(".j_Signed").html(d.data.signed);
                                        obj.find("i").removeClass("glyphicon-calendar").addClass("glyphicon-ok").parent().addClass("signed");
                                }else{
                                        alert(d.msg);
                                }
                        },
                })
        }

})

$(document).delegate(".j_replayBtn",'click',function(){
        var obj = $(this).siblings(".j_replayForm");
        $(".j_replayForm").hide();
        obj.show().find("#comment-content").val("");
})

$(".j_replayAt").on('click',function(){
        var obj = $(this).closest("li");
        var name = $(this).parent().siblings(".j_name").html();
        $(".j_replayForm").hide();
        obj.find(".j_replayForm").show().find("#comment-content").val("@"+name+" ");
})

//回复和评论
var id = $(".J_postId").attr("data-id");
var title = $(".J_postId h1").html();
$(document).delegate(".J_btnPrimary",'click',function(){   //回复
        //var f = $(".j_reply_url").val();
        //alert(f);
        var obj = $(this).closest("li"); 
        var pid = obj.attr("data-key"); 
        var content = $(this).closest("form").find("textarea").val();
        if(content.length<=2){
                return false;
        }
        ajaxGree(id,title,2,content,pid,obj);
})
$("textarea").bind("input propertychange",function() {
        var content = $(this).val();
        if(content.length<=2){
                $(this).siblings(".help-block").html('回复不能少于2个字符！');
                $(this).parent().addClass("has-error");
        }else{
                $(this).siblings(".help-block").html('');
                $(this).parent().removeClass("has-error");
        }
});	
	
function ajaxGree(id,title,type,content,pid,obj){		
        $.ajax({
        url:$(".j_reply_url").val(),
        type:"post",
        dataType:"json",
        data:{
                post_id:id,
                type:type,
                title:title,
                content:content,
                parent_id:pid,
        },
        success:function(d){
//                console.log(d.status);
//                alert(d.res);
//                alert(d.da2);
//                alert(d.da3);
//                alert(d.da4);
//                alert(d.da5);
//                alert(d.status);
                if(d.status){
                        window.location.reload();
                }else{
                        alert(d.msg);
                }

        },
        })
}
