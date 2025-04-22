<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateRoundMatchesRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::authorize("manage_matches"); 
    }

    public function rules(): array
    {
        return [
            'round_id' => 'required|exists:rounds,id',
            'matches' => 'required|array',
            'matches.*.id' => 'required|exists:matches,id',
            'matches.*.team_a_name' => 'nullable|string|max:255',
            'matches.*.team_b_name' => 'nullable|string|max:255',
            'matches.*.team_a_score' => 'nullable|integer|min:0',
            'matches.*.team_b_score' => 'nullable|integer|min:0',
            'matches.*.winner_id' => 'nullable|exists:teams,id',
        ];
    }

    public function messages(): array
    {
        return [
            'round_id.required' => 'The round ID is required.',
            'round_id.exists' => 'The selected round does not exist.',
            'matches.required' => 'Match data is required.',
            'matches.*.id.required' => 'Each match must have an ID.',
            'matches.*.id.exists' => 'One or more matches are invalid.',
            'matches.*.winner_id.exists' => 'Selected winner must be a valid team.',
        ];
    }
}
