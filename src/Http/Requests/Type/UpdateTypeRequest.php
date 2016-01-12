<?php
namespace Thanosalexander\Activity\Http\Requests\Type;


use Football\Http\Requests\Request;

class UpdateTypeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|alpha_dash|unique:activities_types,name',
            'description'=>'required|alpha_dash',
            'label'=>'required|alpha_dash',
        ];
    }
}