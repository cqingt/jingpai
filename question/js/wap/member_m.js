/**
 * User: Channing
 * Date: 13-5-10
 * Time: 下午2:19
 */
(function ($) {
    var $root = $(".content");

    /**
     * 检测是否包含某个元素，如果有，则执行callback
     * @param selector  元素选择器
     * @param callback
     */
    function ifMod(selector, callback) {
        var $mod = $(selector);
        if ($mod.size() > 0) {
            callback($mod);
        }
    }

    /**
     * 显示错误提示信息
     * @param msg 信息
     * @param second 停留多少秒
     */
    window.showErrMsg = function (msg, second) {
        $(".msg-container").remove();
        var $msg = $('<div class="msg-container"><div class="msg msg-red">' + msg + '</div></div>');
        $root.append($msg);
        setTimeout(function () {
            $msg.remove();
        }, (second || 2.5) * 1000);
    };

    $(function () {
        /**
         * 检查手机号码
         * 天朝的有规则，其余的6到16位
         * @returns {boolean}
         */
        var chkPhone = function () {
            var phoneNum = $("#phone_num").val();
            if($.trim(phoneNum)=="") {
                showErrMsg("请输入您要认证的手机号码!");
                return false;
            }
            if(/\D/.test(phoneNum)) {
                showErrMsg("请输入正确的手机号码!");
                return false;
            }
            if($("#area_code").val()=="" && !/^1([3,4,5,7,8])\d{9}$/.test(phoneNum)) {
                showErrMsg("请输入正确的手机号码!");
                return false;
            }else if(phoneNum.length<6||phoneNum.length>16){
                showErrMsg("请输入正确的手机号码!");
                return false;
            }
            return true;
        };
        /**
         * 检查国家区域选择情况
         * 天朝时，code为空，其余必须有东西
         * @returns {boolean}
         */
//        var chkArea = function () {
//            var areaName = $.trim($("#area_name").val());
//            var areaCode = $.trim($("#area_code").val());
//            if(areaName=="") {
//                showErrMsg("请选择认证手机号码对应的国家!");
//                return false;
//            }
//            if(areaCode==""&&areaName!="中国") {//中国区号为空
//                showErrMsg("请选择认证手机号码对应的国家!");
//                return false;
//            }
//            return true;
//        };
        /**
         * 检查验证码，4位
         * @returns {boolean}
         */
        var chkCode = function () {
            var code = $("#v_code").val();
            if(!/[a-zA-Z0-9]{4}/.test(code)) {
                showErrMsg("请填写正确的验证码!");
                return false;
            }
            return true;
            //v_code有东西且4位
        };
        /**
         * 登录页脚本
         */
        ifMod("#page_login", function ($mod) {
            $mod.on("submit", "form", function (e) {
                e.preventDefault();
                if($.trim($("#user_name").val()).length==0) {
                    showErrMsg("请填写用户名!");
                    return false;
                }
                if($.trim($("#password").val()).length==0) {
                    showErrMsg("请填写密码!");
                    return false;
                }
                if ($("#v_code").size() > 0 && !chkCode()) {
                    return false;
                }
                this.submit();
            });
        });
        /**
         * 修改认证手机脚本
         */
        ifMod("#page_edit",function($mod) {
            $mod.on("submit", "form", function (e) {
                e.preventDefault();
                if(chkPhone()) {
                    this.submit();
                }
            });
        });
        /**
         * 注册页面脚本
         */
       
        /**
         * 选择国家区域的脚本
         */
        ifMod("#page_select_area", function ($mod) {
            $.ajax({
                "url": "/countryTel/json.do",
                dataType:"json",
                success:function(rtnData) {
                    var html = [];
                    for(var i = 0,iMax = rtnData.length,obj; i < iMax; i++) {
                        obj = rtnData[i];
                        html += '<li code="'+ obj.countryCode +'">'+ obj.ChineseName +'('+ obj.nativeName +')</li>';
                    }
                    $mod.find("ul").html(html);
                    var $head = $(".header-static");
                    var $backBtn = $head.find(".list-nav li");
                    var $areaName = $("#area_name");
                    var $areaCode = $("#area_code");
                    var $dftArea = $mod.find("li").eq(0);
                    $areaName.val($areaName.val()||$.trim($dftArea.text()));
                    $areaCode.val($areaCode.val()||$dftArea.attr("code"));
                    $mod.on("click", "li", function (e) {
                        var $this = $(this);
                        $areaName.val($.trim($this.text()));
                        $areaCode.val($this.attr("code"));
                        $backBtn.trigger("click");
                    });
                    $("#show_area").on("click",function () {
                        $mod.show();
                        $root.hide();
                        var $a = $head.find(".list-nav a");
                        var $title = $head.find(".center");
                        var $itemUser = $head.find(".item-user");
                        $a.attr("_href", $a.attr("href")).attr("href", "javascrtip:void(0)");
                        $title.attr("_text", $.trim($title.text())).text("选择国家");
                        $itemUser.hide();
                        $backBtn.one("click", function (e) {
                            e.preventDefault();
                            $a.attr("href", $a.attr("_href"));
                            $title.text($title.attr("_text"));
                            $itemUser.show();
                            $mod.hide();
                            $root.show();
                            return false;
                        });
                    });
                }
            });
        });
        /**
         * 手机认证激活页脚本
         */
        ifMod("#page_identity", function ($mod) {
        	$mod.on("click", ".check-activate", function (e) {
        		e.preventDefault();
        		$mod.find("form").submit();
        		return false;
        	});
        });
    });
})(Zepto);