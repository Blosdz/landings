@extends('layouts.app')

@section('content')
  <div class="container-fluid">
        <div class="animated fadeIn">
             <div class="row">
             
                 <div class="col-lg-12">
                     <div class="card">
                         
                         <div class="card-body">
                            <div class="row col-12">
                                <div class="col-md-2">
                                    <h3> 
                                        Balance General <br>
                                        $ 00.00
                                    </h3>
                                </div>
                                <div class="col-md-2 text-white">
                                    <div class="mx-1 px-2" style="background-color: #ff8a00;">
                                        <div class="row col-12" style="margin: 0 auto">
                                            <span style="margin: 0 auto"><b>Bronce</b></span>
                                        </div>
                                        <br>
                                        <div class="row col-12">
                                            <i class="mdi mdi-account"></i>&nbsp;
                                            <span> 23 </span>
                                        </div>
                                        <div class="row col-12">
                                            <i class="mdi mdi-alpha-s-circle"></i>&nbsp;
                                            <span> $ 230 USD </span>
                                        </div>
                                        <div class="row col-12">
                                            <i class="mdi mdi-account-cash"></i>&nbsp;
                                            <span> $ 10 USD </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 text-white">
                                    <div class="mx-1 px-2" style="background-color: #777777;">
                                        <div class="row col-12" style="margin: 0 auto">
                                            <span style="margin: 0 auto"><b>Plata</b></span>
                                        </div>
                                        <br>
                                        <div class="row col-12">
                                            <i class="mdi mdi-account"></i>&nbsp;
                                            <span> 10 </span>
                                        </div>
                                        <div class="row col-12">
                                            <i class="mdi mdi-alpha-s-circle"></i>&nbsp;
                                            <span> $ 40 USD </span>
                                        </div>
                                        <div class="row col-12">
                                            <i class="mdi mdi-account-cash"></i>&nbsp;
                                            <span> $ 15 USD </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 text-white">
                                    <div class="mx-1 px-2" style="background-color: #ffc641;">
                                        <div class="row col-12" style="margin: 0 auto">
                                            <span style="margin: 0 auto"><b>Oro</b></span>
                                        </div>
                                        <br>
                                        <div class="row col-12">
                                            <i class="mdi mdi-account"></i>&nbsp;
                                            <span> 0 </span>
                                        </div>
                                        <div class="row col-12">
                                            <i class="mdi mdi-alpha-s-circle"></i>&nbsp;
                                            <span> $ 0 USD </span>
                                        </div>
                                        <div class="row col-12">
                                            <i class="mdi mdi-account-cash"></i>&nbsp;
                                            <span> $ 0 USD </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 text-white">
                                    <div class="mx-1 px-2" style="background-color: #31708f;">
                                        <div class="row col-12" style="margin: 0 auto">
                                            <span style="margin: 0 auto"><b>Bronce</b></span>
                                        </div>
                                        <br>
                                        <div class="row col-12">
                                            <i class="mdi mdi-account"></i>&nbsp;
                                            <span> 23 </span>
                                        </div>
                                        <div class="row col-12">
                                            <i class="mdi mdi-alpha-s-circle"></i>&nbsp;
                                            <span> $ 230 USD </span>
                                        </div>
                                        <div class="row col-12">
                                            <i class="mdi mdi-account-cash"></i>&nbsp;
                                            <span> $ 10 USD </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 text-white">
                                    <div class="mx-1 px-2" style="background-color: #4cae4c;">
                                        <div class="row col-12" style="margin: 0 auto">
                                            <span style="margin: 0 auto"><b>Bronce</b></span>
                                        </div>
                                        <br>
                                        <div class="row col-12">
                                            <i class="mdi mdi-account"></i>&nbsp;
                                            <span> 23 </span>
                                        </div>
                                        <div class="row col-12">
                                            <i class="mdi mdi-alpha-s-circle"></i>&nbsp;
                                            <span> $ 230 USD </span>
                                        </div>
                                        <div class="row col-12">
                                            <i class="mdi mdi-account-cash"></i>&nbsp;
                                            <span> $ 10 USD </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         <!--img src="https://1.bp.blogspot.com/-XSxfK5DgJe4/YLfZqxQcxOI/AAAAAAAAa0A/InIY1Qp5h3019QtGpvTjXGnLwYgrmUCBgCLcBGAsYHQ/s1282/Multiple%2BCharts.PNG" alt="" width="1100" /-->
                            <div class="w-100 text-center my-3">
                                <button class="btn btn-outline-warning mx-2">Historial de balance</button>
                                <button class="btn btn-outline-primary mx-2">Ver todas las posiciones</button>
                            </div>
                            <canvas id="myChart" width="100%" height="30vh"></canvas>
                         </div>
                     </div>
                  </div>
             
             
            </div>
        </div>
    </div>
</div>


<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Diciembre','2021','Enero', '2022','Febrero', '2022','Marzo', '2022', 'Abril', '2022'],
            datasets: [{
                data: [100,150, 220, 300, 200, 500,40,120,400,420],
            }]
        },
        options: {
            plugins: {
                legend:{
                    display:false
                }
            }
        }
    });
    </script>

@endsection
