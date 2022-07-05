@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')


    <a href="{{route('galleries.create')}}" class="btn btn-success" style="margin-bottom: 20px;">Создать</a>
    <table id="example" class="stripe cell-border" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Image</th>
            <th>Status</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>



     @foreach(\App\Models\Gallery::get() as $gallery)
         <tr>
             <td>{{$gallery->id}}</td>
             <td>{{$gallery->title}}</td>
             <td><img src="{{ URL::to('/') . '/upload/' .$gallery->photo }}" style="height: 200px; width: 200px; object-fit: contain" alt=""></td>
             <td>@if($gallery->status == 1) <span class="badge bg-success">ON</span> @else <span class="badge bg-danger">OFF</span> @endif</td>
             <td>{{$gallery->created_at->diffForHumans()}}</td>
             <td>
                 <a href="{{route('galleries.edit', $gallery->id)}}" class="btn btn-info">Edit</a>
                 <form class="d-inline" action="{{route('galleries.destroy', $gallery->id)}}" method="POST">
                     @csrf
                     @method('DELETE')

                     <button type="submit" class="btn btn-danger">
                        Delete
                     </button>
                 </form>
             </td>
         </tr>
     @endforeach

        </tbody>



    </table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> $(document).ready(function () {
            $('#example').DataTable();
        }); </script>
@stop
