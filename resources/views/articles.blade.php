<?php   use \App\Http\Controllers\WebController; ?>

<!DOCTYPE html>
<html lang="en">
   <meta http-equiv="content-type" content="text/html;charset=utf-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Article Listing | Modern Fount</title>
      <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@500&amp;family=Spartan:wght@500;600;700&amp;display=swap" rel="stylesheet">
      <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
      <link href="{{ asset('css/style.css') }}" rel="stylesheet">
      <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
     <body class="sb-nav-fixed">
         <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
             <a class="navbar-brand" href="{{ url('/')}}"><img src="{{ asset('images/mf_white1.png') }}" alt="MF.logo" width="60%"></a>
             <button class="btn btn-link btn-sm order-0 order-lg-0" id="sidebarToggle" href="#"><i class="fa fa-bars"></i></button>

             <!-- Navbar-->
             <ul class="navbar-nav ml-auto">
               <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
             </ul>
         </nav>
         <div id="layoutSidenav">
             <div id="layoutSidenav_nav">
               <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                   <div class="sb-sidenav-menu">
                       <div class="nav">
                           <div class="sb-sidenav-menu-heading">MENU</div>
                           <a class="nav-link" href="{{ url('/admin')}}">
                               <div class="sb-nav-link-icon"><i class="fa fa-home"></i></div>
                               Home
                           </a>
                           <a class="nav-link" href="{{ url('/admin/user-creation')}}">
                               <div class="sb-nav-link-icon"><i class="fa fa-user-circle"></i></div>
                               User Creation
                           </a>
                           <a class="nav-link" href="{{ url('/admin/approval-request')}}">
                               <div class="sb-nav-link-icon"><i class="fa fa-check-circle"></i></div>
                               Approval Request
                           </a>
                           <a class="nav-link active" href="{{ url('/admin/articles')}}">
                               <div class="sb-nav-link-icon"><i class="fa fa-file-text"></i></div>
                               Articles
                           </a>
                           <a class="nav-link" href="{{ url('/admin/create-article')}}">
                               <div class="sb-nav-link-icon"><i class="fa fa-file-text"></i></div>
                               Create a new Article
                           </a>

                       </div>
                   </div>
                   <div class="sb-sidenav-footer">

                  </div>
               </nav>
             </div>
             <div id="layoutSidenav_content">
                 <main>
                   <div class="container-fluid">
                       <h1 class="mt-4">Articles</h1>
                       <ol class="breadcrumb mb-4">
                           <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Home</a></li>
                           <li class="breadcrumb-item active">Articles</li>
                       </ol>
                       @php
                          $articleTable=App\Http\Controllers\Api\ArticleController::index();
                       @endphp
                       <table class="table table-sm table-light table-hover">
                       <thead class="thead-light">
                       <tr>
                       <th scope="col" class="auto-table-w">S No.</th>
                       <th scope="col" >Article Title</th>
                       <th scope="col" class="auto-table-w">Edit Info</th>
                       <th scope="col" class="auto-table-w">Select as Hero</th>
                       <th scope="col" class="auto-table-w">Select as Secondary</th>
                       <th scope="col" class="auto-table-w">Delete</th>
                       </tr>
                       </thead>
                       <tbody>
                         @php $c='c';
                         $b='b';
                         $r='r';
                         $count=1;
                         @endphp
                         @foreach($articleTable as $article)
                       <tr>
                       <th scope="row" class="text-center">{{$count}}</th>
                       <td> {{$article['title']}} </td>
                       <td class="text-center"> <a href="{{ URL::route('editArticle' , $article['id'])}}"><button class="btn btn-primary"><i class="fa fa-pencil-square"></i></button></a> </td>
                       <form class="" action="{{route('articleherostatus')}}" method="post">
                         <div class="hiddenInfo">
                           <input type="text" name="id" value="{{$article['id']}}">
                           <input type="text" name="hero_article" value="0">
                           <input type="text" name="author_id" value="{{$article['author_id']}}">
                           <button type="submit" id="{{$b.$article['id']}}"></button>
                         </div>
                       </form>
                         <td class="text-center"> <div class="radio">
                           <label>
                             @if($article['hero_article']==1)
                             <input type="radio" name="optradio" id="{{$r.$article['id']}}" onclick="submitHero(this.id)" checked>
                             @else
                             <input type="radio" name="optradio" id="{{$r.$article['id']}}" onclick="submitHero(this.id)">
                             @endif
                           </label>
                         </div> </td>

                       <form class="" action="{{route('articlesecondarystatus')}}" method="post">
                         <div class="hiddenInfo">
                           <input type="text" name="id" value="{{$article['id']}}">
                           <input type="text" name="approved" value="1">
                           <input type="text" name="hero_article" value="0">
                           <input type="text" name="author_id" value="{{$article['author_id']}}">
                           <button type="submit" id="{{$article['id']}}"></button>
                         </div>
                       <td class="text-center"><label class="checkbox-inline">
                        @if($article['secondary_article']==1)
                        <input type="checkbox" name="secondary_article" onclick="submitSecond(this.id)" checked id="{{$c.$article['id']}}">

                        @else
                        <input type="checkbox" name="secondary_article" onclick="submitSecond(this.id)" id="{{$c.$article['id']}}">
                        @endif
                      </label>
                      </td>
                       </form>

                       <form class="" action="{{route('deletearticleA')}}" method="post">
                         <div class="hiddenInfo">
                           <input type="text" name="id" value="{{$article['id']}}">
                         </div>
                       <td class="text-center"><button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                       </form>
                       </tr>
                          @php $count++; @endphp
                          @endforeach
                       </tbody>
                       </table>

                 </main>
                 <footer class="py-4 bg-light mt-auto">
                     <div class="container-fluid">
                         <div class="d-flex align-items-center justify-content-between small">
                             <div class="text-muted">Delta Webworks &copy; 2020. All Right Reserved.</div>
                             <div>
                                 <a href="#">Privacy Policy</a>
                                 &middot;
                                 <a href="#">Terms &amp; Conditions</a>
                             </div>
                         </div>
                     </div>
                 </footer>
             </div>
         </div>

         <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
         <script src="{{ asset('js/script.js') }}"></script>
         <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
         <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

     </body>
 </html>
