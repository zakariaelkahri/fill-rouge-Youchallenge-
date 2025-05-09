<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateTournamentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::authorize("update_tournament");

    }

    public function rules(): array
    {
        return [
            'tournament_id'      => ['required', 'integer', 'exists:tournaments,id'],
            'name'               => ['required', 'string', 'min:3', 'max:255'],
            'format'             => ['required', 'string', 'in:FC25,VALORANT,CSGO,eFOOTBALL'],
            'max_participants'   => ['required', 'integer', 'in:8,16,32'],
            'start_date'         => ['required', 'date'],
            'photo'              => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'], 
            'reward'             => ['nullable', 'string', 'max:1000'],
            'rules'              => ['nullable', 'string', 'max:2000'],
            'team_mode'          => ['required', 'string', 'in:1,2,4'],
        ];
    }


}
