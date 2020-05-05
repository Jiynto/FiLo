<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Gate;
use App\items;

class ItemController extends Controller
{
    //

  public function show($id)
  {
    if(Gate::allows('isloggedin'))
    {
      $item = items::find($id);
      return view('items.show', compact('item'));
    }
    else
    {
        return view('auth.register');
    }

  }

  public function destroy($id)
  {
    $item = items::find($id);
    $item->delete();
    return redirect('/items')->with('success','Item has been deleted');
  }







public function update(Request $request, $id)
{
  $item = items::find($id);
  $this->validate(request(),
  [
    'category' => Rule::in(config('enums.itemCategory')),
    'found_date' => 'required|date',
    'found_time' => 'required',
    'found_place' => 'required|string',
    'color' => 'nullable',
    'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
    'description' => 'nullable|string',
  ]);

  if ($request->hasFile('image'))
  {
    $fileNameWithExt = $request->file('image')->getClientOriginalName();
    $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    $extension = $request->file('image')->getClientOriginalExtension();
    $fileNameToStore = $filename.'_'.time().'.'.$extension;
    $path =$request->file('image')->storeAs('public/images', $fileNameToStore);
  }
  else
  {
    $fileNameToStore = 'noimage.jpg';
  }
  $item->category = $request->input('category');
  $item->found_date = $request->input('found_date');
  $item->found_time = $request->input('found_time');
  $item->found_place = $request->input('found_place');
  $item->userid = auth()->user()->id;
  $item->color = $request->input('color');
  $item->image = $fileNameToStore;
  $item->description = $request->input('description');
  $item->save();

  return redirect('/items')->with('success','item has been updated');

}


public function edit($id)
{
  $item = items::find($id);
  if(Gate::allows('isOwner', $item->userid) || Gate::allows('isadmin'))
  {
    return view('items.edit', compact('item'));
  }
  else
  {
    return view('auth.register');
  }
}





  public function filter(Request $request)
  {
    $itemsQuery = items::all();

    if(!empty($request->input('categoryfilters')))
    {
      $categoryfilter = collect();
      foreach($request->input('categoryfilters') as $filter)
      {
        $filtered = $itemsQuery->where('category', '=', $filter);

        $categoryfilter = $categoryfilter->toBase()->merge($filtered);
      }
      $itemsQuery = $categoryfilter;
    }



    if(!empty($request->input('colorfilters')))
    {
      $colorfilter = collect();
      foreach($request->input('colorfilters') as $filter)
      {
        $filtered = $itemsQuery->where('color', '=', $filter);

        $colorfilter = $colorfilter->toBase()->merge($filtered);
      }
      $itemsQuery = $colorfilter;
    }
    return view('items.index', array('items'=>$itemsQuery));
  }







  public function index()
  {
    $itemsall = items::all();
    return view('items.index', array('items'=>$itemsall));
  }





  public function create()
  {

    if(Gate::allows('isloggedin'))
    {
        return view('items.newitem');
    }
    else
    {
        return view('auth.register');
    }


  }

  public function store(Request $request)
  {
    $item = $this->validate(request(),
    [
      'category' => Rule::in(config('enums.itemCategory')),
      'found_date' => 'required|date',
      'found_time' => 'required',
      'found_place' => 'required|string',
      'color' => 'nullable',
      'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
      'description' => 'nullable|string',
    ]);

    if ($request->hasFile('image'))
    {
      $fileNameWithExt = $request->file('image')->getClientOriginalName();
      $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
      $extension = $request->file('image')->getClientOriginalExtension();
      $fileNameToStore = $filename.'_'.time().'.'.$extension;
      $path =$request->file('image')->storeAs('public/images', $fileNameToStore);
    }
    else
    {
      $fileNameToStore = 'noimage.jpg';
    }

    $item = new items;

    $item->category = $request->input('category');
    $item->found_date = $request->input('found_date');
    $item->found_time = $request->input('found_time');
    $item->found_place = $request->input('found_place');
    $item->userid = auth()->user()->id;
    $item->color = $request->input('color');
    $item->image = $fileNameToStore;
    $item->description = $request->input('description');
    $item->save();

    return back()->with('success', 'Item has been added');

  }

}
