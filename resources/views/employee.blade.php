@extends('base.base_dash')
@section('title')
    Employee
@endsection

@section('content')
    <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
        <main class="main-content border-radius-lg">
            <div class="section position-relative transform-scale-0 transform-scale-md-7">
                <div class="container">
                    <div class="row">
                        <div class="ms-auto">
                            <img class="w-50 float-end mt-lg-n4" src="../assets/img/small-logos/icon-sun-cloud.png"
                                alt="image sun">
                        </div>
                        <div class="col-lg-8 col-md-11">
                            <div class="d-flex">
                                <div class="me-auto">
                                    <h1 class="display-1 font-weight-bold mt-n4 mb-0">28°C</h1>
                                    <h6 class="text-uppercase mb-0 ms-1">Cloudy</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-12 col-md-12 mt-4 mt-sm-0">
                            <div class="card bg-gradient-dark move-on-hover">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h5 class="mb-0 text-white">
                                            <span id="hour" class="reverse">00</span>:
                                            <span id="min" class="reverse">00</span>
                                            <span id="sec" class="reverse"></span>
                                            <span id="section" class="section">AM</span>
                                            <div class="week"></div>
                                        </h5>
                                        <div class="ms-auto">
                                            <h1 class="text-white text-end mb-0 mt-n2" id="day"></h1>
                                            <p class="text-sm mb-0 text-white" id="month"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </main>

        <script>
            function display(){
                let days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']
                let months = ['January','Febuary','March','April','May','June','July','August','September','October','November','December']
                const dateTime = new Date();
                let hour = dateTime.getHours();
                let min = dateTime.getMinutes();
                let sec = dateTime.getSeconds();
                let month = months[dateTime.getMonth()] ;
                let day = dateTime.getDate();
                let week = days[dateTime.getDay()];
                let year = dateTime.getFullYear();
                let section = document.getElementById('section')

                if(hour >= 12){
                    section.innerHTML = 'PM';
                }else{
                    section.innerHTML = 'AM';
                };
                
                let zero_hour = hour <= 9 ? '0' : '';
                let zero_min = min <= 9 ? '0' : '';

                document.getElementById('hour').innerHTML = zero_hour + hour;
                document.getElementById('min').innerHTML =  zero_min + min;
                // document.getElementById('sec').innerHTML = sec;
                document.getElementById('month').innerHTML = month;
                document.getElementById('day').innerHTML = day;
                document.getElementById('year').innerHTML = year;
                document.querySelector('.week').innerHTML = week;
                document.getElementById("time").innerHTML = d.toLocaleTimeString();
            
            }
            setInterval(display,10)
        </script>

    </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Employees</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Employees</h6>
                </nav>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Employees Time &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" type="button" 
                                class="text-secondary font-weight-bold text-xs btn btn-primary text-white" id="sync">Sync</a></h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Name</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Date</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Time In</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Time Out</th>
                                        </tr>
                                    </thead>
                                    <tbody id="get_user_time">
                                        <!-- append the data here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/ajax_emp.js') }}"></script>
@endsection
