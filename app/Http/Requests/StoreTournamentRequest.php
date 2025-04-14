<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreTournamentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize("create_tournament");
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
            'name' => 'required|string|max:255',
            'format' => 'required|string|in:FC25,VALORANT,CSGO',
            'max_participants'=> 'required|integer|max:32',
            'start_date' => 'required|date|after:now', 
            'reward' => 'nullable|string',
            'rules' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            ]
        ];
        

        
        // Add conditional validation for max_teams based on format
        if ($this->format == 'FC25') {
            $rules['max_participants'] = 'required|integer|min:2';
        } else {
            $rules['max_participants'] = 'required|integer|min:2';
        }
        
        return $rules;
    }
    
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The tournament name is required.',
            'format.required' => 'Please select a game format.',
            'format.in' => 'The selected game format is invalid.',
            'max_teams.required' => $this->format == 'FC25' ? 
                'The maximum number of participants is required.' : 
                'The maximum number of teams is required.',
            'max_teams.min' => $this->format == 'FC25' ? 
                'At least 2 participants are required.' : 
                'At least 2 teams are required.',
            'start_date.required' => 'The tournament start date and time is required.',
            'start_date.after' => 'The tournament start date must be in the future.',
            'photo.image' => 'The uploaded file must be an image.',
            'photo.mimes' => 'The image must be a file of type: jpeg, png, jpg, svg.',
            'photo.max' => 'The image may not be greater than 2MB.',
        ];
    }
    
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