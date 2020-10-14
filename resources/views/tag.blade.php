<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Tag | Modern Fount</title>
		<meta name="HandheldFriendly" content="True">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@500&amp;family=Spartan:wght@500;600;700&amp;display=swap" rel="stylesheet">
        <link href="{{ asset('css/cover.css') }}" rel="stylesheet">
        <link rel="canonical" href="index.html" />
				<link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script defer src="../../public/members.min93e2.js?v=8a67789b6a"></script>
    <link rel="alternate" type="application/rss+xml" title="Renge" href="../../rss/index.html" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body class=" global-hash-dark-version global-hash-details-amethyst global-hash-post-amber global-hash-post-apricot global-hash-post-aqua global-hash-post-coral global-hash-post-cream global-hash-post-green global-hash-post-purple global-hash-post-raspberry global-hash-post-sky">
		<div class="global-wrap">
			<div class="global-content">
				<header class="header-section">
					 <div class="header-wrap">
							<div class="header-logo">
								 <h1 class="is-image"><a href="{{ url('/')}}"><img src="{{ asset('images/mf_white.png') }}" alt="MF"></a></h1>
							</div>
							<div class="header-nav">
								 <input id="toggle" class="header-checkbox" type="checkbox">
								 <label class="header-toggle" for="toggle">
								 <span>
								 <span class="bar"></span>
								 <span class="bar"></span>
								 <span class="bar"></span>
								 </span>
								 </label>
								 <nav>
										<ul>
											 <li><a href="{{ url('/')}}">Home</a></li>
											 <li><a href="{{ url('/authors')}}">Authors</a></li>
											 <li><a href="{{ url('/tags')}}" >Tags</a></li>
											 <li><a href="{{ url('/article')}}" >Articles</a></li>
										</ul>
										<ul>
											 @auth
												 <li> <a href="{{ url('/signin')}}"> {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}} </a> </li>
												 <li>
													 <a class="dropdown-item" href="{{ route('logout') }}"
														 onclick="event.preventDefault();
																					 document.getElementById('logout-form').submit();">
															{{ __('Logout') }}
													</a>
													<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
															@csrf
													</form>
												 </li>
											 @else
												 <li class="signin"><a href="{{ url('/signin')}}">Sign in</a></li>
											 @endauth
										</ul>
								 </nav>
							</div>
					 </div>
				</header>
				@php
						$tags=App\Http\Controllers\Api\TagController::getArticleByTag($name);
						$posts=App\Http\Controllers\Api\TagController::postTagsCount($name);
						$count=0;
				@endphp
<main class="global-main">
					<div class="archive-section">
	<div class="archive-image global-image">
		<div class="hash-img">
			<img src="{{ asset('images/hash.png') }}" alt="hash">
		</div>
	</div>
	<h1 class="archive-title is-tag">{{$name}}</h1>
	<span class="archive-details">{{$posts[0]['posts']}} posts</span>
</div>
<div class="loop-section">
	<div class="loop-wrap">
		<article class="item is-hero is-first is-image post tag-story tag-art tag-creative tag-hash-post-raspberry tag-hash-dark-version tag-hash-details-amethyst">
			@php
			$id=$tags[0]['id'];
			$path=$id . 'coverpic.jpg';
			@endphp
			<div class="item-container global-color">
				<a href="#" class="item-image global-image global-color">
					<img sizes="(max-width:480px) 240px, (max-width:768px) 200px, (max-width:1024px) 290px, 350px"
	 					src="{{asset('images/').'/'.$path}}"
	 					alt="">

				</a>
				<div class="item-content">
										<div class="global-meta">
						<time>Published on @php $date=$tags[0]['created_at'];
						echo date_format($date,"d F, Y"); @endphp</time>
						by
						<a href="{{ URL::route('authordetail' , $tags[0]['author_id'])}}">{{$tags[0]['author']}}</a>
						<span class="global-reading">
							— {{$tags[0]['read_time']}} min read
						</span>
					</div>
					<h2 class="item-title">
					<a href="{{ URL::route('articledisplay' , $tags[0]['id'])}}" class="global-underline">{{$tags[0]['title']}}</a>
					</h2>
					<p class="item-excerpt">
						{{$tags[0]['byline']}}
					<div class="global-tags">
						@foreach($tags[0]['tags'] as $tag)
						 <a href="{{ URL::route('tagdisplay' , $tag)}}" class="global-tags-hash-sign">{{$tag}}</a>
						 @endforeach
					</div>
				</div>
			</div>
		</article>
		@foreach($tags as $article)
		@php $count++; @endphp
		@if($count>1)
		<article class="item is-even is-image post tag-story tag-hash-post-cream tag-art">
			@php
			$id=$article['id'];
			$path=$id . 'coverpic.jpg';
			@endphp
			<div class="item-container">
								<div class="item-content">
					<a href="#" class="item-image global-image global-color">
						<img src="{{asset('images/').'/'.$path}}" alt="Look at life with the eyes of a child">

					</a>
					<h2 class="item-title">
					<a href="{{ URL::route('articledisplay' , $article['id'])}}" class="global-underline">{{$article['title']}}</a>
					</h2>
					<div class="global-meta">
						<a href="{{ URL::route('authordetail' , $article['author_id'])}}">{{$article['author']}}</a>
						<span class="global-reading">
							— {{$article['read_time']}} min read
						</span>
					</div>
					<p class="item-excerpt">
						{{$article['byline']}}
					</p>
					<div class="global-tags">
						@foreach($article['tags'] as $tag)
						 <a href="{{ URL::route('tagdisplay' , $tag)}}" class="global-tags-hash-sign">{{$tag}}</a>
						 @endforeach
					</div>
				</div>
			</div>
		</article>
		@endif
		@endforeach
	</div>
</div>
				</main>
				<footer class="footer-section global-footer">
				   <div class="footer-wrap">
				      <div class="footer-data">
				        <p class="footer-description"></p>
				          <br>
				          <a href="mailto:piyush0406@protonmail.com"><p class="footer-description">piyush0406@protonmail.com</p></a>
				      <div class="footer-icons">
				        <a href="https://www.facebook.com/pshroy/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
				        <a href="https://twitter.com/pshroy" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
				        <a href="https://github.com/piyush0406" target="_blank"><i class="fa fa-github" aria-hidden="true"></i></a>
				        <a href="https://www.linkedin.com/in/piyush0402/" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
				      </div>
				      </div>
				      <div class="footer-nav ml-auto">
				         <div class="footer-nav-column">
				            <ul>
				               <li><a href="{{ url('/')}}">Home</a></li>
				               <li><a href="{{ url('/authors')}}">Authors</a></li>
				               <li><a href="{{ url('/tags')}}">Tags</a></li>
				               <li><a href="{{ url('/article')}}">Articles</a></li>
				            </ul>
				         </div>
				      </div>
				   </div>
				   <div class="footer-copyright">
				      &copy;<strong>Piyush</strong>
				   </div>
				</footer>
</div>
		</div>
		<div class="notifications-section">
	<div class="global-notification subscribe">
		You’ve successfully subscribed to Renge
	</div>
	<div class="global-notification signin">
		Welcome back! You’ve successfully signed in.
	</div>
	<div class="global-notification signup">
		Great! You’ve successfully signed up.
	</div>
	<div class="global-notification success">
		Success! Your account is fully activated, you now have access to all content.
	</div>
</div>

		<div id="search-section" class="search-section">
	<span id="search-close" class="search-close"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 8.242L20.242 0 24 3.76 15.758 12 24 20.242 20.242 24 12 15.758 3.759 24 0 20.242 8.242 12 0 3.759 3.76 0 12 8.242z"/></svg></span>
	<div id="search-content" class="search-content">
		<form class="search-form" onsubmit="return false">
			<input id="search-input" type="text" placeholder="Type your keywords">
			<div class="search-meta">
				<span id="search-info">Please enter at least 3 characters</span>
				<span id="search-counter" class="is-hide">
					<span id="search-counter-results">0</span>
				Results for your search</span>
			</div>
		</form>
		<div id="search-results" class="search-results"></div>
	</div>
	<div id="search-overlay" class="search-overlay"></div>
</div>

		<script src="../../assets/js/global93e2.js?v=8a67789b6a"></script>
		<script>var numberPaged = 1;</script>
		<script src="../../assets/js/index93e2.js?v=8a67789b6a"></script>
		<script>
const searchPublished = 'Published',
	  searchUrl = '../../index.html',
	  searchKey = "867648796ce449e62afff6ff8a",
	  searchAPI = searchUrl+'/ghost/api/v3/content/posts/?key='+searchKey+'&limit=all&formats=plaintext&fields=url,title,published_at,excerpt,plaintext,visibility';
</script>

		<script>
/* Notifications
   ––––––––––––––––––––––––––––––––––––––––––––––––––––
   Website : ghost.org
   Repo    : github.com/tryghost
   Author  : Ghost
   License : MIT
   –––––––––––––––––––––––––––––––––––––––––––––––––––– */
function getParameterByName(e,n){n||(n=window.location.href),e=e.replace(/[\[\]]/g,"\\$&");var r=new RegExp("[?&]"+e+"(=([^&#]*)|&|#|$)").exec(n);return r?r[2]?decodeURIComponent(r[2].replace(/\+/g," ")):"":null}

/* Custom settings for notifications */
const action=getParameterByName("action"),stripe=getParameterByName("stripe"),body=document.body;"subscribe"==action&&body.classList.add("global-notification-subscribe"),"signin"==action&&body.classList.add("global-notification-signin"),"signup"==action&&body.classList.add("global-notification-signup"),"success"==stripe&&body.classList.add("global-notification-success");
</script>



	</body>

<!-- Mirrored from renge-dark.fueko.net/tag/art/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Aug 2020 12:23:05 GMT -->
</html>
