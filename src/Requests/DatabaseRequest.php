<?php

namespace Marifuli\Service\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DatabaseRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $option = $this->route('option');
        $rules = [
            'db_port'     => 'required',
            'db_host'     => 'required',
            'db_database' => 'required',
            'db_username' => 'required'
        ];

        if(config('marifuli.support_multi_connection', false)){
            $rules += [
                'db_connection'     => 'required|in:mysql,pgsql',
            ];
        }
        return $rules;
    }

    /**
     * Translate fields with user friendly name.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'db_connection'         => trans('service::install.db_connection'),
            'db_port'               => trans('service::install.db_port'),
            'db_host'               => trans('service::install.db_host'),
            'db_database'           => trans('service::install.db_database'),
            'db_username'           => trans('service::install.db_username'),
        ];
    }
}
