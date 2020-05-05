<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\itemrequests;
use App\items;

class ItemRequestController extends Controller
{

  public function show($id)
  {
    $itemrequest = itemrequests::find($id);
    return view('itemrequests.show', compact('itemrequest'));
  }

  public function destroy($id)
  {
    $itemrequest = itemrequests::find($id);
    $itemrequest->delete();
    return redirect('/itemrequests')->with('success','Item request has been deleted');
  }



  public function filter(Request $request)
  {
    $requestQuery = itemrequests::all();

    if(!empty($request->input('statefilters')))
    {
      $statefilter = collect();
      foreach($request->input('statefilters') as $filter)
      {
        $filtered = $requestQuery->where('requeststate', '=', $filter);

        $statefilter = $statefilter->toBase()->merge($filtered);
      }
      $requestQuery = $statefilter;
    }
    return view('itemrequests.index', array('itemrequests'=>$requestQuery));
  }







public function update(Request $request, $id)
{

  $itemrequest = itemrequests::find($id);
  $this->validate(request(),
  [
    'requeststate' => Rule::in(config('enums.itemRequestStates')),
  ]);
  $itemrequest->requeststate = $request->input('requeststate');
  $itemrequest->save();
  return redirect('/itemrequests')->with('success','itemrequest has been updated');

}


  public function index()
  {
    $itemrequestsQuery = itemrequests::all();
  /*  if(Gate::denies('displayall'))
    {
        $itemsQuery=$itemsQuery->where('userid',auth()->user()->id);
    }*/
    return view('itemrequests.index', array('itemrequests'=>$itemrequestsQuery));
  }

  public function create($id)
  {

    return view('itemrequests.newRequest', array('id'=>$id));
  }

  public function store(Request $request, $id)
  {
    $item = items::find($id);

    $itemrequest = $this->validate(request(),
    [
      'reason' => 'required|string',
    ]);

    $itemrequest = new itemrequests;
    $itemrequest->requeststate = 'open';
    $itemrequest->reason = $request->input('reason');
    $itemrequest->itemid = $item->id;
    $itemrequest->userid = auth()->user()->id;

    $itemrequest->save();

    return redirect('/items')->with('success','itemrequest has been updated');

  }
}
