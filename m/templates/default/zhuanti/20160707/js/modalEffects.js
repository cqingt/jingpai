/**
 * modalEffects.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Codrops
 * http://www.codrops.com
 */
var ModalEffects = (function() {

	function init() {

		var overlay = document.querySelector( '.md-overlay' );

		[].slice.call( document.querySelectorAll( '.md-trigger' ) ).forEach( function( el, i ) {
			var modal = document.querySelector( '#' + el.getAttribute( 'data-modal' ) ),
				close = modal.querySelector( '.md-close' );
			
			function removeModal( hasPerspective ) {
				classie.remove( modal, 'md-show' );

				if( hasPerspective ) {
					classie.remove( document.documentElement, 'md-perspective' );
				}
			}

			function removeModalHandler() {
				removeModal( classie.has( el, 'md-setperspective' ) ); 
			}

			el.addEventListener( 'click', function( ev ) {
				
				classie.add( modal, 'md-show' );
				overlay.removeEventListener( 'click', removeModalHandler );
				overlay.addEventListener( 'click', removeModalHandler );

				if( classie.has( el, 'md-setperspective' ) ) {
					setTimeout( function() {
						classie.add( document.documentElement, 'md-perspective' );
					}, 25 );
				}
			});

			close.addEventListener( 'click', function( ev ) {
				ev.stopPropagation();
				removeModalHandler();
			});

		} );

	}

	init();

})();


function modal_8(){
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=ad_20160707",
		data:{action:'modal-8'},
		dataType:'json',
		success:function(result){
			if(result.state){
				 window.location.href="index.php?act=zhuanti&op=ad_20160707_bnt";
			}else{
				if(result.msg == -1){
					$("#df_clearfix").html("<h5>玩古 · 藏今 · <strong>登录</strong>即阅天下</h5><h5>派奖时以您注册的手机号为准</h5>");
					$("#modal-from1").addClass('md-show');
				}
				if(result.msg == -2){
					$("#modal-8").addClass('md-show');
				}
				if(result.msg == -3){
					alert("您已参加");
				}
			}
		}
	}); 
}

function modal_shop1(id){
	if(id == '' ){
		return false;
	}
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=ad_20160707",
		data:{action:'modal-shop',id:id},
		dataType:'json',
		success:function(result){
			if(result.state){
				 $("#modal-shop1").html(result.msg);
				 $("#modal-shop1").addClass('md-show');
				$("#sliderA").excoloSlider();
			}else{
				return false;
			}
		}
	}); 
}
