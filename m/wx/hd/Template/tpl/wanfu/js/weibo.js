/*
* myFocus JavaScript Library v1.1.0
懒人建站为您提供-JS代码，js特效代码大全，js特效广告代码，下拉菜单，下拉菜单代码，导航菜单代码和基于jquery的各种特效与jquery插件。
http://www.51xuediannao.com/
*/
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(6(){U={1V:{2K:\'1W\',1w:\'2L\',1j:14,2M:N},E:{},1x:6(){8 a=1X,l=a.K,i=1,1k=a[0];9(l===1){i=0,1k=7.E}D(i;i<l;i++){D(8 p 1l a[i])9(!(p 1l 1k))1k[p]=a[i][p]}}};8 q={$:6(a){x 1Y a===\'1Z\'?V.2N(a):a},$$:6(a,b){x(7.$(b)||V).2O(a)},$$1y:6(b,c){8 d=[],a=7.$$(b,c);D(8 i=0;i<a.K;i++){9(a[i].20===c)d.W(a[i]);i+=7.$$(b,a[i]).K}x d},$c:6(a,b){8 c=7.$$(\'*\',b),a=a.15(/\\-/g,\'\\\\-\'),1m=1z 2P(\'(^|\\\\s)\'+a+\'(\\\\s|$)\'),1A=[];D(8 i=0,l=c.K;i<l;i++){9(1m.2Q(c[i].L)){1A.W(c[i]);21}}x 1A[0]},$B:6(a,b){x 7.$$1y(\'B\',7.$c(a,b))},1j:6(a,b){8 c=V.22(\'2R\');c.L=b;a[0].20.23(c,a[0]);D(8 i=0;i<a.K;i++)c.2S(a[i])},2T:6(a,b){a.16=\'<O 24=\'+b+\'>\'+a.16+\'</O>\'},2U:6(a,b){8 s=[],O=7.$$(\'O\',a)[0],B=7.$$1y(\'B\',O),C,n=B.K,1B=b.K;D(8 j=0;j<1B;j++){s.W(\'<O 24=\'+b[j]+\'>\');D(8 i=0;i<n;i++){C=7.$$(\'C\',B[i])[0];s.W(\'<B>\'+(b[j]==\'1B\'?(\'<a>\'+(i+1)+\'</a>\'):(b[j]==\'17\'&&C?B[i].16.15(/<C(.|\\n|\\r)*?(\\>\\<\\/a\\>)/i,C.2V+\'</a>\')+\'<p>\'+C.25("1n")+\'</p>\':(b[j]==\'26\'&&C?\'<C 18=\'+(C.25("26")||C.18)+\' />\':\'\')))+\'<1C></1C></B>\')};s.W(\'</O>\')};a.16+=s.1D(\'\')}},27={y:6(o,a){8 v=(+[1,]?2W(o,28):o.2X)[a],1E=2Y(v);x 29(1E)?v:1E},2a:6(o,a){o.y.2Z="30(H="+a+")",o.y.H=a/N},2b:6(o,a){8 b=o.L,1m="/\\\\s*"+a+"\\\\b/g";o.L=b?b.15(2c(1m),\'\'):\'\'}},2d={1o:6(a,f,g,h,i,j){8 k=f===\'H\'?14:G,H=7.2a,2e=1Y g===\'1Z\',2f=(1z 2g).2h();9(k&&7.y(a,\'1p\')===\'1F\')a.y.1p=\'31\',H(a,0);8 l=7.y(a,f),b=29(l)?1:l,c=2e?g/1:g-b,d=h||32,e=7.2i[i||\'2j\'],m=c>0?\'33\':\'2k\';9(a[f+\'19\'])1a(a[f+\'19\']);a[f+\'19\']=1G(6(){8 t=(1z 2g).2h()-2f;9(t<d){k?H(a,1b[m](e(t,b*N,c*N,d))):a.y[f]=1b[m](e(t,b,c,d))+\'A\'}P{1a(a[f+\'19\']),k?H(a,(c+b)*N):a.y[f]=c+b+\'A\',k&&g===0&&(a.y.1p=\'1F\'),j&&j.34(a)}},13);x 7},35:6(a,b,c){7.1o(a,\'H\',1,b==1c?1H:b,\'1I\',c);x 7},36:6(a,b,c){7.1o(a,\'H\',0,b==1c?1H:b,\'1I\',c);x 7},2l:6(a,b,c,d,e){D(8 p 1l b)7.1o(a,p,b[p],c,d,e);x 7},37:6(a){D(8 p 1l a)9(p.38(\'19\')!==-1)1a(a[p]);x 7},2i:{1I:6(t,b,c,d){x c*t/d+b},39:6(t,b,c,d){x-c/2*(1b.3a(1b.3b*t/d)-1)+b},3c:6(t,b,c,d){x c*(t/=d)*t*t*t+b},2j:6(t,b,c,d){x-c*((t=t/d-1)*t*t*t-1)+b},3d:6(t,b,c,d){x((t/=d/2)<1)?(c/2*t*t*t*t+b):(-c/2*((t-=2)*t*t*t-2)+b)}}},2m={2n:6(p,a){8 F=7;p.S=p.E+\'-\'+p.1q,F.1x(p,F.E[p.E].2o,F.1V);6 1r(){F.$(p.1q).L+=\' \'+p.E+\' \'+p.S,F.2p(p)};6 1J(){F.E[p.E](p,F)}9(a){1r(),1J();x}9(2q.2r){(6(){3e{1r()}3f(e){2s(1X.3g,0)}})()}　　P{7.1K(V,\'3h\',1r)}7.1K(2q,\'3i\',1J)},2p:6(p){8 a=[],w=p.X,h=p.M||7.$(p.1q).3j,Y=V.22(\'y\');Y.3k=\'1n/2t\';9(p.1j)7.1j([7.$(p.1q)],p.E+\'3l\');9(p.2t!==G)a.W(\'.\'+p.S+\' *{3m:0;2u:0;3n:0;3o-y:1F;}.\'+p.S+\'{1L:2v;X:\'+w+\'A;M:\'+p.M+\'A;1M:1N;3p:3q/1.5 3r,3s,3t-3u;1n-2w:1O;2x:#2y;}.\'+p.S+\' .1P{1L:3v;z-u:3w;X:N%;M:N%;3x:#3y;1n-2w:2z;2u-3z:\'+0.3*h+\'A;2x:#2y 3A(3B://3C.3D.3E/3F/3G/3H-1P.3I) 2z \'+0.4*h+\'A 3J-3K;}.\'+p.S+\' .3L{1L:2v;X:\'+w+\'A;M:\'+h+\'A;1M:1N;}.\'+p.S+\' .17 B,.\'+p.S+\' .17 B 1C,.\'+p.S+\' .17-3M{X:\'+w+\'A;M:\'+p.1w+\'A!2A;3N-M:\'+p.1w+\'A!2A;1M:1N;}.\'+p.S+\' .17 B p a{1p:3O;}\');9(Y.2B){Y.2B.3P=a.1D(\'\')}P{Y.16=a.1D(\'\')}8 b=7.$$(\'3Q\',V)[0];b.23(Y,b.3R)}},2C={3S:6(a,b,c,d,e){x"8 1d=U,1Q=1d.$c(\'1P\',1e),Q="+c+",R=14,Z="+d+"||\'1O\',1s=Z==\'1O\'||Z==\'3T\'?1f.X:1f.M,1g="+e+"||1g,u=1f.u||0,1t=1f.3U*3V;9(Q){1g.y[Z]=-1s*n+\'A\';u+=n;}9(1Q)1e.3W(1Q);8 I=6(10){("+a+")();8 3X=u;9(Q&&u==2*n-1&&R!=1){1g.y[Z]=-(n-1)*1s+\'A\';u=n-1}9(Q&&u==0&&R!=2){1g.y[Z]=-n*1s+\'A\';u=n}9(!Q&&u==n-1&&10==1c)u=-1;9(Q&&10!==1c&&u>n-1&&!R) 10+=n;8 1h=10!==1c?10:u+1;9("+b+")("+b+")();u=1h;R=G;};I(u);9(1t&&1f.J!==G)8 J=1G(6(){I()},1t);1e.1R=6(){9(J)1a(J)};1e.1S=6(){9(J)J=1G(6(){I()},1t)};D(8 i=0,1T=1d.$$(\'a\',1e),2D=1T.K;i<2D;i++) 1T[i].3Y=6(){7.3Z();}"},40:6(a,b,c){x"D (8 j=0;j<n;j++){"+a+"[j].u=j;9("+b+"==\'1W\'){"+a+"[j].1R=6(){9(7.u!=u)7.L+=\' 2E\'};"+a+"[j].1S=6(){1d.2b(7,\'2E\')};"+a+"[j].1u=6(){9(7.u!=u) {I(7.u);x G}};}P 9("+b+"==\'41\'){"+a+"[j].1R=6(){8 1i=7;9("+c+"==0){9(1i.u!=u){I(1i.u);x G}}P "+a+".d=2s(6(){9(1i.u!=u) {I(1i.u);x G}},"+c+")};"+a+"[j].1S=6(){42("+a+".d)};}P{43(\'44 45 : \\"\'+"+b+"+\'\\"\');21;}}"},46:6(a,b,c){x"8 1v=G;"+a+".1u=6(){7.L=7.L==\'"+b+"\'?\'"+c+"\':\'"+b+"\';9(!1v){1a(J);J=28;1v=14;}P{J=14;1v=G;}}"},47:6(a,b,c,d,e){x"8 11={},T="+c+",2F=1b.2k("+d+"/2),2G=48("+a+".y["+b+"])||0,12=1h>=n?1h-n:1h,2H="+e+"||1H,2I=T*(n-"+d+"),1U=T*12+2G;9(1U>T*2F&&12!==n-1) 11["+b+"]=\'-\'+T;9(1U<T&&12!==0) 11["+b+"]=\'+\'+T;9(12===n-1) 11["+b+"]=-2I;9(12===0) 11["+b+"]=0;1d.2l("+a+",11,2H);"},49:6(a,b){x a+".1u=6(){R=1;I(u>0?u-1:n-1);};"+b+".1u=6(){R=2;8 2J=u>=2*n-1?n-1:u;I(u==n-1&&!Q?0:2J+1);}"},4a:6(o,a,b){8 c=7.$$(\'C\',o)[0];c.18=b?c.18.15(2c("/"+a+"\\\\.(?=[^\\\\.]+$)/g"),\'.\'):c.18.15(/\\.(?=[^\\.]+$)/g,a+\'.\')},1K:6(a,c,d){8 b=!(+[1,]),e=b?\'2r\':\'4b\',t=(b?\'4c\':\'\')+c;a[e](t,d,G)}};U.1x(U,q,27,2d,2m,2C);U.2n.4d=6(a,p){U.E[a].2o=p}})();',62,262,'||||||function|this|var|if|||||||||||||||||||||index|||return|style||px|li|img|for|pattern||false|opacity|run|auto|length|className|height|100|ul|else|less|_turn||scDis|myFocus|document|push|width|oStyle|_dir|idx|scPar|scIdx||true|replace|innerHTML|txt|src|Timer|clearInterval|Math|undefined|_F|box|par|pics|next|self|wrap|parent|in|reg|text|animate|display|id|ready|_dis|_t|onclick|_stop|txtHeight|extend|_|new|arr|num|span|join|pv|none|setInterval|400|linear|show|addEvent|position|overflow|hidden|left|loading|_ld|onmouseover|onmouseout|_lk|scD|defConfig|click|arguments|typeof|string|parentNode|break|createElement|insertBefore|class|getAttribute|thumb|CSS|null|isNaN|setOpa|removeClass|eval|Anim|am|st|Date|getTime|easing|easeOut|floor|slide|Init|set|cfg|initCSS|window|attachEvent|setTimeout|css|padding|relative|align|background|fff|center|important|styleSheet|Method|_ln|hover|scN|scDir|scDur|scMax|tIdx|trigger|default|delay|getElementById|getElementsByTagName|RegExp|test|div|appendChild|wrapIn|addList|alt|getComputedStyle|currentStyle|parseFloat|filter|alpha|block|800|ceil|call|fadeIn|fadeOut|stop|indexOf|swing|cos|PI|easeIn|easeInOut|try|catch|callee|DOMContentLoaded|load|offsetHeight|type|_wrap|margin|border|list|font|12px|Verdana|Geneva|sans|serif|absolute|9999|color|666|top|url|http|nethd|zhongsou|com|wtimg|i_41956|28236|gif|no|repeat|pic|bg|line|inline|cssText|head|firstChild|switchMF|right|time|1000|removeChild|prev|onfocus|blur|bind|mouseover|clearTimeout|alert|Error|Setting|toggle|scroll|parseInt|turn|alterSRC|addEventListener|on|params'.split('|'),0,{}))