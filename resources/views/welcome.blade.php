<!DOCTYPE HTML>
<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Hyperspace by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="welcome/css/main.css" />
		<noscript><link rel="stylesheet" href="welcome/css/noscript.css" /></noscript>
	</head>

<style>
    /*
    .form-group label {
        font-weight: bold;
    }
    div .card-header {
        background-color: #72371F;
        color: white;
    }

    .nav-link:focus,
    .nav-link:hover {
        background-color: #940818 !important;
    }

    .dropdown .nav-link {
        background-color: white !important;
    }

    .btn-primary {
        background-color: #bb0a1e;
        border-color: #bb0a1e;
    }

    .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open>.dropdown-toggle.btn-primary {
        color: #fff;
        background-color: #940818;
        border-color: #940818;
    }
    .breadcrumb-item a {
        color: #bb0a1e;
    }
    .sidebar .nav-link.active .nav-icon {
        color: red;
    }

    .card .card-body-filter {
        padding-bottom: 0px;
    }

    div .card-header {
        background-color: #940818;
        color: white;
    }

    .sidebar {
        background-color: #940818;
    }
    .nav-link:focus,
    .nav-link:hover {
        background-color: white !important;
        color: black !important;
    }
    .nav-link:focus .nav-icon,
    .nav-link:hover .nav-icon {
        color: #940818 !important;
    }
    .sidebar .nav-link.active{
        color: #940818 !important;
        background-color: white !important;
    }
    */
    #sidebar {
        background: #09114A;
    }
    #intro {
        position: relative;
        background: #5C97FF;
        overflow: hidden;
    }
    #intro .inner {
        padding: 50px;
        position: relative;
        z-index: 2;
    }
    #intro::before {
        content: ' ';
        display: block;
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        opacity: 0.8;
        background-image: url(welcome/images/intro.png);
        background-repeat: no-repeat;
        background-position: 50% 0;
        background-size: cover;
    }

    h1, h2, h3, h4, h5, h6, p {
        color: #EAB226;
    }

    input[type="button"], button, .button {
        background-color: #0079BE;
    }

    .image {
        margin: 50px;
    }

    .spotlights > section > .image {
        background-size: auto;
        background-repeat: no-repeat;
    }

    .style2 {
        background-color: #1C305C !important;
    }
    
</style>
    
	<body class="is-preload">

		<!-- Sidebar -->
			<section id="sidebar">
				<div class="inner">
                    <img src="welcome/images/logo.png" alt="" data-position="center center" />
					<nav>
						<ul>
							<li><a href="#intro">Inicio</a></li>
							<li><a href="#one">Registro</a></li>
							<li><a href="#two">Empieza a invertir</a></li>
							<li><a href="#three">Suspcriptores</a></li>
                            <li><a href="#four">Clientes</a></li>
                            <li><a href="#five">Eventos</a></li>
						</ul>
					</nav>
				</div>
			</section>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Intro -->
					<section id="intro" class="wrapper style1 fullscreen fade-up">
						<div class="inner">
							<h1>Quisque velit nisi</h1>
							<p>
                                Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.<br>
                                Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.
                            </p>
							<ul class="actions">
								<li><a href="#one" class="button scrolly">Empieza a invertir</a></li>
							</ul>
						</div>
					</section>

				<!-- One -->
					<section id="one" class="wrapper style2 spotlights" >
						<section>
							<a href="#" class="image"><img src="welcome/images/suspcriptor.png" alt="" data-position="center center"/></a>
							<div class="content">
								<div class="inner">
									<h2>Suscriptor</h2>
									<p>Serás nuestro solcio comercial.</p>
									<ul class="actions">
										<li><a href="#" class="button">Conocer más</a></li>
									</ul>
								</div>
							</div>
						</section>
						<section>
							<a href="#" class="image"><img src="welcome/images/cliente.png" alt="" data-position="top center" /></a>
							<div class="content">
								<div class="inner">
									<h2>Cliente</h2>
									<p>Tendrás un crecimiento individual.</p>
									<ul class="actions">
										<li><a href="#" class="button">Conocer más</a></li>
									</ul>
								</div>
							</div>
						</section>
					</section>

				<!-- Two -->
                    <section id="two" class="wrapper style1 fade-up">
						<div class="inner">
							<h2>Get in touch</h2>
							<p>Phasellus convallis elit id ullamcorper pulvinar. Duis aliquam turpis mauris, eu ultricies erat malesuada quis. Aliquam dapibus, lacus eget hendrerit bibendum, urna est aliquam sem, sit amet imperdiet est velit quis lorem.</p>
							<div class="split style1">
								<section>
									<form method="post" action="#">
										<div class="fields">
											<div class="field half">
												<label for="name">Name</label>
												<input type="text" name="name" id="name" />
											</div>
											<div class="field half">
												<label for="email">Email</label>
												<input type="text" name="email" id="email" />
											</div>
											<div class="field">
												<label for="message">Message</label>
												<textarea name="message" id="message" rows="5"></textarea>
											</div>
										</div>
										<ul class="actions">
											<li><a href="" class="button submit">Send Message</a></li>
										</ul>
									</form>
								</section>
								<section>
									<ul class="contact">
										<li>
											<h3>Address</h3>
											<span>12345 Somewhere Road #654<br />
											Nashville, TN 00000-0000<br />
											USA</span>
										</li>
										<li>
											<h3>Email</h3>
											<a href="#">user@untitled.tld</a>
										</li>
										<li>
											<h3>Phone</h3>
											<span>(000) 000-0000</span>
										</li>
										<li>
											<h3>Social</h3>
											<ul class="icons">
												<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
												<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
												<li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
												<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
												<li><a href="#" class="icon brands fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
											</ul>
										</li>
									</ul>
								</section>
							</div>
						</div>
					</section>
					

				<!-- Three -->
                    <section id="three" class="wrapper style3 fade-up" style="background: #09114A;">
                        <div class="inner">
							<h2>Suscriptor</h2>
							<p>Si te interesa ser nuestro socio comercial te encargarás de gestionar la distribución de servicios financieros de la empresa AEIA, realizando procesos de venta y monitoreo de tus clientes afiliados.</p>
							<div class="features">
								<section>
									<span class="icon solid major fa-circle"></span>
									<p>Código único para comisiones</p>
								</section>
								<section>
									<span class="icon solid major fa-circle"></span>
									<p>Ingreso al panel de control</p>
								</section>
                                <section>
									<span class="icon solid major fa-circle"></span>
									<p>Más de 180 robots</p>
								</section>
								<section>
									<span class="icon solid major fa-circle"></span>
									<p>Una membresía de clientes</p>
								</section>
							</div>
							<ul class="actions">
								<li><a href="#" class="button">Iniciar ahora</a></li>
							</ul>
						</div>
					</section>

                <!-- Four -->
                    <section id="four" class="wrapper style3 fade-up" style="background: #09114A;">
                        <div class="inner">
							<h2>Cliente</h2>
							<p>Si deseas iniciar a generar ingresos pasivos a través de la plataforma mediante la implementación de estrategias de mercado, diversificación del riesgo y seguimiento de su dinero, afíliate como cliente.</p>
							<div class="features">
								<section>
									<span class="icon solid major fa-circle"></span>
									<p>Contrato legal de registro</p>
								</section>
								<section>
									<span class="icon solid major fa-circle"></span>
									<p>Cuenta individual</p>
								</section>
                                <section>
									<span class="icon solid major fa-circle"></span>
									<p>Más de 180 robots</p>
								</section>
								<section>
									
								</section>
							</div>
							<ul class="actions">
								<li><a href="#" class="button">Iniciar ahora</a></li>
							</ul>
						</div>
					</section>

                <!-- Five -->
					<section id="five" class="wrapper style2 spotlights" >
						<section>
							<a href="#" class="image"><img src="welcome/images/img1.png" alt="" data-position="center center"/></a>
							<div class="content">
								<div class="inner">
									<h2>Evento 1</h2>
									<p>
                                        Fecha: 01/01/3001<br>
Hora: 23:30<br>
Ponente: Diego Butron
                                    </p>
									<ul class="actions">
										<li><a href="#" class="button">Participar</a></li>
									</ul>
								</div>
							</div>
						</section>
						<section>
							<a href="#" class="image"><img src="welcome/images/img2.png" alt="" data-position="top center" /></a>
							<div class="content">
								<div class="inner">
									<h2>Evento 2</h2>
									<p>
                                        Fecha: 01/01/3001<br>
Hora: 23:30<br>
Ponente: Diego Butron
                                    </p>
									<ul class="actions">
										<li><a href="#" class="button">Participar</a></li>
									</ul>
								</div>
							</div>
						</section>
					</section>
					

			</div>

		<!-- Footer -->
			<footer id="footer" class="wrapper style1-alt">
				<div class="inner">
					<ul class="menu">
						<li>&copy; AEIA. All rights reserved.</li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="welcome/js/jquery.min.js"></script>
			<script src="welcome/js/jquery.scrollex.min.js"></script>
			<script src="welcome/js/jquery.scrolly.min.js"></script>
			<script src="welcome/js/browser.min.js"></script>
			<script src="welcome/js/breakpoints.min.js"></script>
			<script src="welcome/js/util.js"></script>
			<script src="welcome/js/main.js"></script>

	</body>
</html>