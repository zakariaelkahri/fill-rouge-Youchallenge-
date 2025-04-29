<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate ;

class joinTeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('participate');
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
            'invitation_code' => 'required|digits:6|exists:teams,invitation_code',
        ];
    }
    
    public function messages()
    {
        return [
            'tournament_id.required' => 'Tournament ID is required.',
            'tournament_id.exists' => 'The selected tournament does not exist.',
            'invite_code.required' => 'Please enter the invite code.',
            'invite_code.exists' => 'Invalid invite code. Make sure you got it from the team captain.',
        ];
    }
}
