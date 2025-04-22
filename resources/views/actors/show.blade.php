@extends('layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h4> Show Actor</h4>
            <br>
        </div>

    </div>
</div>
<table width="400">
    <tr>
        <td><strong>Actor Name</strong> </td>
        <td> {{ $actor->name }} </td>
    </tr>
</table>
<br>
<div class="pull-right">
    <a class="btn btn-primary" href="{{ route('actors.index') }}"> Back</a>
</div>
@endsection