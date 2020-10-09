<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from renge-dark.fueko.net/signin/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Aug 2020 12:22:50 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Renge — Sign in</title>
        <meta name="HandheldFriendly" content="True">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@500&amp;family=Spartan:wght@500;600;700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Muli:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet">
<link href="{{ asset('css/cover.css') }}" rel="stylesheet">
<link rel="canonical" href="index.html" />


    <script defer src="../public/members.min93e2.js?v=8a67789b6a"></script>
    <meta name="generator" content="Ghost 3.22" />
    <link rel="alternate" type="application/rss+xml" title="Newsroom" href="../rss/index.html" />
    </head>
    <body class="custom-page global-hash-dark-version global-hash-details-amethyst global-hash-post-amber global-hash-post-apricot global-hash-post-aqua global-hash-post-coral global-hash-post-cream global-hash-post-green global-hash-post-purple global-hash-post-raspberry global-hash-post-sky">
        <div class="custom-wrap">
            <div class="custom-image global-bg-image" style="background-image: url(https://images.unsplash.com/photo-1587136527307-f53f514267d7?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=2000&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjExNzczfQ)"></div>
            <div class="custom-container">
                <div class="custom-logo">
                    <a class="is-image" href="{{ url('/')}}"><img src="../content/images/2020/07/renge-1.svg" alt="Newsroom"></a>
                </div>
                <div class="custom-content">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary global-button">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="alert-success">
                        <h2>Great!</h2>
                        <p>Check your inbox and click the link to complete signin</p>
                        <a href="{{ url('/')}}" class="global-button">Back to homepage</a>
                    </div>
                </div>
            </div>
        </div>

    </body>

</html>
