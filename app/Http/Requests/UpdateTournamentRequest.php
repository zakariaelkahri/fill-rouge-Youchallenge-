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
            'tournament_id'    => 'nullable|integer|exists:tournaments,id',
            'name'             => 'required|string|max:255',
            'format'           => 'required|in:FC25,VALORANT,CSGO,eFOOTBALL',
            'max_participants' => 'required|in:8,16,32',
            'photo'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'start_date'       => 'nullable|date|after_or_equal:today',
            'reward'           => 'nullable|string',
            'rules'            => 'nullable|string',
        ];
    }
}
