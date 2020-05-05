@extends('layouts.app')
@section('content')
<div class = "container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header">Display all request</div>
        <div class="card-body">
          <table class="table table-striped" border="1" >
            <tr> <td> <b>Id </th> <td> {{$itemrequest->id}}</td></tr>
            <tr> <td> <b>Itemid </th> <td> {{$itemrequest->itemid}}</td></tr>
            <tr> <td> <b>Userid </th> <td> {{$itemrequest->userid}}</td></tr>
            <tr> <th>Reason </th> <td style="max-width:150px;" >{{$itemrequest->reason}}</td></tr>
            <tr> <td> <b>State </th> <td> {{$itemrequest['requeststate']}}</td></tr>
          </table>
          <table>
            <tr>
              <td>
                <a href="{{route('itemrequests.index')}}" class="btn btn-primary" role="button">Back to the list
                </a>
              </td>
              <td>
                <a href="{{action('ItemRequestController@edit', $itemrequest['id'])}}" class="btn btn-warning">
                </a>
              </td>
              <td>
                <form action="{{action('ItemController@destroy', $item['id'])}}" method="post">
                 @csrf
                 <input name="_method" type="hidden" value="DELETE">
                 <button class="btn btn-danger" type="submit">Delete
                 </button>
                </form>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
