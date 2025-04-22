@extends('layout')

@section('content')
    <div class="card mt-5">
        <h3 class="card-header">Actors</h3>
        <div class="card-body">
            @session('success')
                <div class="alert alert-success" role="alert"> {{ $value }} </div>
            @endsession
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                {{-- For Search --}}
                <form action="{{ route('actors.search') }}" method="get">
                    <input type="text" name="search" placeholder="Search By actors Name"
                        value="{{ request()->input('search') ? request()->input('search') : '' }}">
                    <button class="btn btn-success btn-sm" type="submit">Search</button>
                    
                </form>
                <a class="btn btn-success btn-sm" href="{{ route('actors.create') }}"> <i class="fa fa-plus"></i>Create New Actors</a>
            </div>
            <table class="table table-bordered table-striped table-responsive text-center">
                <tr>
                    <th>No</th>
                    <th>Actor Name</th>
                    <th>Action</th>
                </tr>
                @php
                    $i = 0;
                @endphp
                @foreach ($actors as $actor)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $actor->name }}</td>
                        <td>
                            <form action="{{ route('actors.destroy', $actor->id) }}" method="POST">
                                <a class="btn btn-info" href="{{ route('actors.show', $actor->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('actors.edit', $actor->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endsection