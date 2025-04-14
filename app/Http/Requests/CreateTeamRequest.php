<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class CreateTeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Check if the user is authenticated
        return Gate::authorize('participate') ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'tournament_id' => 'required|exists:tournaments,id',
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                Rule::unique('teams', 'name')->where(function ($query) {
                    return $query->where('tournament_id', $this->tournament_id);
                }),
            ],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'team_bio' => 'nullable|string|max:500',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'tournament_id' => 'tournament',
            'name' => 'team name',
            'photo' => 'team logo',
            'team_bio' => 'team bio',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'team_name.required' => 'Please enter a team name.',
            'team_name.min' => 'Team name must be at least :min characters.',
            'team_name.max' => 'Team name cannot exceed :max characters.',
            'team_name.unique' => 'This team name is already taken for this tournament.',
            'photo.image' => 'The team logo must be an image file.',
            'photo.mimes' => 'The team logo must be a file of type: :values.',
            'photo.max' => 'The team logo must not exceed 2MB in size.',
            'team_bio.max' => 'Team bio cannot exceed :max characters.',
        ];
    }
}