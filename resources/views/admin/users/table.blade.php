@extends('layouts.admin')
@section('content')
<div class="row mt">
    <div class="col-md-12">
      <div class="content-panel">
        <h4><i class="fa fa-angle-right"></i> Users</h4><hr><table class="table table-striped table-advance table-hover">
            @php
                
                if(session()->has('message')){
                    session()->all()    ;
                }
            @endphp
            <form action="/admin/user" method="get">
              <input type="search" name="user_search" id="user_search">
              <input type="submit" value="Search username">
            </form>
          <thead>
            <tr>
              <th>First name</th>
              <th class="hidden-phone"> Last name</th>
              <th> username</th>
              <th> email</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
              @foreach ($users as $u)
              <tr>
                <td>
                  {{$u->first_name}}
                </td>
                <td class="hidden-phone">{{$u->last_name}}</td>
                <td>{{$u->username}}</td>
                <td>{{$u->email}}</td>
                <td>
                <a href="{{ url("/admin/user") }}/{{$u->id_user}}/delete"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a>
                </td>
              </tr>
              @endforeach
            
           
          </tbody>
        </table>
        <div class="row">
          <div class="col-lg-12">
              {{$users->render()}}
          </div>
      </div>
      </div>
      <!-- /content-panel -->
    </div>
    <!-- /col-md-12 -->
  </div>

@endsection