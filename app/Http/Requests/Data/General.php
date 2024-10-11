<?php

namespace App\Http\Requests\Data;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use App\Models\User;

class General extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
	
	public function documentRules(): array
	{
		return ['required', 'string', 'unique:'.User::class, function ($attribute, $value, $fail) {
			if (!$this->documentValidate($value)) {
				$fail($this->error);
			}
		}];
	}
	
	public function documentRulesByUser(): array
	{
		return ['required', 'string', Rule::unique(User::class)->ignore(auth()->user()->id), function ($attribute, $value, $fail) {
			if (!$this->documentValidate($value)) {
				$fail($this->error);
			}
		}];
	}
	
	public function documentValidate($document = ''): bool
	{
		if (!preg_match('/^(\d{11}|\d{3}\.\d{3}\.\d{3}\-\d{2}|\d{14}|\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2})$/', $document)) {
			$this->error = 'O CPF digitado é inválido!';
			return false;
		}
		
		$document = preg_replace('/[^0-9]/', '', $document);
		$len_doc = strlen($document);
		
		if (!in_array($len_doc, [11,14])) {
			$this->error = 'O CPF digitado é inválido!';
			return false;
		}
		
		if ($len_doc == 11) {
			for ($t = 9; $t < 11; $t++) {
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $document[$c] * (($t + 1) - $c);
				}

				$d = ((10 * $d) % 11) % 10;
				if ($document[$c] != $d) {
					$this->error = 'O CPF informado é inválido.';
					return false;
				}
			}
		}
		
		if ($len_doc == 14) {
			if (preg_match('/(\d)\1{13}/', $document)) {
				$this->error = 'O CNPJ informado é inválido.';
				return false;
			}

			// Validação do primeiro dígito verificador
			$sun = 0;
			$weight = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

			for ($i = 0; $i < 12; $i++) {
				$sun += $document[$i] * $weight[$i];
			}

			$remainder = ($sun * 10) % 11;
			$digit1 = ($remainder == 10 || $remainder == 11) ? 0 : $remainder;

			// Verificação do primeiro dígito
			if ($digit1 != $document[12]) {
				$this->error = 'O CNPJ informado é inválido.';
				return false;
			}

			// Validação do segundo dígito verificador
			$sun = 0;
			$weight = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

			for ($i = 0; $i < 13; $i++) {
				$sun += $document[$i] * $weight[$i];
			}

			$remainder = ($sun * 10) % 11;
			$digit2 = ($remainder == 10 || $remainder == 11) ? 0 : $remainder;

			// Verificação do segundo dígito
			if (!$digit2 == $document[13]) {
				$this->error = 'O CNPJ informado é inválido.';
				return false;
			}
		}
		
		return true;
	}
	
	public function emailRules(): array
	{
		return ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class];
	}
	
	public function emailRulesByUser(): array
	{
		return ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore(auth()->user()->id)];
	}
	
	public function nameClear($data): string
	{
		$data = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $data)));
	    $new_data = preg_replace('/[^\p{L}\p{M}\sçÇ]/u', '', $data);
		
		return $new_data;
	}
	 
	public function nameRules(): array
    {
        return ['required', 'string', 'min:3', 'max:255', function ($attribute, $value, $fail) {
			if (!$this->nameValidate($value)) {
				$fail('O campo nome digitado tem um formato inválido.');
			}
		}];
    }
	
	public function nameValidate($data): bool
	{
		$data = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $data)));
	    $new_data = preg_replace('/[^\p{L}\p{M}\sçÇ]/u', '', $data);
		
		return $data == $new_data;
	}
	
	public function passwordRules(): array
	{
		return ['required', 'confirmed', Rules\Password::defaults()];
	}
	 
    public function phoneRules(): array
    {
        return ['required', 'regex:/^\(\d{2}\) \d{4,5}-\d{4}$/'];
    }
	
	public function termsRules(): array
	{
		return ['required'];
	}
	
	public function typeRules(): array
	{
		return ['required', 'in:1,2,3'];
	}
}
