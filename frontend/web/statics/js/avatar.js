/**
 * 
 */
$(function(){
	
	/*头像更换*/
	
	$(".j_Alteravatar li").click(function(){
		avatar($(this),$(this).parent().attr("data-url"));
	})
	
	function avatar(obj,url){
                //alert(url);return false;
		var imgsrc = obj.find("img").attr("avatar-url");
                document.cookie="imgsrc="+imgsrc;
                var domain = window.location.host;
                //alert(url);return false;
                window.location.href= url;
//		$.ajax(url,{
//			type:"post",
//			dataType:"json",
//			data:{ imgsrc:imgsrc},
//			success:function(d){
//				if(d.status)
//					window.location.href=window.location.href;
//				else 
//					alert(d.msg);
//			},
//			error:function(){
//				alert("网络错误！");
//			}
//		})
        $.ajax({  
                url: $(this).parent().attr("data-url"),   
                type : 'POST',  
                data : {
                    imgsrc:imgsrc,
                    },  
                dataType : 'text',  
                contentType : 'application/x-www-form-urlencoded',  
                async : false,  
                success : function(mydata) { 
                    if(mydata.status)
                        window.location.href=window.location.href;
                    else 
                        alert(d.msg);
                        //alert("success");  
                        //alert(mydata);  
                },  
                error : function() {  
                        alert("calc failed");  
                }  
        });  
     }
})





//$(function(){
//	
//	/*头像更换*/
//	
//	$(".j_Alteravatar li").click(function(){
//		avatar($(this),$(this).parent().attr("data-url"));
//	})
//	
//	function avatar(obj,url){
//		var imgsrc = obj.find("img").attr("avatar-url");
//                 $.ajax({
//                        url: '/member/avatar',
//                        type: 'post',
//                        data: {imgsrc: imgsrc },
//                        success: function (data) {
//                            alert('1');
//                             }
//                         });
//
//
//	}
//})