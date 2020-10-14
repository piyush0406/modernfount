<?php   use \App\Http\Controllers\WebController; ?>

<!DOCTYPE html>
<html lang="en">
   <meta http-equiv="content-type" content="text/html;charset=utf-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Home | Modern Fount</title>
      <meta name="HandheldFriendly" content="True">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@500&amp;family=Spartan:wght@500;600;700&amp;display=swap" rel="stylesheet">
      <link href="{{ asset('css/cover.css') }}" rel="stylesheet">
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
                           <li><a href="{{ url('/')}}" class="is-active">Home</a></li>
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
               $articleTable=App\Http\Controllers\Api\ArticleController::index();
               $display=0;
               if (count($articleTable)==0){
                 $articleTable=[];
                 $display=1;
               }
               $flag=0;
               foreach($articleTable as $article){
                 if ($article['hero_article']==1){
                   $hero_article=$article;
                   $flag=1;
                 }
             }
             if($flag==0 && $display==0){
               $hero_article=$articleTable[0];
             }
             elseif ($display==1) {
               $hero_article=[];
             }
             elseif ($flag==1) {

             }
             else {
               $hero_article=$articleTable[0];
             }
            @endphp
            @if ($display==0)
            <main class="global-main">
               <div class="loop-section">
                  <div class="loop-wrap">
                    @php
                    $id=$hero_article['id'];
                    $path=$id . 'coverpic.jpg';
                    @endphp
                     <article class="item is-hero is-first is-image post tag-story tag-art tag-creative tag-hash-post-raspberry tag-hash-dark-version tag-hash-details-amethyst">
                        <div class="item-container global-color">
                           <a href="#" class="item-image global-image global-color">
                           <img sizes="(max-width:480px) 240px, (max-width:768px) 200px, (max-width:1024px) 290px, 350px"
                              src="{{asset('images/').'/'.$path}}"
                              alt="">
                           </a>
                           <div class="item-content">
                              <div class="global-meta">
                                 <time>Published on @php $date=$hero_article['created_at'];
                                 echo date_format($date,"d F, Y"); @endphp</time>
                                 by
                                 <a href="{{ URL::route('authordetail' , $hero_article['author_id'])}}">{{$hero_article['author']}}</a>
                                 <span class="global-reading">
                                 — {{$hero_article['read_time']}} min read
                                 </span>
                              </div>
                              <h2 class="item-title">
                                 <a href="{{ URL::route('articledisplay' , $hero_article['id'])}}" class="global-underline">{{$hero_article['title']}}</a>
                              </h2>
                              <p class="item-excerpt">
                                {{$hero_article['byline']}}
                              <div class="global-tags">
                                @foreach($hero_article['tags'] as $tag)
                                 <a href="{{ URL::route('tagdisplay' , $tag['name'])}}" class="global-tags-hash-sign">{{$tag['name']}}</a>
                                 @endforeach
                              </div>
                           </div>
                        </div>
                     </article>
                     @php
                     if (count($articleTable)==0){
                       $articleTable=[];
                     }
                     @endphp
                     @foreach($articleTable as $article)
                     @if ($article['secondary_article']==1)
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
            @endif
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

      <script src="assets/js/global93e2.js?v=8a67789b6a"></script>
      <script>var numberPaged = 4;</script>
      <script src="assets/js/index93e2.js?v=8a67789b6a"></script>
      <script>
         const searchPublished = 'Published',
         	  searchUrl = 'index.html',
         	  searchKey = "867648796ce449e62afff6ff8a",
         	  searchAPI = searchUrl+'/ghost/api/v3/content/posts/?key='+searchKey+'&limit=all&formats=plaintext&fields=url,title,published_at,excerpt,plaintext,visibility';
      </script>
      <script>

         function getParameterByName(e,n){n||(n=window.location.href),e=e.replace(/[\[\]]/g,"\\$&");var r=new RegExp("[?&]"+e+"(=([^&#]*)|&|#|$)").exec(n);return r?r[2]?decodeURIComponent(r[2].replace(/\+/g," ")):"":null}


         const action=getParameterByName("action"),stripe=getParameterByName("stripe"),body=document.body;"subscribe"==action&&body.classList.add("global-notification-subscribe"),"signin"==action&&body.classList.add("global-notification-signin"),"signup"==action&&body.classList.add("global-notification-signup"),"success"==stripe&&body.classList.add("global-notification-success");
      </script>
   </body>
</html>
