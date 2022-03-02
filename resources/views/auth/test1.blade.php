@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Notificaciones</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             Slider
                         </div>
                         <div class="card-body">
                             
                            SLIDER

                            <section class="registration">
            <div class="container pd-b30">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <div class="section-heading2">
                            <h4>Eventos Próximos</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="blog-slider">
                        @for ($i = 0; $i < 6; $i++)   
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <div class="blog">
                            <figure><img src="welcome_new/images/blog/1.jpg" alt=""/></figure>
                            <div class="content">
                            <span><i class="fa  fa-calendar-o"></i>January 29, 2021</span>
                                <h4><a href="#">¿El proceso de inversión en criptos es seguro?</a></h4>
                                <p>Nam nec tellus a odio tincidunt auctor are odio sed non mauris. This is Photoshop's ern  of Lorem Ipsum Proin gravida.</p>
                                <a class="blog-btn">LINK: https://meet.google.com/vrr-pioe-xbf </a>
                            </div>
                            </div>
                        </div>
                        @endfor
                </div>
                </div>
            </div>
        </section>

                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

