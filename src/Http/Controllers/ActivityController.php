<?php namespace Thanosalexander\Activity\Http\Controllers;

use Illuminate\Routing\Controller;
use Thanosalexander\Activity\Http\Requests\Activity\CreateActivityRequest;
use Thanosalexander\Activity\Http\Requests\Activity\UpdateActivityRequest;
use Thanosalexander\Activity\models\Activity as ActivityModel;

class ActivityController extends Controller
{

    public function index()
    {
        return ActivityModel::all()->toJson();
    }

    public function show($id)
    {
        $activity = ActivityModel::find($id);

        if(!$activity)  return response()->json(['message'=>'Activity with given id not found'],404);

        return ActivityModel::whereId($id)->with('type')->first()->toJson();
    }

    public function store(CreateActivityRequest $request)
    {
        $activity = ActivityModel::create($request->all());

        return ActivityModel::whereId($activity->id)->with('type')->first()->toJson();
    }

    public function update($id,UpdateActivityRequest $request)
    {
        $activity = ActivityModel::find($id);

        if(!$activity)  return response()->json(['message'=>'Activity with given id not found'],404);

        $activity = $activity->update($request->all());

        return ActivityModel::whereId($activity->id)->with('type')->first()->toJson();
    }

    public function delete($id)
    {
        $activity = ActivityModel::find($id);

        if(!$activity) return response()->json(['message'=>'Activity with given id not found'],404);

        $activity->delete();

        return response()->json(['message'=>'Activity deleted'],200);
    }
}