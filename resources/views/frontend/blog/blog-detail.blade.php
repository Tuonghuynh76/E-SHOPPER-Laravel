@extends('frontend.layouts.app')
@section('content')
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						<div class="single-blog-post">
							<h3>{{$detail[0]->title}}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i>{{ $detail[0]->created_at->format('H:i A') }}</li>
									<li><i class="fa fa-calendar"></i>{{ $detail[0]->created_at->format('M j, Y') }}</li>
								</ul>
								<!-- <span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</span> -->

								<div class="rate">
                					<div id="{{$detail[0]->id}}" class="vote">
                    					<div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                    					<div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                    					<div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                    					<div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                    					<div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                    					<span class="rate-np">{{$result}} <i class="fa fa-star"></i></span>
               						</div> 
            					</div>

							</div>
							<a href="">
								<img src="{{URL::to('/upload/blog/image/'.$detail[0]['image']) }} " alt="">
							</a>
							<p>{{ $detail[0]->description }}</p> <br>
							<p>{{ $detail[0]->content }}</p>
							<div class="pager-area">
								<ul class="pager pull-right">
									<?php
										if(!empty($prev)){
									?>
										<li><a href="{{url('frontend/blog-list/detail/'. $prev[0]['id']) }}">Pre</a></li>
									<?php
										}
									?>
									<?php
										if(!empty($next)){
									?>
										<li><a href="{{url('frontend/blog-list/detail/'. $next[0]['id']) }}">Next</a></li>
									<?php
										}
									?>
								</ul>
							</div>
						</div>
					</div><!--/blog-post-area-->

					<div class="rating-area">
						<ul class="ratings">
							<li class="rate-this">Rate this item:</li>
							<li>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</li>
							<li class="color">(6 votes)</li>
						</ul>

						<ul class="tag">
							<li>TAG:</li>
							<li><a class="color" href="">Pink <span>/</span></a></li>
							<li><a class="color" href="">T-Shirt <span>/</span></a></li>
							<li><a class="color" href="">Girls</a></li>
						</ul>
					</div><!--/rating-area-->

					<div class="socials-share">
						<a href=""><img src="{{asset('frontend/images/blog/socials.png')}}" alt=""></a>
					</div><!--/socials-share-->

					<!-- <div class="media commnets">
						<a class="pull-left" href="#">
							<img class="media-object" src="images/blog/man-one.jpg" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Annie Davis</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							<div class="blog-socials">
								<ul>
									<li><a href=""><i class="fa fa-facebook"></i></a></li>
									<li><a href=""><i class="fa fa-twitter"></i></a></li>
									<li><a href=""><i class="fa fa-dribbble"></i></a></li>
									<li><a href=""><i class="fa fa-google-plus"></i></a></li>
								</ul>
								<a class="btn btn-primary" href="">Other Posts</a>
							</div>
						</div>
					</div> --><!--Comments-->
					<div class="response-area">
						<h2>3 RESPONSES</h2>
						<button class="btn btn-primary" id="toggleButton">Comment</button>
						<ul class="media-list">
							<?php 
								if(!empty($comment))
								{
									foreach($comment as $key => $value) {
										if($value['level'] == 0) {
							?>
							<li class="media">
								<a class="pull-left" href="#">
									<img style="width: 121px; height: 86px;" class="media-object" src="{{URL::to('/upload/user/avatar/'. $value['avatar']) }} " alt="avatar">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>{{ $value['name'] }}</li>
										<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
										<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
									</ul>
									<p>{{ $value['comment'] }}</p>
									<a id="reply" class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
									<input type="hidden" class="idcmt" name="level" value="{{ $value['id'] }}">

								</div>
							</li>
							<?php 
									}
									foreach ($comment as $key2 => $value2) {
										if($value['id'] == $value2['level']) {
							?>
							<li class="media second-media">
								<a class="pull-left" href="#">
									<img style="width: 121px; height: 86px;" class="media-object" src="{{URL::to('/upload/user/avatar/'. $value2['avatar']) }} " alt="avatar">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>{{ $value2['name'] }}</li>
										<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
										<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
									</ul>
									<p>{{ $value2['comment'] }}</p>
									<a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
								</div>
							</li>
							<?php 
										}
									}
								} 
							}
							?>
						</ul>					
					</div><!--/Response-area-->
					<div class="replay-box">
						<div class="row">
							<div class="col-sm-12">
								<h2>Leave a replay</h2>
								<div id="myForm" style="display: none" class="text-area">
									<div class="blank-arrow">
									</div>
									<label class="name">Your Name</label>
									<span>*</span>
									<textarea class="cmt" id="{{ $detail[0]->id }}" name="message" rows="11"></textarea>
									<a id="submit_form" class="btn btn-primary" href="">post comment</a>
								</div>
							</div>
						</div>
					</div><!--/Repaly Box-->
     <script>
    	$(document).ready(function(){
    		$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            function submitComment(id_user, cmt, id_blog, level) {
			    $.ajax({
			        type: 'POST',
			        url: "{{url('/frontend/blog-list/detail/comment')}}",
			        data: {
			            id_user: id_user,
			            comment: cmt,
			            id_blog: id_blog,
			            level: level,
			        },
			        success: function(data) {
			            console.log(data);
			        },
			        error: function(error) {
			            console.error("Error submitting comment:", error);
			        }
			    });
			}
    		$("#toggleButton").click(function(){
    			var checkLogin = '{{Auth::check()}}';
    			if(checkLogin) {
    				var user = {!! json_encode(Auth::user()) !!};
        			$("#myForm").toggle();
        			$("html, body").scrollTop($("#myForm").offset().top);

					if (user && user.name) {
						$('label.name').text(user.name);
					}
        		} else {
        			alert('Vui long login');
        		}
    		});
    		//comment
			$(document).on('click', '#reply', function(e) {
            	e.preventDefault();
				var login = "{{Auth::check()}}";
				if(login) {
    				var user = {!! json_encode(Auth::user()) !!};
    				if(user && user.name) {
		            	var html = '<div id="reply_cmt" class="text-area">' +
		            					'<div style="background: #FE980F; color: #FFFFFF; margin-bottom: 15px; padding: 3px 15px; float: left; font-weight: 400" class="blank-arrow">' +
										'<label>'+ user.name +'</label>' +
										'</div>' +
										'<span style="color: #FE980F; float: right; font-weight: 700; margin-top: 21px">*</span>' +
										'<textarea class="cmt" id="{{ $detail[0]->id }}" name="message" rows="11"></textarea>' +
										'<a id="submit_reply" class="btn btn-primary" href="">post comment</a>' +
									'</div>';
						$(this).after(html);
					}
					$('a#submit_reply').click(function(e){
		            	e.preventDefault();
							var cmt = $(this).closest('div#reply_cmt').find('.cmt').val();
							var idReply = $(this).closest('div.media-body').find('input.idcmt').val();
							var id_blog = $(this).closest('#reply_cmt').find('.cmt').attr('id');
							var id_user = "{{Auth::id()}}";
							submitComment(id_user, cmt, id_blog, idReply);
					});
				} else {
						alert('vui long login!');
					}
        	});

            $('a#submit_form').click(function(e){
            	e.preventDefault();
				var check = "{{Auth::check()}}";
				if(check) {
					var cmt = $('.cmt').val();
					var id_blog = $(this).closest('#myForm').find('.cmt').attr('id');
					var id_user = "{{Auth::id()}}";
					var level = 0;
					submitComment(id_user, cmt, id_blog, level);
				} else {
					alert('vui long login!');
				}
			});

			//vote
			$('.ratings_stars').hover(
	            // Handles the mouseover
	            function() {
	                $(this).prevAll().andSelf().addClass('ratings_hover');
	                // $(this).nextAll().removeClass('ratings_vote'); 
	            },
	            function() {
	                $(this).prevAll().andSelf().removeClass('ratings_hover');
	                // set_votes($(this).parent());
	            }
	        );
			$('.ratings_stars').click(function(){
				var checkLogin = "{{Auth::Check()}}";
				if(checkLogin) {
					var id_user = "{{Auth::id()}}";
					var id_blog = $(this).closest(".vote").attr('id');
					var rate =  $(this).find("input").val();
		        	// alert(Values);
		    		if ($(this).hasClass('ratings_over')) {
		            	$('.ratings_stars').removeClass('ratings_over');
		            	$(this).prevAll().andSelf().addClass('ratings_over');
		        	} else {
		        		$(this).prevAll().andSelf().addClass('ratings_over');
		        	}

		        	$.ajax({
		        		type: 'POST',
		        		url: "{{url('/frontend/blog-list/detail/rate')}}",
		        		data:{
		        			id_user: id_user,
		        			rate: rate,
		        			id_blog: id_blog,
		        		},
		        		success:function(data){
		        			console.log(data);
		        		}
		        	});
		        	alert('Đánh giá thành công');
		    	} else {
		    		alert('Vui lòng login để rate'); 
		    	}
		    });
		});
    </script>
@endsection
