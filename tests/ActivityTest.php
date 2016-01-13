<?php

use Thanosalexander\Activity\Activity\Activity;
use Thanosalexander\Activity\models\Activity as ActivityModel;

class ActivityTest extends TestsBase
{

    public function test_it_does_not_create_activity_if_data_is_null()
    {
        $data = null;

        $new_activity = (new Activity())->create($data);

        $this->assertInstanceOf('Thanosalexander\Activity\Exceptions\Activity\NullDataException',$new_activity);

        $this->assertEquals('The data array is required!',$new_activity->getMessage());
    }

    public function test_it_does_not_create_activity_if_data_field_is_other_than_required()
    {
        $data = [
            'type_id'=>1,
            'user_id'=>1,
            'content'=>'something',
            'wrong_field'=>'this is wrong'
        ];

        $new_activity = (new Activity())->create($data);

        $this->assertInstanceOf('Thanosalexander\Activity\Exceptions\Activity\CreateActivityException',$new_activity);

        $this->assertEquals('Please add the correct fields!',$new_activity->getMessage());
    }

    public function test_it_does_not_create_activity_if_data_fields_number_is_other_than_required()
    {
        $data = [
            'type_id'=>1
        ];

        $new_activity = (new Activity())->create($data);

        $this->assertInstanceOf('Thanosalexander\Activity\Exceptions\Activity\CreateActivityException',$new_activity);

        $this->assertEquals('The number of given data is different than required!',$new_activity->getMessage());
    }

    public function test_it_does_not_create_activity_if_type_is_wrong()
    {
        $data = [
            'type_id'=>100,
            'user_id'=>1,
            'content'=>'something',
            'ip'=>'127.0.0.1'
        ];

        $new_activity = (new Activity())->create($data);

        $this->assertInstanceOf('Thanosalexander\Activity\Exceptions\Activity\CreateActivityException',$new_activity);

        $this->assertEquals('The type doesn\'t exist',$new_activity->getMessage());
    }

    public function test_it_does_not_create_activity_if_ip_is_wrong()
    {
        $data = [
            'type_id'=>1,
            'user_id'=>1,
            'content'=>'something',
            'ip'=>'12dnjfsdjknvf'
        ];

        $new_activity = (new Activity())->create($data);

        $this->assertInstanceOf('Thanosalexander\Activity\Exceptions\Activity\CreateActivityException',$new_activity);

        $this->assertEquals('The ip is not valid',$new_activity->getMessage());
    }


    public function test_it_create_the_type_and_returns_it()
    {
        $data = [
            'type_id'=>1,
            'user_id'=>1,
            'content'=>'something',
            'ip'=>'127.0.0.1'
        ];

        $new_activity = (new Activity())->create($data);

        $this->assertInstanceOf('Thanosalexander\Activity\models\Activity',$new_activity);

    }


    public function test_it_checks_if_ip_is_valid()
    {
        $ip = '192.168.1.1';

        $this->assertTrue((new Activity())->isIp($ip));
    }

    public function test_it_checks_if_ip_is_not_valid()
    {
        $ip = 'sdugfhuidfg';

        $this->assertFalse((new Activity())->isIp($ip));
    }

    public function test_it_checks_if_type_with_given_id_exists()
    {
        $this->assertTrue((new Activity())->typeExists(1));

        $this->assertFalse((new Activity())->typeExists(100));
    }

    public function test_it_fetches_all_the_types_in_collection()
    {
        $types_collection = (new Activity())->all();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$types_collection);

        $this->assertEquals($types_collection->count(),ActivityModel::all()->count());
    }

    public function test_it_finds_the_activity_by_id()
    {
        $activity_to_find = ActivityModel::find(1);

        $searched_activity = (new Activity())->find($activity_to_find->id);

        $this->assertEquals($activity_to_find,$searched_activity);
    }

    public function test_it_return_null_when_try_to_find_type_if_argument_not_exists()
    {
        $searched_type = (new Activity())->find(100);

        $this->assertNull($searched_type);
    }

    public function test_it_deletes_a_type_from_type_id()
    {
        $activity_to_deleted = ActivityModel::find(1);

        (new Activity())->delete($activity_to_deleted->id);

        $this->assertNull(ActivityModel::find(1));
    }


    public function test_it_empty_the_types_table()
    {
        (new Activity())->truncate();

        $this->assertEquals(0,ActivityModel::count());
    }

}