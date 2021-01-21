<?php


namespace App\Helpers\Requests;


use App\Http\Response\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

trait FailedValidation
{
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->getMessageBag()->getMessages();
        $response =  ApiResponse::sendResponse([], trans('validate.error'),
            false, JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $errors
        );

        throw new HttpResponseException($response);
    }

}
