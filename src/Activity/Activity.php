<?php namespace Thanosalexander\Activity\Activity;

use Thanosalexander\Activity\Exceptions\Activity\CreateActivityException;
use Thanosalexander\Activity\Exceptions\Activity\NullDataException;
use Thanosalexander\Activity\models\Activity as ActivityModel;
use Thanosalexander\Activity\models\Type as TypeModel;
use Illuminate\Support\Facades\DB;


class Activity
{

    protected $fields = [
        'type_id',
        'user_id',
        'content',
        'ip'
    ];

    /**
     * Creates an activity
     *
     * @param null|array $data
     * @return null|ActivityModel
     */
    public function create($data=null)
    {
        DB::beginTransaction();

        try {

            if (is_null($data)) throw new NullDataException('The data array is required!');

            foreach ($data as $k => $v) {
                if (!in_array($k, $this->fields)) throw new CreateActivityException('Please add the correct fields!');
            }

            if (count(array_keys($data)) != count($this->fields)) throw new CreateActivityException('The number of given data is different than required!');

            $this->checkFields($data);

            $activity = ActivityModel::create($data);

            DB::commit();

            return $activity;
        }
        catch(NullDataException $e)
        {
            DB::rollBack();

            return $e;
        }
        catch(CreateActivityException $e)
        {
            DB::rollBack();

            return $e;
        }
    }

    /**
     * Checkf fields
     *
     * @param array $data
     * @throws CreateActivityException
     */
    private function checkFields($data)
    {
        if(!$this->typeExists($data['type_id'])) throw new CreateActivityException('The type doesn\'t exist');

        if(!$this->isIp($data['ip'])) throw new CreateActivityException('The ip is not valid');
    }

    /**
     * Check Ip address
     *
     * @param $ip
     * @return boolean
     */
    public function isIp($ip)
    {
        return (!filter_var($ip, FILTER_VALIDATE_IP) === false);
    }

    /**
     * Check if type with id $id exists
     *
     * @param $id
     * @return bool
     */
    public function typeExists($id)
    {
        return is_null(TypeModel::find($id)) ? false : true;
    }

    /**
     * All types
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return ActivityModel::all();
    }

    /**
     * Find Activity by id
     *
     * @param int
     * @return null | ActivityModel
     */
    public function find($id)
    {
        if(is_int($id) && ActivityModel::find($id)) return ActivityModel::find($id);

        return null;
    }


    /**
     * Deletes an activity
     *
     * @param $activity
     * @return null|boolean
     */
    public function delete($activity)
    {
        if(is_int($activity) && ActivityModel::find($activity)) return ActivityModel::find($activity)->delete();

        if($activity instanceof ActivityModel) return $activity->delete();

        return null;
    }

    /**
     * Truncates Table
     *
     * @return boolean
     */
    public function truncate()
    {
        DB::transaction(function () {
            ActivityModel::truncate();
        });
    }

}