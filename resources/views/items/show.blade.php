@extends('layouts.app')
@section('content')
<div class = "container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header">Display all items</div>
        <div class="card-body">
          <table class="table table-striped" border="1" >
            <tr> <td> <b>Id </th> <td> {{$item->id}}</td></tr>
            <tr> <td> <b>Category </th> <td> {{$item['category']}}</td></tr>
            <tr> <td> <b>Date Found </th> <td> {{$item->found_date}}</td></tr>
            <tr> <td> <b>Time Found </th> <td> {{$item->found_time}}</td></tr>
            <tr> <td> <b>Place Found </th> <td> {{$item->found_place}}</td></tr>
            <tr> <td> <b>Color </th> <td> {{$item['color']}}</td></tr>
            <tr> <td> <b>Userid </th> <td> {{$item->userid}}</td></tr>
            <tr> <th>Description </th> <td style="max-width:150px;" >{{$item->description}}</td></tr>
            <tr>
              <td colspan='2' >
                <img style="width:100%;height:100%" src="{{ asset('storage/images/'.$item->image)}}">
              </td>
            </tr>
          </table>
          <table>
            <tr>
              <td>
                <a href="{{url('items')}}" class="btn btn-primary" role="button">Back to the list
                </a>
              </td>
              @if(auth()->user()->role || auth()->user()->id == $item->userid)
              <td>
                <a href="{{action('ItemController@edit', $item['id'])}}" class="btn btn-warning">Edit
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
              @endif

              @if(auth()->user()->role || auth()->user()->id != $item->userid)
              <td>
                <a href="{{action('ItemRequestController@create', $item['id'])}}" class="btn btn-warning">Request
                </a>
              </td>
              @endif
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
