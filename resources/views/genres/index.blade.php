@extends('layout')

@section('content')
    <div class="card mt-5">
        <h3 class="card-header">Genre</h3>
        <div class="card-body">
            @session('success')
                <div class="alert alert-success" role="alert"> {{ $value }} </div>
            @endsession
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                {{-- For Search --}}
                <form action="{{ route('genres.search') }}" method="get">
                    <input type="text" name="search" placeholder="Search By Genres Name"
                        value="{{ request()->input('search') ? request()->input('search') : '' }}">
                    <button class="btn btn-success btn-sm" type="submit">Search</button>
                   
                </form>
                <a class="btn btn-success btn-sm" href="{{ route('genres.create') }}"> <i class="fa fa-plus"></i>Create New Genres</a>
            </div>
            <table class="table table-bordered table-striped table-responsive text-center">
                <tr>
                    <th>No</th>
                    <th>Genres Name</th>
                    <th>Action</th>
                </tr>
                @php
                    $i = 0;
                @endphp
                @foreach ($genres as $genre)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $genre->name }}</td>
                        <td>
                            <form action="{{ route('genres.destroy', $genre->id) }}" method="POST">
                                <a class="btn btn-info" href="{{ route('genres.show', $genre->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('genres.edit', $genre->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endsection