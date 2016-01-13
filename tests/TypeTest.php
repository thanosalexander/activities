<?php

use Thanosalexander\Activity\Activity\Types\Type;
use Thanosalexander\Activity\Exceptions\Type\CreateTypeException;

class TypeTest extends TestsBase
{
    /**
     * @var Type
     */
    private $type;

    /**
     * TypeTest constructor.
     */
    public function setUp()
    {
        parent::setUp();

        $this->type = new Type();
    }

    public function test_it_does_not_create_type_if_data_is_null()
    {
        $data = null;

        $this->type->create();

    }




}