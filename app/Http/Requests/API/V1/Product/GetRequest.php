<?php

namespace App\Http\Requests\API\V1\Product;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:products,id',
        ];
    }

    /**
     * Add parameters to be validated.
     *
     * @param null $keys
     * @return array
     */
    public function all($keys = null): array
    {
        return array_replace_recursive(
            parent::all(),
            $this->route()->parameters()
        );
    }
}
