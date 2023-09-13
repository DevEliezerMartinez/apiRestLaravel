<?php

namespace App\Http\Requests\API\V1\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [];
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
