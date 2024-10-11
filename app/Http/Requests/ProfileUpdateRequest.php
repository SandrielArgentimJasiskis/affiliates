<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Http\Requests\Data\General;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
		$generalRequest = new \App\Http\Requests\Data\General();
		
		return [
            'name' => array_merge(
                $generalRequest->nameRules()
            ),
            'email' => array_merge(
                $generalRequest->emailRulesByUser()
            ),
            'document' => $generalRequest->documentRulesByUser(),
            'phone' => $generalRequest->phoneRules(),
        ];
        /*return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];*/
    }
}
