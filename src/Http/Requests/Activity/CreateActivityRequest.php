<?php
namespace Thanosalexander\Activity\Http\Requests\Activity;


use Football\Http\Requests\Request;

class CreateActivityRequest extends Request
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
            'type_id'=>'required|numeric|exists:activities_types,id',
            'user_id'=>'numeric',
            'content'=>'',
            'ip'=>'ip'
        ];
    }
}