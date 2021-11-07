<?php

namespace App\Services\Shop;

use App\Models\DeliveryAddress;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DeliveryAddressService
{
    public static function save($data): DeliveryAddress
    {
        $validator = Validator::make($data , [
            "id" => "nullable|exists:delivery_addresses,id",
            "user_id" => "required|exists:users,id",
            "name" => "nullable|string",
            "apartment_no" => "nullable|string",
            "zip_code" => "nullable|string",
            "name" => "nullable|string",
            "address" => "required|string",
            "country" => "required|string",
            "city" => "required|string",
            "state" => "required|string",
            "phone" => "required|string",
            "phone_2" => "nullable|email",
        ]);

        if($validator->fails()){
            throw new ValidationException($validator);
        }

        $data = $validator->validated();
        $id = $data["id"] ?? null;
        unset($data["id"]);
        if(!empty($id)){
            $address = DeliveryAddress::find($id);
            $address->update($data);
        }
        else{
            $address = DeliveryAddress::create($data);
        }
        return $address->refresh();
    }

    public static function delete($id)
    {
        DeliveryAddress::find($id)->delete();
    }
}
