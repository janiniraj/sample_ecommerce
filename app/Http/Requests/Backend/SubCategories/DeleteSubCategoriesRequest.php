<?php

namespace App\Http\Requests\Backend\SubCategories;

use App\Http\Requests\Request;

/**
 * Class DeleteSubCategoriesRequest.
 */
class DeleteSubCategoriesRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('delete-subcategory');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
