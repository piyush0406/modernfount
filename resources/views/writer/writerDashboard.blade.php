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
             <a class="navbar-brand" href="{{ url('/')}}"><img src="{{ asset('images/mf_white1.png') }}" alt="mf_white1.logo" width="60%"></a>
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
                             <a class="nav-link active" href="{{ url('/writer')}}">
                                 <div class="sb-nav-link-icon"><i class="fa fa-user-circle"></i></div>
                                 Profile
                             </a>
                             <a class="nav-link" href="{{ url('/writer/article-listing')}}">
                                 <div class="sb-nav-link-icon"><i class="fa fa-list"></i></div>
                                 Article Listing
                             </a>
                             <a class="nav-link" href="{{ url('/writer/create-article')}}">
                                 <div class="sb-nav-link-icon"><i class="fa fa-file-text"></i></div>
                                 Create a new article
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
                       <h1 class="mt-4">Profile</h1>
                       <ol class="breadcrumb mb-4">
                           <li class="breadcrumb-item active">Writer</li>
                       </ol>
                       <div class="card mb-4">
                           <div class="card-header">
                               <i class="fa fa-user-circle"></i>
                               Profile
                             </div>
                             <div class="profile-box container-fluid my-4">
                               <div class="row">

                                 <div class="col-6">
                                   <div class="container-fluid profile-image-container">
                                     @php
                                     $id=Auth::user()->id;
                                     $path=$id . 'profilepic.jpg';
                                     @endphp
                                     <div class="image-display text-center">
                                       <img src="{{asset('images/').'/'.$path}}" alt="Profile Picture">
                                     </div>
                                     <form class="" action="{{route('updateimage')}}" method="post" enctype="multipart/form-data" id="imgupload">
                                       <div class="image-button text-center">

                                       <input type="file" name="image" value="" required>
                                       <div class="hiddenInfo">
                                         <input type="text" name="user_id" value="{{Auth::user()->id}}">
                                       </div>
                                       <button type="submit" name="button" class="btn btn-outline-success">Upload</button>
                                     </div>
                                     </form>
                                     <button onclick="editImg()" class="btn btn-outline-dark float-right"><i class="fa fa-pencil"></i>&nbsp;Edit</button>
                                   </div>
                                 </div>
                                 @php
                                     $author=App\Http\Controllers\Api\AuthorController::getAuthorById(Auth::user()->id);
                                     $authorDetails=$author[0];
                                 @endphp
                                 <div class="col-6 form-non-editable" id="form-non-editable">

                                     <div class="form-row">
                                        <div class="form-group col-md-6">
                                          <label for="firstname">Name</label>
                                          <label class="form-data-input" id="name_label">{{$authorDetails["name"]}}</label>
                                        </div>
                                      </div>
                                      <div class="form-row">
                                        <div class="form-group col-md-6">
                                          <label for="inputEmail">Email</label>
                                          <label class="form-data-input" id="email_label">{{$authorDetails["email"]}}</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label for="phone">Phone Number</label>
                                          <label class="form-data-input" id="phone_label">{{$authorDetails["mobile"]}}</label>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleFormControlTextarea1">About</label>
                                        <p class="form-data-input" id="about_label">{{$authorDetails["about"]}}</p>
                                      </div>
                                      <div class="form-row">
                                         <div class="form-group col-md-6">
                                           <label for="firstname">Qualification</label>
                                           <label class="form-data-input" id="qualification_label">{{$authorDetails["qualification"]}}</label>
                                         </div>
                                         <div class="form-group col-md-6">
                                           <label for="lastname">Expertise</label>
                                           <label class="form-data-input" id="expertise_label">{{$authorDetails["expertise"]}}</label>
                                         </div>
                                       </div>
                                      <div class="form-row">
                                        <div class="social-icon">
                                          @if($authorDetails['fb_link']==null)
                                            <a><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                                            @else
                                            <a href="{{$authorDetails['fb_link']}}" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                                          @endif
                                          @if($authorDetails['tweet_link']==null)
                                            <a><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                                            @else
                                            <a href="{{$authorDetails['tweet_link']}}" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                                          @endif
                                          @if($authorDetails['insta_link']==null)
                                            <a><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                            @else
                                            <a href="{{$authorDetails['insta_link']}}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                          @endif



                                        </div>


                                      </div>
                                      <button onclick="editInfo()" class="btn btn-outline-dark float-right"><i class="fa fa-pencil"></i>&nbsp;Edit</button>



                                 </div>
                                 <div class="col-6 form-editable" id="form-editable">
                                    <form method="POST" action=" {{route('updateauthor')}} ">
                                      <div class="hiddenInfo"><div class="form-row">
                                        <div class="form-group col-md-6">
                                          <input type="text" class="form-control" id="id" placeholder="id" name="id" value="{{Auth::user()->id}}">
                                        </div>
                                      </div></div>
                                    <div class="form-row">
                                      <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="name" name="name">
                                      </div>
                                    </div>
                                      <div class="form-row">
                                        <div class="form-group col-md-6">
                                          <label for="inputEmail">Email</label>
                                          <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label for="phone">Phone Number</label>
                                          <input type="text" class="form-control" id="mobile" placeholder="Valid Phone Number" name="mobile">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="about">About</label>
                                        <textarea class="form-control" id="about" rows="3" name="about"></textarea>
                                      </div>
                                      <div class="form-row">
                                         <div class="form-group col-md-6">
                                           <label for="firstname">Qualification</label>
                                           <input type="text" class="form-control" placeholder="Qualification" id="qualification" name="qualification">
                                         </div>
                                         <div class="form-group col-md-6">
                                           <label for="lastname">Expertise</label>
                                           <input type="text" class="form-control" placeholder="Expertise" id="expertise" name="expertise">
                                         </div>
                                       </div>
                                       <div class="form-row">
                                          <div class="form-group col-12">
                                            <label for="firstname">Facebook Link</label>
                                            <input type="text" class="form-control" value="{{$authorDetails['fb_link']}}" id="fb_link" name="fb_link">
                                          </div>
                                          <div class="form-group col-12">
                                            <label for="lastname">Twitter Link</label>
                                            <input type="text" class="form-control" value="{{$authorDetails['tweet_link']}}" id="tweet_link" name="tweet_link">
                                          </div>
                                          <div class="form-group col-12">
                                            <label for="lastname">Instagram Link</label>
                                            <input type="text" class="form-control" value="{{$authorDetails['insta_link']}}" id="insta_link" name="insta_link">
                                          </div>
                                        </div>
                                      <!-- <div class="form-row">
                                        <div class="social-icon">
                                          <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                          <i class="fa fa-twitter-square" aria-hidden="true"></i>
                                          <i class="fa fa-instagram" aria-hidden="true"></i>

                                        </div>


                                      </div> -->
                                      <button type="submit" class="btn btn-outline-dark float-right"><i class="fa fa-pencil"></i>&nbsp;Save</button>
                                    </form>


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
