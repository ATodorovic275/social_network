@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12 mt">
        <div class="content-panel">
          <h4><i class="fa fa-angle-right"></i> Actions</h4>
          <form action="{{route('logs_action')}}" method="get">
            <input type="date" name="date_search" id="date_search">
            <input type="submit" value="Search">
          </form>
          <hr>
          <table class="table">
            <thead>
              <tr>
                <th>User</th>
                <th>Action</th>
                <th>Date</th>
                <th>Time</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($actions as $a)
                    
                
              <tr>
                <td>{{$a->username}}</td>
                <td>{{$a->action}}</td>
                <td>{{$a->date}}</td>
                <td>{{$a->time}}</td>

              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="row">
              <div class="col-lg-12">
                  {{$actions->render()}}
              </div>
          </div>
        </div>
      </div>

      

@endsection()