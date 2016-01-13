<?php

namespace Thanosalexander\Activity\Activity\Types;
use Illuminate\Support\Facades\DB;
use Thanosalexander\Activity\Exceptions\Type\CreateTypeException;
use Thanosalexander\Activity\Exceptions\Type\NullDataException;
use Thanosalexander\Activity\models\Type as TypeModel;

class Type
{

    protected $fields = [
        'name',
        'description',
        'label'
    ];


    /**
     * Creates a type
     *
     * @param null|array $data
     * @return null|TypeModel
     */
    public function create($data=null)
    {
        DB::beginTransaction();

        try {

            if (is_null($data)) throw new NullDataException('The data array is required!');

            foreach ($data as $k => $v) {
                if (!in_array($k, $this->fields)) throw new CreateTypeException('Please add the correct fields!');
            }

            if (count(array_keys($data)) != count($this->fields)) throw new CreateTypeException('The number of given data is different than required!');

            if (TypeModel::whereName($data['name'])->first()) throw new CreateTypeException('The type name already exists!');

            $type = TypeModel::create($data);

            DB::commit();

            return $type;
        }
        catch(NullDataException $e)
        {
            DB::rollBack();

            return $e;
        }
        catch(CreateTypeException $e)
        {
            DB::rollBack();

            return $e;
        }
    }

    /**
     * All types
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return TypeModel::all();
    }

    /**
     * Find Type by Type id or Type name
     *
     * @param int|string $type
     * @return null | TypeModel
     */
    public function find($type)
    {
        if(is_int($type) && TypeModel::find($type)) return TypeModel::find($type);

        if(TypeModel::whereName($type)->first()) return TypeModel::whereName($type)->first();

        return null;
    }


    /**
     * Deletes a type
     *
     * @param $type
     * @return null|boolean
     */
    public function delete($type)
    {
        if(is_int($type) && TypeModel::find($type)) return TypeModel::find($type)->delete();

        if($type instanceof TypeModel) $type->delete();

        if(TypeModel::whereName($type)->first()) return TypeModel::whereName($type)->first()->delete();

        return null;
    }

    /**
     * Truncates Table
     *
     * @return boolean
     */
    public function truncate()
    {
        DB::beginTransaction();

        try{
            TypeModel::truncate();

            DB::commit();

            return true;
        }
        catch(\Exception $e)
        {
            DB::rollBack();

            return false;
        }
    }

}