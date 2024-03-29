@extends('/backend/layouts/t_index')

@section('isi')
    
    <div class="container">
            <div class="card mt-5" id="bungkus">
                <div class="card-header text-center" id="banner_top">
                    CRUD Data Manga - <strong>CHANGE DATA</strong> - <a href="https://www.malasngoding.com/category/laravel" target="_blank">www.nakamanga.com</a>
                </div>
                <div class="card-body">
                    <a href="/chapter" class="btn btn-primary"><i class="fa fa-arrow-left"> Back</i></a>
                    <br/>
                    <br/>
                    
                <form method="POST" action="/chapter/update/{{ $chapter->id }}">

                        {{ csrf_field() }}
                        
                        <input type="hidden" name="ch" value="{{ $chapter->ch }}">
                        <div class="form-group">
                            <label>Chapter</label>
                            <input type="number" name="ch" class="form-control" placeholder="Chapter .." value="{{ $chapter->ch }}" disabled style="background-color: #00183e;">

                            @if($errors->has('chapter'))
                                <div class="text-danger">
                                    {{ $errors->first('chapter')}}
                                </div>
                            @endif
                        </div>
						
						<div class="form-group">
                            <label>Link File PDF</label>
                            <input type="text" name="link_file" class="form-control" placeholder="Link File .." value="{{ $chapter->link_file }}" autocomplete="off">

                            @if($errors->has('link_file'))
                                <div class="text-danger">
                                    {{ $errors->first('link_file')}}
                                </div>
                            @endif
                        </div>

                        <input type="hidden" name="user_id" class="form-control" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <button id="submitChapter" type="submit" class="btn btn-primary">
                                <i class="fa fa-save"> Save</i>
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

@endsection