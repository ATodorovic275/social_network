@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12 mt">
        <div class="content-panel">
          <h4><i class="fa fa-angle-right"></i> Visits</h4>
          {{-- <input type="date" name="" id=""> --}}
          <hr>
          <table class="table">
            <thead>
              <tr>
                <th>User</th>
                <th>Ip</th>
                <th>Url</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($visits as $v)
                    
                
              <tr>
                <td>{{$v->username}}</td>
                <td>{{$v->ip_user}}</td>
                <td>{{$v->url}}</td>
                <td>{{$v->date}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="row">
              <div class="col-lg-12">
                  {{$visits->render()}}
              </div>
          </div>
        </div>
      </div>

      

@endsection()