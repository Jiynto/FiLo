@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">Dashboard</div>
        <div class="card-body">
        @if (session('status'))
          <div class="alert alert-success">
            {{session('status')}}
          </div>
        @endif
          <div class="row">
            <div class= "col-sm-2">

              <form method="POST" action="{{ action('ItemRequestController@filter')}}" enctype="multipart/form-data">
                @csrf
                <label> State: </label><br>
                @foreach(config('enums.itemRequestStates') as $state)
                <input type="checkbox" name = "statefilters[]" value="{{$state}}">
                <label > {{$state}} </label><br>
                @endforeach
                <button class="btn btn-primary" type="submit"> Filter </button>
              </form>

            </div>

            <div class= "col-sm-10">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th> id</th><th> User-id</th><th> Item-id</th><th> Requeststate</th><th> Reason </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($itemrequests as $itemrequest)
                  <tr>
                    <td> {{$itemrequest->id}}</td>
                    <td> {{$itemrequest->userid}}</td>
                    <td> {{$itemrequest->itemid}}</td>
                    <td> {{$itemrequest->requeststate}}</td>
                    <td> {{$itemrequest->reason}}</td>
                    <td>
                      <form class="form-horizontal" method="POST" action="{{ action('ItemRequestController@update',$itemrequest['id']) }} " enctype="multipart/form-data" >
                        @method('PATCH')
                        @csrf
                        <input name="requeststate" value='approved' type="hidden">
                        <button class="btn btn-primary" type="submit"> Approve</button>
                      </form>
                      <!--<a href="{{action('ItemRequestController@update', $itemrequest['id']), 'true'}}" class="btn btn-warning">Approve</a>-->
                    </td>
                    <td>
                      <form class="form-horizontal" method="POST" action="{{ action('ItemRequestController@update',$itemrequest['id']) }} " enctype="multipart/form-data" >
                        @method('PATCH')
                        @csrf
                        <input name="requeststate" value='rejected' type="hidden">
                        <button class="btn btn-primary" type="submit"> Disapprove</button>
                      </form>
                      <!--<a href="{{action('ItemRequestController@update', $itemrequest['id']), 'false'}}" class="btn btn-warning">Disapprove</a>-->
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
