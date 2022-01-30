<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest {

	public function rules(){
		return [
			'photo' => 'mimes:png,jpg,jpeg,pdf,xlsx,docx,doc'
		];
	}
	//

}
