<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Tags | News Room</title>
		<meta name="HandheldFriendly" content="True">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@500&amp;family=Spartan:wght@500;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Muli:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('css/cover.css') }}" rel="stylesheet">
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="canonical" href="index.html" />
    <meta name="referrer" content="no-referrer-when-downgrade" />
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
											 <li><a href="{{ url('/tags')}}" class="is-active">Tags</a></li>
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
				@php
				$tags=App\Http\Controllers\Api\TagController::uniqueTagsCount();
				if ($tags==0){
					$tags=[];
				}
				@endphp
					<main class="global-main">

					<div class="custom-elements-wrap loop-wrap">
						@foreach($tags as $tag)
							<div class="custom-element">
								<a href="{{ URL::route('tagdisplay' , $tag['name'])}}" class="global-image">
									<img src="{{ asset('images/hash.png') }}" alt="tag">
								</a>
								<h2><a href="{{ URL::route('tagdisplay' , $tag['name'])}}">{{$tag['name']}}</a></h2>
								<span>{{$tag['posts']}} posts</span>
							</div>
							@endforeach
						</div>
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