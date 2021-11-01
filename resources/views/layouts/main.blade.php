<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NTA') }}</title>
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script type="text/javascript">
    /*
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        */
    </script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* Show it is fixed to the top */
body {
  min-height: 75rem;
 /* padding-top: 4.5rem;*/
}
.custom-btn {
	background-color: 	#FF8C00;
	border-color:		#FF8C00;
}
</style>
<script>
    window.setTimeout("sho_clo_time()", 1000);
    function getTime(){
        var time = new Date();
        var dow = time.getDay();
        if(dow==0)
            dow = "Chủ nhật";
        else if (dow==1)
            dow = "Thứ hai";
        else if (dow==2)
            dow = "Thứ ba";
        else if (dow==3)
            dow = "Thứ tư";
        else if (dow==4)
            dow = "Thứ năm";
        else if (dow==5)
            dow = "Thứ sáu";
        else if (dow==6)
            dow = "Thứ bảy";
        var day = time.getDate();
        var month = time.getMonth()+1;
        var year = time.getFullYear();
        var hr = time.getHours();
        var min = time.getMinutes();
        var sec = time.getSeconds();
        day = ((day < 10) ? "0" : "") + day;
        month = ((month < 10) ? "0" : "") + month;
        hr = ((hr < 10) ? "0" : "") + hr;
        min = ((min < 10) ? "0" : "") + min;
        sec = ((sec < 10) ? "0" : "") + sec;
        return dow + ", " + day + "/" + month + "/" + year + " " + hr + ":" + min + ":" + sec;
    }
    function sho_clo_time(){
        var clo_vn_time = document.getElementById("clo_vn_time");
        if (clo_vn_time != null)
            clo_vn_time.innerHTML = getTime();
        setTimeout("sho_clo_time()", 1000);
    }
    </script>
</head>
<body>
    <div id="app" class="container-fluid">
        <header>
                <nav class="navbar border-bottom navbar-expand-lg navbar-light bg-light">
                    <div class="row container-fluid">
                        <div class="col col-lg-3">
                            <a class="navbar-brand" href="#"><img src="{{ asset('img/logo.png') }}" height="80" width="120"></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                        <div class="col-md-auto text-center align-middle">
                            <span class="h6 font-weight-bold">THEO DÕI THÂN NHIỆT</span>
                        </div>
                        <div class="col col-lg-4 text-right">
                            <small id="clo_vn_time" style="font-size: 50%"></small>
                        </div>
                    </div>

                </nav>

        </header>
        <main class="py-4 container-fluid" role="main">
            @yield('content')
        </main>
    </div>
</body>
</html>
