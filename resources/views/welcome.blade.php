<!DOCTYPE html>
<html lang="es">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <title>YekixPaki|Inicio</title>


    <link href="index/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="index/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href="index/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"> <img src="img/favicon.ico" alt=""> Yekixpaki    <img src="img/diente.png" alt=""> </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#acerca">¿Quienes somos?</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#servicios">Servicios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#ubicacion">Ubicacion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contacto">Contactos</a>
            </li>
            <li class="nav-item">
              @auth
              <a class="nav-link btn btn-outline-success" href="{{ url('/home') }}">Sesión activa</a>
              @else
              <a class="nav-link btn btn-outline-success" href="{{ route('login') }}">Iniciar sesión</a>
              @endauth
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="masthead text-center text-black d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Yekixpaki</strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class=" mb-5 text-black">Clinica Dental de Atencion Integral y Preventiva Yekixpaki</p>
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#acerca">Ver más</a>
          </div>
        </div>

      </div>
    </header>

    <section class="bg-primary" id="acerca">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">Quienes somos</h2>
            <hr class="light my-4">
            <p class="text-faded mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae vel, deserunt assumenda odit, velit, modi perspiciatis tenetur cumque ea 
              est blanditiis praesentium soluta dignissimos doloribus impedit. Recusandae dignissimos officia animi.</p>
            <a class="btn btn-light btn-xl js-scroll-trigger" href="#servicios">Servicios</a>
          </div>
        </div>
      </div>
    </section>

    <section id="servicios">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">Contamos con los siguientes servicios</h2>
            <hr class="my-4">
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-tooth text-primary mb-3 sr-icon-1"></i>
              <h3 class="mb-3">Atención dental</h3>
              <p class="text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                Mollitia, distinctio corporis ab sed quidem aut labore enim minus beatae dicta, velit illo pariatur 
                consequuntur adipisci earum, a esse explicabo. Inventore.</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-users text-primary mb-3 sr-icon-2"></i>
              <h3 class="mb-3">Atención especializada</h3>
              <p class="text-muted mb-0"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores accusamus, similique eos mollitia aut sit necessitatibus quidem
                 autem suscipit natus ipsa, dolore pariatur et sequi voluptas perspiciatis eveniet. Ex, quidem.
              </p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-clock text-primary mb-3 sr-icon-3"></i>
              <h3 class="mb-3">Atención horas personalizadas</h3>
              <p class="text-muted mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ut repellendus dolor unde modi, nemo sint neque commodi saepe 
                dolores fugiat exercitationem alias minima iure error nostrum quisquam? Amet, laborum delectus.</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-briefcase-medical text-primary mb-3 sr-icon-4"></i>
              <h3 class="mb-3">Tratamientos</h3>
              <p class="text-muted mb-0">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Error accusamus recusandae ut amet voluptate, dicta minus dolorem
                 vel voluptatem doloremque eaque quidem delectus quibusdam harum aliquam enim non? Totam, accusamus!  </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="p-0" id="">
      <div class="container-fluid p-0">
        <div class="row no-gutters popup-gallery">
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="img/expandidas/1.jpg">
              <img class="img-fluid" src="img/despliegue/1.jpg" width="" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Tema
                  </div>
                  <div class="project-name">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab totam, ratione quas explicabo veniam beatae accusamus cum voluptate 
                    corporis at eligendi nam tempora illo enim numquam dolore, necessitatibus expedita debitis.
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="img/expandidas/2.jpg">
              <img class="img-fluid" src="img/despliegue/2.jpg"  alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Tema
                  </div>
                  <div class="project-name">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed aperiam dignissimos delectus nesciunt ex recusandae tenetur inventore sapiente
                     pariatur veritatis incidunt placeat accusantium, alias saepe ut, quos, deleniti quae blanditiis.
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="img/expandidas/3.jpg">
              <img class="img-fluid" src="img/despliegue/3.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Tema
                  </div>
                  <div class="project-name">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestiae debitis dicta, sit eum, eaque repudiandae, laudantium facere eveniet cum dolorum 
                    impedit provident tenetur. Est, at natus. Similique officiis possimus beatae.
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="img/expandidas/4.jpg">
              <img class="img-fluid" src="img/despliegue/4.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Tema
                  </div>
                  <div class="project-name">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestiae debitis dicta, sit eum, 
                    eaque repudiandae, laudantium facere eveniet cum dolorum impedit provident tenetur. Est, at natus. Similique officiis possimus beatae.
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="img/expandidas/5.jpg">
              <img class="img-fluid" src="img/despliegue/5.jpg"  alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    tema
                  </div>
                  <div class="project-name">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias in aliquam, iste necessitatibus aut magnam eveniet facere perspiciatis 
                    eos laborum ipsum doloribus! Consectetur, perferendis est esse nihil dolore a? Tenetur!
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="img/expandidas/6.jpg">
              <img class="img-fluid" src="img/despliegue/6.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Tema
                  </div>
                  <div class="project-name">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit perferendis fugiat neque quo voluptatum 
                  sit ut officia quia. Labore est, iure fuga fugit tempora eum odit sit rerum inventore doloribus.
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>

    <section id="ubicacion">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h2 class="section-heading">Nuestra ubicación</h2>
              <hr class="my-4">
            </div>
          </div>
        </div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.950682227629!2d-89.21119018516987!3d13.721435690367104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd1f037d1e2156c4a!2sClinica+Dental+de+Atencion+Integral+y+Preventiva+YEKIXPAKI!5e0!3m2!1ses!2ses!4v1537645205608" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    

    <section id="contacto">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading">Necesitas mas información</h2>
            <hr class="my-4">
            <p class="mb-5">No dudes en contactarnos por medio de nuestros numeros telefonicos y redes sociales</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 ml-auto text-center">
            <i class="fas fa-phone fa-3x mb-3 sr-contact-1"></i>
            <p>2102-2198</p>
            <p>6420-8735</p>
          </div>
       
              <div class="col-lg-4 ml-auto text-center">
                  <i class="fab fa-facebook fa-3x mb-3 sr-contact-2"></i>
                  <p>
                    <a href="https://www.facebook.com/Yekixpaki/">Facebook </a>
                  </p>
                </div>
        
          <div class="col-lg-4 ml-auto text-center">
            <i class="fas fa-envelope fa-3x mb-3 sr-contact-3"></i>
            <p>
              <a href="mailto:your-email@your-domain.com">clinica@yekix.com </a>
            </p>
          </div>
        </div>
      </div>
    </section>


 
    <script src="index/jquery/jquery.min.js"></script>
    <script src="index/bootstrap/js/bootstrap.bundle.min.js"></script>   
    <script src="index/jquery-easing/jquery.easing.min.js"></script>
    <script src="index/scrollreveal/scrollreveal.min.js"></script>
    <script src="index/magnific-popup/jquery.magnific-popup.min.js"></script>

    <script src="js/index.js"></script>

  </body>

</html>



