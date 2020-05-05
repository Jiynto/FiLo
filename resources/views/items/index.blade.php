@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
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

              <form method="POST" action="{{ action('ItemController@filter')}}" enctype="multipart/form-data">
                @csrf
                <label> Categories: </label><br>
                @foreach(config('enums.itemCategory') as $category)
                <input type="checkbox" name = "categoryfilters[]" value="{{$category}}">
                <label > {{$category}} </label><br>
                @endforeach


                <label> Color: </label><br>
                @foreach(config('enums.itemColor') as $color)
                <input type="checkbox" name = "colorfilters[]" value="{{$color}}">
                <label > {{$color}} </label><br>
                @endforeach

                <button class="btn btn-primary" type="submit"> Filter </button>

              </form>

            </div>
            <div class= "col-sm-10">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th> id</th><th> User-id</th><th> Category</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($items as $item)
                  <tr data-href="{{action('ItemController@show', $item['id'])}}">
                    <td> {{$item->id}}</td>
                    <td> {{$item->userid}}</td>
                    <td> {{$item->category}}</td>
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

<script>
  document.addEventListener("DOMContentLoaded", () =>
  {
    const rows = document.querySelectorAll("tr[data-href]");

    rows.forEach(row =>
    {
      row.addEventListener("click", () =>
      {
        window.location.href = row.dataset.href;
      });
    });
  });
</script>


@endsection
