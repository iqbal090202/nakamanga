<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Nakamanga</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('DataTables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">
                <a  href="{{ url('/home') }}">
                    <img src="/img/logo/logo_3.png" width="250" height="50" alt="Logo Nakamanga">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('komik') }}">Manga</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('chapter') }}">Chapter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('genre') }}">Genre</a>
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
            @yield('isi')
        </main>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('DataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('DataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/nakamanga.js') }}"></script>
    <script type="text/javascript">
        $('.table').DataTable({
            scrollX: true,
        });

        $('#selectKomik').change(function () {

            const id = $(this).val();
            $('#tambahCh').attr('href', '{{ url("/chapter/tambah") }}'+'/'+id);

            $.ajax({
                url: '{{ url("chapter/getKomik") }}'+'/'+id,
                method: 'get',
                dataType: 'html',
                success: function (response) {
                    $('#showKomik').html(response);
                }
            });

        });

        function hapusKomik(id){
            if(confirm("Apakah Anda yakin ?") == true) {
                let url = "/komik/hapus/"+id
                $(location).attr('href', url);
            }
        }
        function hapusChapter(id){
            if(confirm("Apakah Anda yakin ?") == true) {
                let url = '/chapter/hapus/'+id
                $(location).attr('href', url);
            }
        }
        function hapusGambar(komik_id,ch,id){
            if(confirm("Apakah Anda yakin ?") == true) {
                let url = '/gambar/hapus/'+komik_id+'/'+ch+'/'+id
                $(location).attr('href', url);
            }
        }
        function hapusGenre(id){
            if(confirm("Apakah Anda yakin ?") == true) {
                let url = '/genre/hapus/'+id
                $(location).attr('href', url);
            }
        }
    </script>
</body>
</html>
