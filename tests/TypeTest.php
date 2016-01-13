<?php

use Thanosalexander\Activity\Activity\Types\Type;
use Thanosalexander\Activity\models\Type as TypeModel;

class TypeTest extends TestsBase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function test_it_does_not_create_type_if_data_is_null()
    {
        $data = null;

        $new_type = (new Type())->create($data);

        $this->assertInstanceOf('Thanosalexander\Activity\Exceptions\Type\NullDataException',$new_type);

        $this->assertEquals('The data array is required!',$new_type->getMessage());
    }

    public function test_it_does_not_create_type_if_data_field_is_other_than_required()
    {
        $data = [
            'name'=>'like',
            'label'=>'Like',
            'wrong_field'=>'this is wrong'
        ];

        $new_type = (new Type())->create($data);

        $this->assertInstanceOf('Thanosalexander\Activity\Exceptions\Type\CreateTypeException',$new_type);

        $this->assertEquals('Please add the correct fields!',$new_type->getMessage());
    }

    public function test_it_does_not_create_type_if_data_fields_number_is_other_than_required()
    {
        $data = [
            'name'=>'like',
            'label'=>'Like',
        ];

        $new_type = (new Type())->create($data);

        $this->assertInstanceOf('Thanosalexander\Activity\Exceptions\Type\CreateTypeException',$new_type);

        $this->assertEquals('The number of given data is different than required!',$new_type->getMessage());
    }

    public function test_id_does_not_create_the_type_if_type_name_exists()
    {
        $existing_login_type = TypeModel::find(1);

        $data = [
            'name'=> $existing_login_type->name, //login
            'description'=>'login type',
            'label'=>'Login'
        ];

        $new_type = (new Type())->create($data);

        $this->assertInstanceOf('Thanosalexander\Activity\Exceptions\Type\CreateTypeException',$new_type);

        $this->assertEquals('The type name already exists!',$new_type->getMessage());
    }

    public function test_it_create_the_type_and_returns_it()
    {
        $data = [
            'name'=> 'like',
            'description'=>'like type',
            'label'=>'Like'
        ];

        $new_type = (new Type())->create($data);

        $this->assertInstanceOf(TypeModel::class,$new_type);

    }

    public function test_it_fetches_all_the_types_in_collection()
    {
        $types_collection = (new Type())->all();

        $this->assertInstanceOf(Illuminate\Database\Eloquent\Collection::class,$types_collection);

        $this->assertEquals($types_collection->count(),TypeModel::all()->count());
    }

    public function test_it_finds_the_types_by_id()
    {
        $type_to_find = TypeModel::find(1);

        $searched_type = (new Type())->find($type_to_find->id);

        $this->assertEquals($type_to_find,$searched_type);
    }

    public function test_it_finds_the_types_by_name()
    {
        $type_to_find = TypeModel::find(1);

        $searched_type = (new Type())->find($type_to_find->name);

        $this->assertEquals($type_to_find,$searched_type);
    }

    public function test_it_return_null_when_try_to_find_type_if_argument_not_exists()
    {
        $searched_type = (new Type())->find(100);

        $this->assertNull($searched_type);
    }

    public function test_it_deletes_a_type_from_type_id()
    {
        $type_to_deleted = TypeModel::find(1);

        (new Type())->delete($type_to_deleted->id);

        $this->assertNull(TypeModel::find(1));
    }

    public function test_it_deletes_a_type_from_type_argument()
    {
        $type_to_deleted = TypeModel::find(1);

        (new Type())->delete($type_to_deleted);

        $this->assertNull(TypeModel::find(1));
    }

    public function test_it_deletes_a_type_from_name_argument()
    {
        $type_to_deleted = TypeModel::find(1);

        (new Type())->delete($type_to_deleted->name);

        $this->assertNull(TypeModel::find(1));
    }

    public function test_it_empty_the_types_table()
    {
        $emptied = (new Type())->truncate();

        $this->assertEquals(0,TypeModel::count());

    }

}