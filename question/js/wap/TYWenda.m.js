var TYWenda = {};
(function(a) {
    TYWenda.m = {initPage: {
				index: function() {
                	TY.loader("TY.zepto.touch", function() {
                    TYWenda.m.tabsFn({element: "#scrollpic",menu: "#scrollpic .focus-btn",autoPlay: true});
                    TYWenda.m.tabsFn({element: "#top_tab .tab-con",menu: "#top_tab .tab-btn"});
                    TYWenda.m.tabsFn({element: "#questions_tab .tab-con",menu: "#questions_tab .tab-btn"})
                });
                TYWenda.m.goTop();
                TYWenda.m.mSearch();
                TYWenda.m.indexSkip()
            },ask: function() {
                	TY.loader("TY.util.userAction", function() {
                });
                TYWenda.m.addQuestion.addInit();
                TYWenda.m.goTop();
                TYWenda.m.showFold();
				TYWenda.m.mSearch();
            },user: function() {
                TYWenda.m.userFocus.initFocus();
                TYWenda.m.goBack("home");
                TYWenda.m.goTop();
                TYWenda.m.exit();
                TYWenda.m.showMore();
				TYWenda.m.mSearch();
            },plaza: function() {
                TYWenda.m.theTree(".each-labels .hd");
				TYWenda.m.mSearch();
                TYWenda.m.goTop();
                TYWenda.m.indexSkip()
            },thread: function() {
                TYWenda.m.goBack("home");
                TYWenda.m.iAnswer();
                TYWenda.m.vote.initVote();
                TYWenda.m.addAnswer.addInit();
                TYWenda.m.addComment.addInit();
                TYWenda.m.goTop();
                TYWenda.m.fav.initFav();
				TYWenda.m.mSearch();
                TY.loader("TY.util.userAction", function() {
                })
            },indexPage: function() {
                TYWenda.m.goTop();
                TYWenda.m.indexSkip()
            },label: function() {
                TYWenda.m.goTop();
				TYWenda.m.mSearch();
                TYWenda.m.LabelFocus.initFocus();
                TYWenda.m.indexSkip()
            },searchUser: function() {
                TYWenda.m.iAnswer();
                TYWenda.m.goBack("home");
                TYWenda.m.mSearch();
                TYWenda.m.userFocus.initFocus();
                TYWenda.m.goTop()
            },searchTopic: function() {
                TYWenda.m.iAnswer();
                TYWenda.m.goBack("home");
                TYWenda.m.mSearch();
                TYWenda.m.goTop();
				TYWenda.m.LabelFocus.initFocus();
				TYWenda.m.userFocus.initFocus();
            }},addQuestion: {addInit: function() {
                var b = this, c = {question: a("#question"),supply: a("#supply"),labels: a("#labels"),subMenu: a("#subAdd"),classId: a("#classId")};
                c.question.blur(function() {
                    b.getLabel(a(this).val())
                });
                c.subMenu.on("click", function() {
                    if (!__global.isOnline()) {
                        TYWenda.m.showMsg("\u8bf7\u5148\u767b\u9646", 1);
                        return
                    }
                    if (b.checkSub(c)) {
                        var d = {action: "createTopic",subject: c.question.val(),detail: c.supply.val(),classId: c.classId.val(),mobile: "true",add_problem_tags: c.labels.val(),machineAction: a("#user_action").val()};
                        b.subData(d)
                    }
                })
            },getLabel: function(d) {
                var b = "http://wenda.tianya.cn/tagjs", c = {action: "suggest",q: d};
                a.post(b, c, function(e) {
                    if (e && e.result == "success") {
                        var h = a("#labels_lists"), g = [];
                        if (e.data.length == 0) {
                            return
                        }
                        var tagNum=e.data.length>6?6:e.data.length;
                        for (var f = 0; f < tagNum; f++) {
                            g.push('<span><a href="javascript:void(0);">' + e.data[f] + "</a></span>")
                        }
                        h.html(g.join(""));
                        TYWenda.m.selectTags()
                    }
                }, "json")
            },checkSub: function(d) {
                var e = d.question.val(), c = d.supply.val(), b = d.labels.val();
                if (TYWenda.m.getStrLen(e.trim()) < 10) {
                    d.question.focus();
                    TYWenda.m.showMsg("\u6807\u9898\u81f3\u5c115\u4e2a\u5b57", 1);
                    return false
                } else {
                    if (TYWenda.m.getStrLen(e.trim()) > 100) {
                        d.question.focus();
                        TYWenda.m.showMsg("\u6807\u989850\u5b57\u5185", 1);
                        return false
                    } else {
                        if (b.trim().replace(new RegExp("[\\s\u3000]+", "gm"), " ") == "") {
                            d.labels.focus();
                            TYWenda.m.showMsg("\u81f3\u5c11\u8f93\u51651\u4e2a\u6807\u7b7e", 1);
                            return false
                        }
                    }
                }
                return true
            },subData: function(d) {
                var c = "http://wenda.tianya.cn/topic", b = this;
                a.post(c, d, function(e) {
                    if (e && e.result == "success") {
                        b.control(e)
                    } else {
                        TYWenda.m.showMsg("\u63d0\u95ee\u5931\u8d25", 1)
                    }
                }, "json")
            },control: function(b) {
                var c = "http://wenda.tianya.cn/m/question/" + b.data.topicId;
                window.location.href = c
            }},addAnswer: {addInit: function() {
                var b = this, d = null, c = window.location.href ,view="0";
                elm = {answer: a("#answer"),subMenu: a("#subAnsMenu,#unLoginLink,.unLoginLink,.answerSub_zf,.answerSub_ff")};
                elm.subMenu.bind("click", function() {
				    if (!__global.isOnline()) {
                        window.location.href = "http://passport.tianya.cn/login_m.jsp?fowardURL=" + c;
                        return
                    }
					if($(this).hasClass("answerSub_zf")){
						$(".pk_show .zf textarea").val()==""?d="我支持正方":d=$(".pk_show .zf textarea").val();
						view="1"; 
					}
					else if($(this).hasClass("answerSub_ff")){
						$(".pk_show .ff textarea").val()==""?d="我支持反方":d=$(".pk_show .ff textarea").val();
						view="-1";  
					}
					else{
						 d = elm.answer.val();
					}
				   
                    if (d.trim() == "") {
                        TYWenda.m.showMsg("\u8bf7\u8f93\u5165\u60a8\u7684\u56de\u7b54", 1);
                        a(this).one("click");
                        return
                    }
                    var f = null, e = [];
                    a("#labels").find("a").each(function() {
                        e.push(a(this).attr("labelId"))
                    });
                    f = {action: "createFollowup",detail: d,labelIds: e,subject: a(".post-title").text(),view:view,mobile: "true",topicId: a(".post-title").attr("topicId"),machineAction: a("#user_action").val()};
					b.subData(f,view);
                })
            },subData: function(d,v) {
                var c = "http://wenda.tianya.cn/followup", b = this, view=v;
                a.post(c, d, function(e) {
					if (e && e.result == "success") {
                        $(".comment_list ").append("<div class='floor other-floor '><div class='poster-info'><div class='poster'>"+$("ul.list-set  li").html()+"</div><span class='time gray'>刚刚</span> </div><div class='post-details'>"+e.data.detail+"</div></div>");
						$("#answer").val("");

						if(e.flag==0 && view=="1"){ TYWenda.m.showMsg("您已支持正方"); $(".pk_show  textarea").val("")};
						if(e.flag==0 && view=="-1"){  TYWenda.m.showMsg("您已支持反方"); $(".pk_show  textarea").val("")};
						if(e.flag==1 && view=="1"){ $(".pk_show  textarea").val(""); TYWenda.m.showMsg("您支持了正方"); addVote("1")};
						if(e.flag==1 && view=="-1"){ $(".pk_show  textarea").val("");TYWenda.m.showMsg("您支持了反方"); addVote("-1")};
                    } else {
						TYWenda.m.showMsg(e.reason, 1,9);
                        //TYWenda.m.showMsg("\u56de\u7b54\u5931\u8d25", 1)
                    }
                }, "json")
            },control: function(b) {
                window.location = window.location.href
            }},addComment: {addInit: function() {
                var b = null, c = this, e = null, d = {subComm: a("input.sure"),addComm: a(".add-comment"),cancelComm: a("input.cancel")};
                d.addComm.on("click", function() {
                    c.showComBox(a(this))
                });
                d.cancelComm.on("click", function() {
                    c.showComBox(a(this))
                });
                d.subComm.on("click", function() {
                
                    if (!__global.isOnline()) {
                    	
                        TYWenda.m.showMsg("\u8bf7\u5148\u767b\u9646", 1);
                        return
                    }
                    b = a(this).parents(".comment").find("textarea").val();
                    if (b.trim() == "") {
                        TYWenda.m.showMsg("\u8bf7\u8f93\u5165\u60a8\u7684\u8bc4\u8bba", 1);
                        return
                    }
                    e = {action: "addComment",topicId: a(this).attr("topicId"),followupId: a(this).attr("followupId"),detail: b};
                    c.subData(e, a(this))
                })
            },showComBox: function(b) {
                var c = b.parents(".floor").find(".comment");
                if (c.hasClass("hide")) {
                    c.removeClass("hide")
                } else {
                    c.addClass("hide")
                }
            },subData: function(d, e) {
                var c = "http://wenda.tianya.cn/comment", b = this;
                a.post(c, d, function(f) {
                    if (f && f.result == "success") {
                        b.view(f, e)
                    } else {
                        if (f && f.result == "fail") {
                            TYWenda.m.showMsg("\u62b1\u6b49\u64cd\u4f5c\u592a\u9891\u7e41", 1)
                        } else {
                            TYWenda.m.showMsg("\u8bc4\u8bba\u5931\u8d25", 1)
                        }
                    }
                }, "json")
            },view: function(b, f) {
                var c = f.parents(".comment"), d = f.parents(".floor").find("span.add-comment em"), e = '<li class="cf"><figure class="info"><div class="comment-txt"><div class="time"><a href="http://wenda.tianya.cn/user/' + b.data.userId + '" target="_blank">' + b.data.userName + "</a> | \u521a\u521a </div>" + b.data.detail + "</div></figure></li>";
                if (c.find("ul").length == 0) {
                    c.prepend("<ul>" + e + "</ul>")
                } else {
                    c.find("ul").prepend(e)
                }
                d.html(+d.html() + 1);
                f.parents(".comment").find("textarea").val("")
            }},
			mSearch: function() {
            	var c = {topicUrl: "search",userUrl: "searchUser.jsp"}, e = "http://wenda.tianya.cn/m/", g = null, f = a("#searchForm"), d = a("#searchTopic"), b = a("#searchUser") ,s=a("#search_logo") ;
            	s.on("click", function() {
                	 if (s.hasClass("search_logo_on")) {
                    	s.removeClass("search_logo_on");
						a(".searchBar").hide();
               		 } else {
                    	s.addClass("search_logo_on");
                    	a(".searchBar").show();
               		 }	
            	});
				d.on("click", function() {
                	g = e + c.topicUrl;
                	f.attr("action", g);
                	f.submit()
            	});
            	b.on("click", function() {
                	g = e + c.userUrl;
                	f.attr("action", g);
                	f.submit()
            	});
            window.onkeyup = function(h) {
                var i = h || window.event;
                if (i.keyCode == 13) {
                    a("#tijiao").click()
                }
            }
        },iAnswer: function() {
            a("#ianswer").on("click", function() {
                var b = window.location.href;
                if (!__global.isOnline()) {
                    window.location.href = "http://passport.tianya.cn/login_m.jsp?fowardURL=" + b;
                    return false
                }
                a("#answer").focus();
                if (b.indexOf("#answer") >= 0) {
                    window.location.href = b
                } else {
                    window.location.href = b + "#answer"
                }
            });
            a("#iAsk").on("click", function() {
                if (!__global.isOnline()) {
                    window.location.href = "http://passport.tianya.cn/login_m.jsp?fowardURL=http://wenda.tianya.cn/m/ask.jsp";
                    return false
                }
                window.location.href = "http://wenda.tianya.cn/m/ask.jsp"
            })
        },vote: {initVote: function() {
                var b = this, c = a(".left-functions span");
                c.on("click", function() {
                    if (!__global.isOnline()) {
                        TYWenda.m.showMsg("\u8bf7\u5148\u767b\u9646", 1);
                        setTimeout(function() {
                            window.location = "http://passport.tianya.cn/login_m.jsp?fowardURL=" + window.location.href
                        }, 1500)
                    }
                    if (a(this).attr("class").indexOf("ed") > 0) {
                        TYWenda.m.showMsg("\u5df2\u7ecf\u6295\u8fc7\u7968\u4e86", 1);
                        return
                    }
                    var d = {action: "vote",topicId: a(this).attr("topicId"),followupId: a(this).attr("followupId")};
                    if (a(this).hasClass("support")) {
                        d.rate = "1"
                    } else {
                        d.rate = "-1"
                    }
                    b.subData(d, a(this))
                })
            },subData: function(e, b) {
                var d = "http://wenda.tianya.cn/followup", c = this;
                a.post(d, e, function(f) {
                    if (f && f.result == "success") {
                        c.control(f, b)
                    }
                }, "json")
            },control: function(d, b) {
                var c = b.siblings().attr("class");
                if (c.indexOf("ed") > 0) {
                    c = c.split(" ");
                    b.siblings().attr("class", c[0]);
                    b.siblings().html(+b.siblings().html() - 1)
                }
                b.addClass(b.attr("class") + "ed");
                b.html(+b.html() + 1)
            }},userFocus: {initFocus: function() {
                var b = this, c = null, d = a('input[rel = "userFocus"]');
                d.on("click", function() {
					if (!__global.isOnline()) {
                         window.location.href = "http://passport.tianya.cn/login_m.jsp?fowardURL=" + window.location.href;
                        return;
                    }
                    c = a(this).attr("uId");
                    if (a(this).hasClass("unfocus")) {
                        b.subData(1, c, a(this))
                    } else {
                        b.subData(0, c, a(this))
                    }
                })
            },subData: function(d, e, f) {
                var g = "", c = null, b = this;
                if (d == 1) {
                    g = "following.ice.insert"
                } else {
                    g = "following.ice.delete"
                }
                TY.crossSender.ajax({url: "http://www.tianya.cn/api/tw?",data: {method: g,"params.followingUserId": e},method: "POST",dataType: "json",cache: false,onSuccess: function(h) {
                        b.control(h, d, f)
                    }})
            },control: function(b, c, d) {
                if (b && b.success == 1) {
                    a.get("http://wenda.tianya.cn/userinfo?action=deleteFriendCache&_=" + new Date().getTime(), function(e) {
                        if (e && e.result == "success") {
                        }
                    }, "json");
                    if (c == 1) {
                        d.val("\u53d6\u6d88\u5173\u6ce8");
                        d.removeClass("unfocus");
						d.addClass("focused");
						
                    } else {
                        d.val("\u5173\u6ce8");
                        d.addClass("unfocus")
						d.removeClass("focused");
                    }
                    TYWenda.m.showMsg(b.message)
                }
            }},fav: {initFav: function() {
                var b = this, c = null, d = a(".favMenu"), u = window.location.href;
                d.on("click", function() {
                    if (!__global.isOnline()) {
                         window.location.href = "http://passport.tianya.cn/login_m.jsp?fowardURL=" + u;
						//TYWenda.m.showMsg("\u8bf7\u5148\u767b\u9646", 1);
                        return;
                    }
                    c = a(this).attr("topicId");
                    if (a(this).hasClass("favMenued")) {
                        b.subData(c, "0", a(this))
                    } else {
                        b.subData(c, "1", a(this))
                    }
                })
            },subData: function(e, d, f) {
                var b = this, c = null;
                c = "http://wenda.tianya.cn/topic?action=focus&" + a.param({topicId: e,focus: d});
                a.get(c, function(g) {
                    if (g && g.result == "success") {
                        b.control(g, d, f)
                    }
                }, "json")
            },control: function(c, d, b) {
                if (d == "0") {
                    b.removeClass("favMenued");
                    b.children('span').html("收藏")
                } else {
                    b.addClass("favMenued");
                    b.children('span').html("已收藏")
                }
            }},selectTags: function() {
            var d = a("#labels_lists").find("a");
            var b = null, c = null;
            d.on("click", function() {
                b = a("#labels").val().split(" ");
                c = a(this).hasClass("have");
                if (c) {
                    for (var f = 0; f < b.length; f++) {
                        if (a(this).text() == b[f]) {
                            b.splice(f, 1)
                        }
                        a(this).removeClass("have")
                    }
                    a("#labels").val(b.join(" "))
                } else {
                    if (b.length) {
                        if (b.length == 5) {
                            TYWenda.m.showMsg("\u6700\u591a5\u4e2a\u6807\u7b7e", 1);
                            return
                        }
                        for (var e = 0; e < b.length; e++) {
                            if (a(this).text() == b[e]) {
                                return
                            }
                        }
                        a("#labels").val(a("#labels").val().trim() + " " + a(this).text())
                    } else {
                        a("#labels").val(a(this).text())
                    }
                    a(this).addClass("have")
                }
            })
        },exit: function() {
            a("#exit").on("click", function() {
                window.location = "http://passport.tianya.cn/logout?returnURL=http://wenda.tianya.cn/m/&fowardFlag=y"
            })
        },getStrLen: function(d) {
            var b = 0;
            for (var c = 0; c < d.length; c++) {
                b += d.charCodeAt(c) > 128 ? 2 : 1
            }
            return b
        },showMsg: function(c, e, f) {
			
            var b = "",l="";
            if (e !== 0) {
                b = " myTip"
            }
			if(f==9){
				l="layer_long"	
			}else{
				l=""		
			}
			
            var d = '<div class="layer complaint-location '+l+'" id="myMsg"><div class="complaint' + b + '">' + c + "</div></div>";
            if (a("#myMsg").length <= 0) {
                a("body").append(d);
                a("#myMsg").on("click", function() {
                    a(this).hide()
                })
            } else {
                a("#myMsg").find(".complaint").text(c);
                a("#myMsg").show()
            }
            setTimeout(function() {
                a("#myMsg").remove()
            }, 1800)
        },goTop: function() {
            var b = a("#goTop");
            b.on("click", function() {
                var e = a(window).scrollTop();
                function c(f) {
                    if (f <= 0) {
                        clearInterval(d);
                        window.scrollTo(0, 0);
                        b.hide();
                        return
                    }
                    window.scrollTo(0, f);
                    e -= 100
                }
                var d = setInterval(function() {
                    c(e)
                }, 2)
            });
            a(window).on("scrollStop", function() {
                if (a(window).scrollTop() >= a(window).height()) {
                    b.show()
                } else {
                    b.hide()
                }
            })
        },tabsFn: function(c) {
            c.menu = c.menu || false;
            c.autoPlay = c.autoPlay || false;
            var m = 0, l = 0, o = 0, i = null, d = 5000, e = null, h = a(c.element), b = h.find(".move");
            if (b.length !== 0) {
                i = -(100 / b.length)
            }
            if (c.menu) {
                var j = a(c.menu), n = j.find("li");
                n.click(function() {
                    var f = a(this).index();
                    l = i * f + "%";
                    b.parent().css({"-webkit-transform": "translate(" + l + ")","-webkit-transition": "300ms linear"});
                    a(this).siblings().removeClass("active");
                    a(this).addClass("active");
                    if (c.autoPlay) {
                        clearInterval(k);
                        e = f;
                        k = setInterval(function() {
                            p()
                        }, d)
                    }
                })
            }
            if (c.autoPlay && c.menu) {
                var k = null, g = j.find("li").length - 1;
                e = a(c.menu).find("li.active").index();
                var p = function() {
                    e += 1;
                    if (e > g) {
                        e = 0
                    }
                    n.eq(e).click()
                };
                k = setInterval(function() {
                    p()
                }, d)
            }
            b.swipeLeft(function() {
                var f = a(this).index() + 1;
                m = i * f + "%";
                if (f == b.length) {
                    return false
                } else {
                    a(this).parent(".cf").css({"-webkit-transform": "translate(" + m + ")","-webkit-transition": "300ms linear"});
                    if (j) {
                        j.find("li").removeClass("active");
                        j.find("li").eq(f).addClass("active")
                    }
                }
                if (c.autoPlay) {
                    clearInterval(k);
                    e = f;
                    k = setInterval(function() {
                        p()
                    }, d)
                }
            });
            b.swipeRight(function() {
                var f = a(this).index();
                if (f == 0) {
                    return false
                } else {
                    var q = f - 1;
                    m = i * q + "%";
                    a(this).parent(".cf").css({"-webkit-transform": "translate(" + m + ")","-webkit-transition": "300ms linear"});
                    if (j) {
                        j.find("li").removeClass("active");
                        j.find("li").eq(q).addClass("active")
                    }
                }
                if (c.autoPlay) {
                    clearInterval(k);
                    e = f;
                    k = setInterval(function() {
                        p()
                    }, d)
                }
            })
        },goBack: function(b) {
            a("#goBack").on("click", function() {
                if (b == "home") {
                    window.location = "http://wenda.tianya.cn/m/"
                } else {
                    window.history.go(-1)
                }
            })
        },getClassLabel: function(e, c , t) {
            var b = "http://wenda.tianya.cn/tagjs?action=getSuggestLabel&classId=" + e, d = [];
            a.get(b, function(f) {
                if (f && f.result == "success") {
                    if (f.data.length !== 0) {
                        for (var g = 0; g < f.data.length; g++) {
                            d.push('<dd><a href="http://wenda.tianya.cn/m/tag/' + f.data[g].labelId + '">' + f.data[g].labelName + "</a></dd>")
                        }
                        c.html(d.join(""));
						t==""?"":TY("body").scrollTop(t);
						
						
                    } else {
                        c.find("p").html("\u8be5\u5206\u7c7b\u4e0b\u8fd8\u6728\u6709\u6807\u7b7e")
                    }
                }
            }, "json")
        },theTree: function(c) {
            var b = this;
            c = a(c);
            c.on("click", function() {
                var d = a(this).parent();
                if (d.hasClass("active")) {
                    d.removeClass("active")
                } else {
                    d.addClass("active");
                    if (d.find("dd").length === 0) {
                        d.find("dl").html('<p class="tc info">\u73a9\u547d\u52a0\u8f7d\u4e2d\uff0c\u8bf7\u7a0d\u540e...</p>');
                        b.getClassLabel(d.attr("id"), d.find("dl"),"")
                    }
                }
            })
        },showFold: function() {
            var c = a("#sk-con-tit"), b = a("#sk-con-con");
            c.on("click", function() {
                if (a(this).hasClass("fold")) {
                    a(this).removeClass("fold");
                    b.hide()
                } else {
                    a(this).addClass("fold");
                    b.show()
                }
            })
        },showMore: function() {
            var c = a(".myAnswer"), b = null;
            if (c.length !== 0) {
                b = 24;
                c.each(function() {
					if(a(this).hasClass("done")){return;}
                    if (a(this).height() > b) {
                        var d = a(this), e = a("<p>\u663e\u793a\u5168\u90e8</p>");
                        a(this).addClass("showPart");
                        a(this).after(e);
                        e.on("click", function() {
                            if (d.hasClass("showPart")) {
                                d.removeClass("showPart");
                                a(this).html("\u6536\u8d77")
                            } else {
                                d.addClass("showPart");
                                a(this).html("\u663e\u793a\u5168\u90e8")
                            }
                        })
                    }
					a(this).addClass("done");
					
                })
            }
        },indexSkip: function() {
            /*var c = a("nav").find("a").eq(2);
            var b = "http://wenda.tianya.cn/m/ask.jsp";
            c.click(function() {
                if (!__global.isOnline()) {
                    window.location.href = "http://passport.tianya.cn/login_m.jsp?fowardURL=" + b;
                    return false
                }
            })*/
        },LabelFocus: {initFocus: function() {
                var b = this, e = null, d = a('input[rel = "labelFocus"]');
                var c = window.location.href;
                d.on("click", function() {
                    if (!__global.isOnline()) {
                        window.location.href = "http://passport.tianya.cn/login_m.jsp?fowardURL=" + c;
                        return false
                    }
				
                    e = a(this).attr("lId");
                    if (a(this).hasClass("unfocus")) {
                        b.subData(1, e, a(this))
                    } else {
                        b.subData(0, e, a(this))
                    }
                })
            },subData: function(c, e, d) {
                var b = this;
                a.ajax({url: "http://wenda.tianya.cn/tagjs?",data: {action: "focus",focus: c,labelId: e},type: "GET",dataType: "json",cache: false,success: function(f) {
                        b.control(f, c, d)
                    }})
            },control: function(b, c, d) {
                if (b && b.result == "success") {
                    if (c == 1) {
                        d.val("\u53d6\u6d88\u5173\u6ce8");
                        d.removeClass("unfocus");
						d.addClass("focused");
                    } else {
                        d.val("\u5173\u6ce8");
                        d.addClass("unfocus");
						d.removeClass("focused");
                    }
                } else {
                    if (b.result == "fail") {
                        TYWenda.m.showMsg(b.reason);
                        a("#myMsg").css({"font-size": "16px"})
                    }
                }
            }},forAd: function(f) {
            var e = f.aid || "b-22134978932998-me-w-tianyam", d = f.ch || "cshou1", g = f.n || 2, b = f.m || 0;
            var c = "http://luna.58.com/xmladsvr/ads?";
            a.loadUrl(c + "&" + a.param({aid: e,ch: d,m: b,n: g}), function(h) {
                if (h && ad58.length > 0) {
                }
            })
        }}
})(Zepto);
