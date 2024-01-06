@extends('frontend.layouts.app')
@section('content')
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						@foreach($getBlog as $key => $value)
						<div class="single-blog-post">
							<h3>{{$value['title']}}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i>{{$value['created_at']->format('H:i A')}}</li>
									<li><i class="fa fa-calendar"></i> {{ $value['created_at']->format('M j, Y')}}</li>
								</ul>
								<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
								</span>
							</div>
							<a href="{{ url('frontend/blog-list/detail/'.$value['id'])}}">
								<img src="{{URL::to('/upload/blog/image/'.$value['image']) }} " alt="">
							</a>
							<p>{{$value['description']}}</p>
							<a class="btn btn-primary" href="{{ url('frontend/blog-list/detail/'.$value['id'])}}">Read More</a>
						</div>
						@endforeach
                             <div style="float: right; margin-right: 10px;">
                                    {{ $getBlog->links('pagination::simple-bootstrap-4', ['onEachSide' => 2]) }}

                            </div>

					</div>
				<!-- </div> -->
@endsection