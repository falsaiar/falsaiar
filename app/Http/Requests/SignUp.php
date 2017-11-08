<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUp extends FormRequest
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
        return [
            'lname' => 'required|max:50',
            'fname' => 'required|max:50',
            'email' => array('required','email','regex:/^([a-zA-Z0-9]+)@asu\.edu$/'),
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'gender' => 'required',
            'agree'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'lname.required' => 'Please Enter Your Last Name',
            'lname.max' => 'Last Name Cannot Exceed 50 Characters',
            'fname.required'  => 'Please Enter Your First Name',
            'fname.max' => 'First Name Cannot Exceed 50 Characters',
            'email.required'  => 'Please Enter Your Email Address',
            'email.email'  => 'Please Enter a Valid Email',
            'email.regex' => 'Only @asu.edu emails are allowed',
            //'email.unique'  => 'Please this Email Already Exist',
            'password.required'  => 'Please Enter Password',
            'password.min'  => 'Password Must be Minimum of Six Character',
            'confirm_password.required'  => 'Please Enter Confirm Password',
            'confirm_password.same'  => 'Password Must Correspond',
            'gender.required'  => 'Please Select Gender',
            'agree.required'  => 'Please Accept Terms and Condition',
        ];
    }
}
