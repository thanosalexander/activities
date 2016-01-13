<?php

use Thanosalexander\Activity\Activity\Types\Type;
use Thanosalexander\Activity\Exceptions\Type\NullDataException;

class TypeTest extends TestsBase
{

    public function test_it_does_not_create_type_if_data_is_null()
    {
        $data = null;

        $new_type = (new Type())->create($data);

        $this->assertInstanceOf(NullDataException::class,$new_type);
    }

    public function test_it_does_not_create_type_if_data_keys_are_wrong()
    {
        $data = [
            'name'=>'like',
            'label'=>'Like',
            'wrong_field'=>'this is wrong'
        ];

        $new_type = (new Type())->create($data);

        $this->assertInstanceOf(NullDataException::class,$new_type);
    }



}