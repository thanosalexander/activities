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
                if (!in_array($k, $this->fields)) throw new CreateActivityException('Please add all required fields!');
            }

            if (count(array_keys($data)) != count($this->fields)) throw new CreateActivityException('The number of given data is different than required!');

            $this->checkFields($data);

            $activity = ActivityModel::create($data);

            DB::commit();

            return $activity;
        }
        catch(\Exception $e)
        {
            DB::rollBack();

            return null;
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
    private function isIp($ip)
    {
        return filter_var($ip, FILTER_VALIDATE_IP);
    }

    /**
     * Check if type with id $id exists
     *
     * @param $id
     * @return bool
     */
    private function typeExists($id)
    {
        return is_null(TypeModel::find($id)) ? false : true;
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
            ActivityModel::truncate();

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