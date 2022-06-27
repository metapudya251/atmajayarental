<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap1.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic&amp;display=swap') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/simple-line-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome5-overrides.min.css') }}" />
</head>

<body id="page-top"><a class="menu-toggle rounded" href="#"><i class="fa fa-bars"></i></a>
    <nav class="navbar navbar-light navbar-expand" id="sidebar-wrapper">
        <div class="container"><button data-bs-toggle="collapse" class="navbar-toggler d-none" data-bs-target="#"></button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav sidebar-nav" id="sidebar-nav">
                    <li class="nav-item sidebar-brand"><a class="nav-link active js-scroll-trigger" href="#page-top">Atma Jaya Rental</a></li>
                    <li class="nav-item sidebar-nav-item"><a class="nav-link js-scroll-trigger" href="#page-top">Home</a></li>
                    <li class="nav-item sidebar-nav-item"><a class="nav-link js-scroll-trigger" href="#services">Services</a></li>
                    <li class="nav-item sidebar-nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Maps</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="d-flex masthead" style="background-image:url('assets/img/1.png');">
        <div class="container my-auto text-center">
            <h1 class="mb-1">Atma Jaya Rental</h1>
            <h3 class="mb-5"><em>A Free Bootstrap Theme</em></h3><a class="btn btn-primary btn-xl js-scroll-trigger" role="button" href="{{ route('customer.login') }}">Get Started</a>
            <div class="overlay"></div>
        </div>
    </header>
    <section id="services" class="content-section bg-primary text-white text-center">
        <div class="container">
            <div class="content-section-heading">
                <h3 class="text-secondary mb-0">Services</h3>
                <h2 class="mb-5">What We Offer</h2>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-5 mb-lg-0"><span class="mx-auto service-icon rounded-circle mb-3"><i class="fas fa-car"></i></span>
                    <h4><strong>Car Rental</strong></h4>
                </div>
                <div class="col-md-6 col-lg-3 mb-5 mb-lg-0"><span class="mx-auto service-icon rounded-circle mb-3"><i class="fas fa-id-card"></i></span>
                    <h4><strong>Car Rental with Driver</strong></h4>
                </div>
                <div class="col-md-6 col-lg-3 mb-5 mb-lg-0"><span class="mx-auto service-icon rounded-circle mb-3"><i class="fas fa-check"></i></span>
                    <h4><strong>Clean cars and Flexible bookings</strong></h4>
                </div>
                <div class="col-md-6 col-lg-3 mb-5 mb-lg-0"><span class="mx-auto service-icon rounded-circle mb-3"><i class="fas fa-wrench"></i></span>
                    <h4><strong>Car Maintenance</strong></h4>
                </div>
            </div>
            <div><br><br><br></div>
        </div>
    </section>

    <section id="contact" class="mapouter"><iframe frameborder="0" src="{{ url('https://maps.google.com/maps?q=Jl.%20Babarsari%20No.44,%20Janti,%20Caturtunggal,%20Kec.%20Depok,%20Kabupaten%20Sleman,%20Daerah%20Istimewa%20Yogyakarta%2055281&t=&z=13&ie=UTF8&iwloc=&output=embed') }}" width="100%" height="585"></iframe></section>
    <footer class="bg-white sticky-footer">
        <div class="container my-auto">
          <div class="text-center my-auto copyright"> <p class="text-center my-auto copyright">Copyright &nbsp;© Atma Jaya Rental 2022</p></div>
        </div>
        <a class="js-scroll-trigger scroll-to-top rounded" href="#page-top"><i class="fa fa-angle-up"></i></a>
    </footer>
    <script src="{{ url('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/stylish-portfolio.js') }}"></script>
</body>

</html>