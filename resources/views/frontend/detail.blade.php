<!-- Menghubungkan dengan view template master -->
@extends('/frontend/layouts/master')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->


<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')

<div class="container">
    
    <div class="card mt-3" id="bungkus">
        <div class="card-header" id="banner_top">
            <h3 class="card-title">{{$komik->judul_komik}}</h3>
        </div>
        <div class="card-body">
                        <div class="row">
                <div class="col-md-4">
                    <img src="/data_gambar/cover/{{$komik->cover}}" width="90%" height="450">
                </div>

                <div class="col-md-8">
                    <div id="title_manga">
                        <h5>Author <a id="judul_detail1">: {{$komik->author}}</a></h5>
                        <h5>Release <a id="judul_detail2">: {{$komik->tahun}}</a></h5>
                        <h5>Status <a id="judul_detail3">: {{$komik->status}}</a></h5>
                        <h5>Genre <a id="judul_detail4">: 
                            @foreach ($komik->genre as $genre)
                                {{$genre->nama_genre}},
                            @endforeach
                        </a></h5>

                        <div class="row">
                        <div class="col-md-12" id="iklan_detail">
                            <img class="img-fluid" src="/img/iklan/iklan8.jpg" width="680" height="180">
                        </div>
                        </div>
                    </div>
                </div>

            </div>


            <br>

            <h4 id="judul_manga">Sinopsis</h4>
            <div class="row">
                <div class="col-md-12">
                    <div id="title_manga" class="text-justify">
                        <h5>{{$komik->sinopsis}}</h5>
                    </div>
                </div>
            </div>

            <br>
            
            <h4 id="judul_manga">Chapter</h4>
            @foreach ($chapter as $c)
                <div class="alert alert-primary mt-1 mb-1 ml-2 mr-2 pt-1 pl-3 pb-1" role="alert">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="title_manga">
                                <a href="/baca/{{$komik->id}}/{{$c->id}}"><h5 class="m-0 p-0">Chapter {{$c->ch}}</h5></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-right">
                                <button type="button" class="btn btn-warning text-white" id="unduh">
                                    <i class="fa fa-download"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>

@endsection