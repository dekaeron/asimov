<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\isWeekday;


class StoreBookingRequest extends FormRequest
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
        // Chilean Users
        return [            
            'date' => ['required', 'date', new isWeekday],
            'hour' => 'required|numeric|between:'.config('app.workday_start_time').','.config('app.workday_end_time'),
            'contact_email' => 'required|email',
            'contact_name' => 'required|min:2'
        ];
    }



     public function messages()
    {
        return [
            'date.required'  => 'You must enter the date',
            'date.date'  => 'You must enter the date in a valid format (YYYYY-MM-DD).',            
            'hour.required'  => 'The Hour must be entered',
            'hour.numeric'  => 'The Hour must be entered in a number, according to the allowed range (from '.config('app.workday_start_time').' to '.config('app.workday_end_time').').',
            'hour.between'  =>  'The range of working hours is between '.config('app.workday_start_time').' and '.config('app.workday_end_time').'.',
            'contact_email.required' => 'the email contact must be entered',
            'contact_email.email' => 'You must provide a valid email address',      
            'contact_name.required' => 'The Contact Name must be entered',
            'contact_name.min' => 'The Contact Name is too short my friend',   
        ];
    }

}
