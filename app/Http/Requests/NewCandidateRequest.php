<?php

namespace App\Http\Requests;

use App\Utils\Utility;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewCandidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'candidate-name' => ['required', 'regex:(\\w)', Rule::unique('candidates', 'fullname')],
            'candidate-matric' => ['required', 'regex:(\\w)', Rule::unique('candidates', 'matric')],
            'candidate-position' => ['required', Rule::in(Utility::POSITIONS)],
            'candidate-level' => ['required', Rule::in(array_values(Utility::LEVELS))],
            'candidate-screened' => ['required', Rule::in(["1", "2"])],
            'candidate-photo' => ['required', Rule::file()],
        ];
    }
}
