@extends('layouts.app')

@section('content')
     <div >
         <section class="blog-area" >
            <div class="container" >
               
               <div class="row" height="5" width= "5">
                  <div class="blog-slider"  >
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="blog" >
                                <figure><img height="200" src="welcome_new/images/blog/1.jpg" alt=""/></figure>
                                <div class="content">
                                    <span><i class="fa  fa-calendar-o"></i>January 29, 2021</span>
                                    <h4><a href="#">¿El proceso de inversión en criptos es seguro?</a></h4>
                                    <p height="7" >Nam nec tellus a odio tincidunt auctor are odio sed non mauris. This is Photoshop's ern  of Lorem Ipsum Proin gravida.</p>
                                    <a href="{{ route('registration') }}" class="blog-btn">ASISTIR <i class="fa  fa-arrow-circle-o-right"></i></a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                

                
            </div>
         </section>
      </div>
@endsection

  
    <link rel="stylesheet" type="text/css" href="{{ url('test.css') }}"/>


<script type="text/javascript">

    
    function checkloaded(obj)
    {
        if("header_1" === obj)
        {
            var body = document.getElementById("body_1");
            checkProperty(body);
        }
    }
    function checkProperty(body)
    {
        if(body.style.display === 'none')
        {
          body.style.display = "block";
        }
        else{
          body.style.display = "none";
        }
    }

    eve
        
</script>