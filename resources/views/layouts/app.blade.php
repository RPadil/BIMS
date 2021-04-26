<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', "Bestein's Inventory Management System") }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style type="text/css">
    .centered {
    text-align: center;
  }
</style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('logo.png') }}" style="width: 220px; height: 75px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <!-- Inventory -->
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Inventory
                          </a>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('suppliers.index') }}">In/Purchasing</a>
                            <a class="dropdown-item" href="{{ route('suppliers.index') }}">Out</a>
                            <a class="dropdown-item" href="{{ route('suppliers.index') }}">Returns</a>
                          </div>
                        </li>
                        <!-- Settings-->
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Settings
                          </a>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('suppliers.index') }}">Suppliers</a>
                            <a class="dropdown-item" href="{{ route('categories.index') }}">Product Categories</a>
                            <a class="dropdown-item" href="{{ route('subcategories.index') }}">Product Sub Categories</a>
                            <a class="dropdown-item" href="{{ route('sku.index') }}">SKUs</a>
                            <a class="dropdown-item" href="{{ route('item.index') }}">Items</a>
                          </div>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
      $(document).ready(function() {
      $('#cat_id').on('change', function() {
          var getStId = $(this).val();
          if(getStId) {
              $.ajax({
                  url: '/subcatdd/'+getStId,
                  type: "GET",
                  data : {"_token":"{{ csrf_token() }}"},
                  dataType: "json",
                  success:function(data) {
                      // console.log(data);
                    if(data){
                      $('#subcat_id').empty();
                      $('#subcat_id').focus;
                      $('#subcat_id').append('<option value="">-- Select Sub Category --</option>'); 
                      $.each(data, function(key, value){
                      $('select[name="subcat_name"]').append('<option value="'+ value.subcat_id +'">' + value.subcat_name+ '</option>');
                  });
                }else{
                  $('#subcat_id').empty();
                }
                }
              });
          }else{
            $('#subcat_id').empty();
          }
      });

      $('#subcat_id').on('change', function() {
          var catid = $('#cat_id').val();
          var subcatid = $(this).val();
          console.log(catid + '~~' + subcatid);
          if(catid && subcatid) {
              $.ajax({
                  url: '/subcatskudd/'+catid+'/'+subcatid,
                  type: "GET",
                  data : {"_token":"{{ csrf_token() }}"},
                  dataType: "json",
                  success:function(data) {
                      console.log(data);
                    if(data){
                      $('#sku_id').empty();
                      $('#sku_id').focus;
                      $('#sku_id').append('<option value="">-- Select SKU --</option>'); 
                      $.each(data, function(key, value){
                      $('select[name="sku_name"]').append('<option value="'+ value.sku_id +'">' + value.sku_name+ '</option>');
                      });
                    }else{
                      $('#sku_id').empty();
                    }
                  }
              });
          }else{
            $('#sku_id').empty();
          }
      });
  });
</script>
