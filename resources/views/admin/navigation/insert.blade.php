@extends('layouts.admin')
@section('content')
<div class="row mt">
    <div class="col-lg-6 col-md-6 col-sm-6">
      <h4 class="title">Add navigation</h4>
      <div id="message"></div>
      <form class="contact-form php-mail-form" role="form" action="{{route('navigation.store')}}" method="POST">
        @csrf
        <div class="form-group">
          <input type="text" name="name" class="form-control" id="name" placeholder="Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
          <div class="validate"></div>
        </div>
        <div class="form-group">
          <input type="texe" name="path" class="form-control" id="path" placeholder="Path" data-rule="email" data-msg="Please enter a valid email">
          <div class="validate"></div>
        </div>
        <div class="form-group">
          <input type="text" name="position" class="form-control" id="position" placeholder="Position" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject">
          <div class="validate"></div>
        </div>

        <div class="form-send">
          <button type="submit" class="btn btn-large btn-primary">Save</button>
        </div>

      </form>
    </div>

    


@endsection()