@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('galleries.update', $gallery->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Загаловок</label>
                <input type="text" class="form-control" id="title" name="title" value="{{$gallery->title}}">
            </div>


            <img src="{{ URL::to('/') . '/upload/' .$gallery->photo }}" style="height: 100px; width: 200px; object-fit: cover" alt="">
            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="photo" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
            </div>


            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="status" @if($gallery->status == 1) checked @endif  id="customSwitch1">
                <label class="custom-control-label" for="customSwitch1">Status</label>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
