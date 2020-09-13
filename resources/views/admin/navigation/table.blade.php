@extends('layouts.admin')
@section('content')
<div class="row mt">
    <div class="col-md-12">
      <div class="content-panel">
        <h4><i class="fa fa-angle-right"></i> Navigations</h4><hr><table class="table table-striped table-advance table-hover">
            @php
                
                if(session()->has('message')){
                    session()->all()    ;
                }
            @endphp
           
          <thead>
            <tr>
              <th>Name</th>
              <th>Path</th>
              <th>Position</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($navigations as $n)
              <tr>
                <td>
                  {{$n->name}}
                </td>
                <td>
                    {{$n->href}}
                  </td>
                  <td>
                    {{$n->position}}
                  </td>
                
              </tr>
              @endforeach
            
           
          </tbody>
        </table>
      
      </div>
      <!-- /content-panel -->
    </div>
    <!-- /col-md-12 -->
  </div>

@endsection