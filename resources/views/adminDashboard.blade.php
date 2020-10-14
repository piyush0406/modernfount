<?php   use \App\Http\Controllers\WebController; ?>

<!DOCTYPE html>
<html lang="en">
   <meta http-equiv="content-type" content="text/html;charset=utf-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Dashboard | Modern Fount</title>
      <script src="{{ asset('js/app.js') }}" defer></script>
      <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@500&amp;family=Spartan:wght@500;600;700&amp;display=swap" rel="stylesheet">
      <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
      <link href="{{ asset('css/style.css') }}" rel="stylesheet">
      <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
     <body class="sb-nav-fixed">
         <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
             <a class="navbar-brand" href="{{ url('/')}}"><img src="{{ asset('images/mf_white1.png') }}" alt="MF.logo" width="60%"></a>
             <button class="btn btn-link btn-sm order-o order-lg-0" id="sidebarToggle" href="#"><i class="fa fa-bars"></i></button>

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
                             <a class="nav-link active" href="{{ url('/admin')}}">
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
                             <a class="nav-link" href="{{ url('/admin/articles')}}">
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
                         <h1 class="mt-4">Dashboard</h1>
                         <ol class="breadcrumb mb-4">
                             <li class="breadcrumb-item active">Administrator</li>
                         </ol>
                         <div class="row">
                             <div class="col-xl-4 col-md-6">
                                 <div class="card bg-primary text-white mb-4">
                                     <div class="card-body">Number of articles pending:

                                       <br><span>@php
                                                  $unapporved=App\Http\Controllers\Api\ArticleController::unapprovedCount();
                                                  if(count($unapporved)==0){
                                                    echo ('0');
                                                  }
                                                  else echo $unapporved[0]['articles'];
                                                  @endphp
                                            </span>
                                     </div>
                                     <div class="card-footer d-flex align-items-center justify-content-between">
                                         <a class="small text-white stretched-link" href="{{ url('/admin/approval-request')}}">View Details</a>
                                         <div class="small text-white"><i class="fa fa-angle-right"></i></div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-xl-4 col-md-6">
                                 <div class="card bg-success text-white mb-4">
                                     <div class="card-body">Total number of articles:
                                    <br><span>@php
                                                $approved=App\Http\Controllers\Api\ArticleController::approvedCount();
                                                if(count($approved)==0){
                                                  echo ('0');
                                                }
                                                else echo $approved[0]['articles'];
                                                @endphp
                                         </span></div>
                                     <div class="card-footer d-flex align-items-center justify-content-between">
                                         <a class="small text-white stretched-link" href="{{ url('/admin/articles')}}">View Details</a>
                                         <div class="small text-white"><i class="fa fa-angle-right"></i></div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-xl-4 col-md-12">
                                 <div class="card bg-danger text-white mb-4">
                                     <div class="card-body">Total number of writers:
                                       <br><span>@php
                                                  $author=App\Http\Controllers\Api\ArticleController::authorCount();
                                                  if(count($author)==0){
                                                    echo ('0');
                                                  }
                                                  else echo $author[0]['authors']
                                                  @endphp
                                            </span>
                                     </div>
                                     <div class="card-footer d-flex align-items-center justify-content-between">
                                         <!--<a class="small text-white stretched-link" href="#">View Details</a>
                                         <div class="small text-white"><i class="fa fa-angle-right"></i></div>-->
                                     </div>
                                 </div>
                             </div>
                         </div>


                     </div>
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
