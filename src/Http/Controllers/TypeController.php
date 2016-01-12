<?php namespace Thanosalexander\Activity\Http\Controllers;

use Football\Http\Controllers\Controller;
use Thanosalexander\Activity\Http\Requests\Type\CreateTypeRequest;
use Thanosalexander\Activity\Http\Requests\Type\UpdateTypeRequest;
use Thanosalexander\Activity\models\Type as TypeModel;

class TypeController extends Controller
{

    public function index()
    {
        return TypeModel::all()->toJson();
    }

    public function show($id)
    {
        $type = TypeModel::find($id);

        if(!$type)  return response()->json(['message'=>'Type with given id not found'],404);

        return $type->toJson();
    }

    public function store(CreateTypeRequest $request)
    {
        $activity = TypeModel::create($request->all());

        return TypeModel::whereId($activity->id)->first()->toJson();
    }

    public function update($id,UpdateTypeRequest $request)
    {
        $activity = TypeModel::find($id);

        if(!$activity)  return response()->json(['message'=>'Activity with given id not found'],404);

        $activity = $activity->update($request->all());

        return TypeModel::whereId($activity->id)->first()->toJson();
    }

    public function delete($id)
    {
        $activity = TypeModel::find($id);

        if(!$activity) return response()->json(['message'=>'Activity with given id not found'],404);

        $activity->delete();

        return response()->json(['message'=>'Activity deleted'],200);
    }
}