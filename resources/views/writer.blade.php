<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Author | Modern Fount</title>
		<meta name="HandheldFriendly" content="True">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@500&amp;family=Spartan:wght@500;600;700&amp;display=swap" rel="stylesheet">
		<link href="{{ asset('css/cover.css') }}" rel="stylesheet">
    <meta name="description" content="Dici enim nihil potest verius. Sed ne, dum huic obsequor, vobis molestus sim. Iam id ipsum absurdum, maximum malum neglegi. Tecum optime, deinde etiam cum mediocri amico." />
    <link rel="canonical" href="index.html" />
    <meta name="referrer" content="no-referrer-when-downgrade" />
    <link rel="next" href="page/2/index.html" />
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <script defer src="../../public/members.min93e2.js?v=8a67789b6a"></script>
    <meta name="generator" content="Ghost 3.22" />
    <link rel="alternate" type="application/rss+xml" title="Renge" href="../../rss/index.html" />
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
		<main class="global-main">
					@php
					$author=App\Http\Controllers\Api\AuthorController::getAuthorByAuthorId($id);
					$user=$author['user_id'];
					$path=$user . 'profilepic.jpg';
					@endphp
					<div class="archive-section">
						<div class="archive-image global-image">
							<img src="{{asset('images/').'/'.$path}}" alt="">

						</div>
						<h1 class="archive-title">{{$author['name']}}</h1>
						<span class="archive-details">{{$author['posts']}} posts</span>
						<div class="social-icon">
							@if($author['fb_link']==null)
								@else
								<a href="{{$author['fb_link']}}" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
							@endif
							@if($author['tweet_link']==null)
								@else
								<a href="{{$author['tweet_link']}}" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
							@endif
							@if($author['insta_link']==null)
								@else
								<a href="{{$author['insta_link']}}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
							@endif



						</div>
						<p class="archive-description">{{$author['about']}}</p>
					</div>
					@php
					$articles=App\Http\Controllers\Api\ArticleController::getArticleById($id);
					$count=0;
					@endphp
					<div class="loop-section">
						<div class="loop-wrap">
							<article class="item is-hero is-first is-image post tag-story tag-art tag-creative tag-hash-post-raspberry tag-hash-dark-version tag-hash-details-amethyst">
								<div class="item-container global-color">
									@php
									$id=$articles[0]['id'];
									$path=$id . 'coverpic.jpg';
									@endphp
									<a href="#" class="item-image global-image global-color">
										<img sizes="(max-width:480px) 240px, (max-width:768px) 200px, (max-width:1024px) 290px, 350px"
										src="{{asset('images/').'/'.$path}}" alt="">
									</a>
									<div class="item-content">
															<div class="global-meta">
											<time datetime="2020-03-05">Published on @php $date=$articles[0]['created_at'];
											echo date_format($date,"d F, Y"); @endphp</time>
											by
											<a href="#">{{$articles[0]['author']}}</a>
											<span class="global-reading">
												— {{$articles[0]['read_time']}} min read
											</span>
										</div>
										<h2 class="item-title">
										<a href="{{ URL::route('articledisplay' , $articles[0]['id'])}}" class="global-underline">{{$articles[0]['title']}}</a>
										</h2>
										<p class="item-excerpt">
											{{$articles[0]['byline']}}
										</p>
										<div class="global-tags">
											@foreach($articles[0]['tags'] as $tag)
											 <a href="{{ URL::route('tagdisplay' , $tag['name'])}}" class="global-tags-hash-sign">{{$tag['name']}}</a>
											 @endforeach
										</div>
									</div>
								</div>
							</article>
							@foreach($articles as $article)

							@php $count++; @endphp
							@if($count>1)
							<article class="item is-even is-image post tag-story tag-illustration tag-hash-post-apricot featured">
								<div class="item-container">
													<div class="item-content">
														@php
														$id=$article['id'];
														$path=$id . 'coverpic.jpg';
														@endphp
										<a href="#" class="item-image global-image global-color">
											<img src="{{asset('images/').'/'.$path}}" alt="">

										</a>
										<h2 class="item-title">
										<a href="{{ URL::route('articledisplay' , $article['id'])}}" class="global-underline">{{$article['title']}}</a>
										</h2>
										<div class="global-meta">
											<a href="#">{{$article['author']}}</a>
											<span class="global-reading">
												— {{$article['read_time']}} min read
											</span>
										</div>
										<p class="item-excerpt">
											{{$article['byline']}}
										</p>
										<div class="global-tags">
											@foreach($article['tags'] as $tag)
											 <a href="{{ URL::route('tagdisplay' , $tag['name'])}}" class="global-tags-hash-sign">{{$tag['name']}}</a>
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

		<script src="../../assets/js/global93e2.js?v=8a67789b6a"></script>
		<script>var numberPaged = 2;</script>
		<script src="../../assets/js/index93e2.js?v=8a67789b6a"></script>
		<script>
const searchPublished = 'Published',
	  searchUrl = '../../index.html',
	  searchKey = "867648796ce449e62afff6ff8a",
	  searchAPI = searchUrl+'/ghost/api/v3/content/posts/?key='+searchKey+'&limit=all&formats=plaintext&fields=url,title,published_at,excerpt,plaintext,visibility';
</script>

		<script>

function getParameterByName(e,n){n||(n=window.location.href),e=e.replace(/[\[\]]/g,"\\$&");var r=new RegExp("[?&]"+e+"(=([^&#]*)|&|#|$)").exec(n);return r?r[2]?decodeURIComponent(r[2].replace(/\+/g," ")):"":null}

const action=getParameterByName("action"),stripe=getParameterByName("stripe"),body=document.body;"subscribe"==action&&body.classList.add("global-notification-subscribe"),"signin"==action&&body.classList.add("global-notification-signin"),"signup"==action&&body.classList.add("global-notification-signup"),"success"==stripe&&body.classList.add("global-notification-success");
</script>



	</body>

</html>
