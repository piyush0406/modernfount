<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<title>Article | News Room</title>
				<meta name="HandheldFriendly" content="True">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@500&amp;family=Spartan:wght@500;600;700&amp;display=swap" rel="stylesheet">
		        <link href="https://fonts.googleapis.com/css2?family=Muli:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet">
		        <link href="{{ asset('css/cover.css') }}" rel="stylesheet">
				<link rel="canonical" href="index.html" />
    		<script type="application/ld+json">
    		</script>
    	<script defer src="../public/members.min93e2.js?v=8a67789b6a"></script>
    	<link rel="alternate" type="application/rss+xml" title="Renge" href="../rss/index.html" />
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
	<body class=" global-hash-dark-version global-hash-details-amethyst global-hash-post-amber global-hash-post-apricot global-hash-post-aqua global-hash-post-coral global-hash-post-cream global-hash-post-green global-hash-post-purple global-hash-post-raspberry global-hash-post-sky">
		<div class="global-wrap">
			<div class="global-content">
			<header class="header-section">
				 <div class="header-wrap">
						<div class="header-logo">
							 <h1 class="is-image"><a href="{{ url('/')}}"><img src="{{ asset('images/contree1.png') }}" alt="Newsroom"></a></h1>
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
										 @else
											 <li class="signin"><a href="{{ url('/signin')}}">Sign in</a></li>
										 @endauth
									</ul>
							 </nav>
						</div>
				 </div>
			</header>
						<main class="global-main">
							@php $path=$id . 'coverpic.jpg'; @endphp
					<progress class="post-progress"></progress>
					<article class="post-section">
					<div class="post-header item is-hero is-first is-image post tag-story tag-art tag-creative tag-hash-post-raspberry tag-hash-dark-version tag-hash-details-amethyst">
						<div class="item-container global-color">
							<div class="item-image global-image global-color">
								<img sizes="(max-width:480px) 240px, (max-width:768px) 200px, (max-width:1024px) 290px, 350px"
						 src="{{asset('images/').'/'.$path}}"
						 alt="">
							</div>
							@php
									$article=App\Http\Controllers\Api\ArticleController::getArticleByArticleId($id);
									$tags=App\Http\Controllers\Api\TagController::getTagsByArticleId($id);
							@endphp
							<div class="item-content">
								<div class="item-meta global-meta">
									<time>Published on @php $date=$article['created_at'];
									echo date_format($date,"d F, Y"); @endphp</time>
									by
									<a href="{{ URL::route('authordetail' , $article['author_id'])}}">{{$article['author']}}</a>
									<span class="global-reading">
										— {{$article['read_time']}} min read
									</span>
								</div>
								<h2 class="item-title">{{$article['title']}}</h2>
								<p class="item-excerpt">
									{{$article['byline']}}
								</p>
								<div class="item-tags global-tags">
									@foreach($tags as $tag)
									 <a href="{{ URL::route('tagdisplay' , $tag['name'])}}" class="global-tags-hash-sign">{{$tag['name']}}</a>
									 @endforeach
								</div>
							</div>
						</div>
					</div>
					<div class="post-content">
							@php echo $article['content'] @endphp
							<!-- <div class="kg-gallery-container">
								<div class="kg-gallery-row">
									<div class="kg-gallery-image">
										<img src="../content/images/2020/06/luis-cortes-3ZkIm8Q5hsk-unsplash.jpg" width="2000" height="3000" alt sizes="(min-width: 720px) 720px">
									</div>
									<div class="kg-gallery-image">
											<img src="../content/images/2020/06/mike-petrucci-kbhB_TFbnUA-unsplash.jpg" width="2000" height="1333" alt sizes="(min-width: 720px) 720px">
										</div>
									</div>
								</div>
						<figure class="kg-card kg-bookmark-card">
							<a class="kg-bookmark-container" href="https://unsplash.com/photos/fsUjojQV_Yg">
							<div class="kg-bookmark-content">
								<div class="kg-bookmark-title">Photo by Luis Cortés on Unsplash</div>
								<div class="kg-bookmark-description">silver iphone 6 on brown wooden table</div>
								<div class="kg-bookmark-metadata"><img class="kg-bookmark-icon" src="../../unsplash.com/apple-touch-icon.png">
									<span class="kg-bookmark-author">Luis Cortés</span>
							<span class="kg-bookmark-publisher">Unsplash</span>
						</div>
					</div>
					<div class="kg-bookmark-thumbnail">
						<img src="https://images.unsplash.com/photo-1592950630581-03cb41342cc5?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjEyMDd9">
					</div>
				</a>
			</figure>-->
				</div>
					</article>
				</main>
				<footer class="footer-section global-footer">
					 <div class="footer-wrap">
							<div class="footer-data">
								<p class="footer-description">
									<b>Contact Us</b>
									<br>E-111/112 Durga Park, Ambabari,
									<br>Vidyadhar Nagar, Jaipur,
									<br>Rajasthan 302039</p>
									<br>
									<a href="mailto:rohit@contree.in"><p class="footer-description">rohit@contree.in</p></a>
									<a href="tel:8949032828"><p class="footer-description">+91-8949032828</p></a>

							<div class="footer-icons">
								<a href="https://www.facebook.com/letscontree/" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
								<a href="https://twitter.com/letuscontree" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
								<a href="https://www.instagram.com/letscontree/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
								<a href="https://www.youtube.com/channel/UCDLp_Jf6cIxczsGn3CtOQWQ" target="_blank"><i class="fa fa-youtube-square" aria-hidden="true"></i></a>
							</div>
							</div>
							<div class="footer-nav ml-auto">
								<div class="footer-nav-column">
									 <ul>
											<li><a href="{{ url('https://contree.in/Event/List')}}" target="_blank" >Events</a></li>
											<li><a href="{{ url('https://contree.in/Organization/List')}}" target="_blank">Organizations</a></li>
											<li><a href="{{ url('https://contree.in/Home/About')}}" target="_blank">About</a></li>
											<li><a href="{{ url('https://contree.in/Home/Media')}}" target="_blank">Media Coverage</a></li>
									 </ul>
								</div>
								<div class="footer-nav-column">
									 <ul>
											<li><a href="{{ url('https://contree.in/Pages/FAQ')}}" target="_blank" >FAQ</a></li>
											<li><a href="{{ url('https://contree.in/Pages/TermsAndConditions')}}" target="_blank">T&C</a></li>
											<li><a href="{{ url('https://contree.in/Pages/PrivacyPolicy')}}" target="_blank">Privacy Policy</a></li>
									 </ul>
								</div>
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
							Contree Management Services Pvt. Ltd &copy; 2020. Made By <strong>Delta WebWorks</strong>.
					 </div>
				</footer>
	</div>
		</div>
		<script src="../assets/js/global93e2.js?v=8a67789b6a"></script>
		<script src="../assets/js/post93e2.js?v=8a67789b6a"></script>
		<script>
const searchPublished = 'Published',
	  searchUrl = '../index.html',
	  searchKey = "867648796ce449e62afff6ff8a",
	  searchAPI = searchUrl+'/ghost/api/v3/content/posts/?key='+searchKey+'&limit=all&formats=plaintext&fields=url,title,published_at,excerpt,plaintext,visibility';
</script>
		<script>
function getParameterByName(e,n){n||(n=window.location.href),e=e.replace(/[\[\]]/g,"\\$&");var r=new RegExp("[?&]"+e+"(=([^&#]*)|&|#|$)").exec(n);return r?r[2]?decodeURIComponent(r[2].replace(/\+/g," ")):"":null}
const action=getParameterByName("action"),stripe=getParameterByName("stripe"),body=document.body;"subscribe"==action&&body.classList.add("global-notification-subscribe"),"signin"==action&&body.classList.add("global-notification-signin"),"signup"==action&&body.classList.add("global-notification-signup"),"success"==stripe&&body.classList.add("global-notification-success");
</script>
	</body>
</html>
