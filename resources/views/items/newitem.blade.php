@extends('layouts.app')
<!--define the content section -->
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10 ">
      <div class="card">
        <div class="card-header">Create an new item</div>
        <!--display the errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul> @foreach ($errors->all() as $error)
            <li>{{ $error }}</li> @endforeach
          </ul>
        </div><br /> @endif


        <!--display the success status -->
        @if (\Session::has('success'))
        <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
        </div><br /> @endif


        <!--define the form -->
        <div class="card-body">
          <form class="form-horizontal" method="POST"
          action="{{url('items')}}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-8">
              <label>Item category</label>
              <select name="category">
                <option value="pet">Pet</option>
                <option value="jewellery">Jewellery</option>
                <option value="phone">Phone</option>
                <option value="other">Other</option>
              </select>
            </div>
            <div class="col-md-8">
              <label >Date found</label>
              <input type="date" name="found_date"/>
            </div>
            <div class="col-md-8">
              <label >Time found</label>
              <input type="time" name="found_time"/>
            </div>
            <div class="col-md-8">
              <label >Place found</label>
              <input type="text" name="found_place"
              placeholder="Place found" />
            </div>
            <div class="col-md-8">
              <label >Color</label>
              <select name="color">
                <option value="other">Other</option>
                <option value="black">Black</option>
                <option value="white">White</option>
                <option value="grey">Grey</option>
                <option value="red">Red</option>
                <option value="orange">Orange</option>
                <option value="brown">Brown</option>
                <option value="yellow">Yellow</option>
                <option value="green">Green</option>
                <option value="cyan">Cyan</option>
                <option value="blue">Blue</option>
                <option value="purple">Purple</option>
                <option value="magenta">Magenta</option>
              </select>
            </div>
            <div class="col-md-8">
              <label >Description</label>
              <textarea rows="4" cols="50" name="description">description of the item
              </textarea>
            </div>
            <div class="col-md-8">
              <label>Image</label>
              <input type="file" name="image" placeholder="Image file" />
            </div>
            <div class="col-md-6 col-md-offset-4">
              <input type="submit" class="btn btn-primary" />
              <input type="reset" class="btn btn-primary" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
