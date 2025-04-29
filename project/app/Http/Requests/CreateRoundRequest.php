<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CreateRoundRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize("manage_matches");
    }

    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        $rules = [
            [
            'id' => 'required|integer|min:1',
            // 'status' => 'integer|in:not_started,started,finished',
            
            ]
        ];
        
        return $rules;
    }
    
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */

    
    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Additional custom validation if needed
            
            // Example: Check if tournament with same name exists
            // if (Tournament::where('name', $this->name)->exists()) {
            //     $validator->errors()->add('name', 'A tournament with this name already exists.');
            // }
        });
    }
}