<?php

namespace App\Http\Controllers;

use App\Models\Collector;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;

class CollectorController extends Controller
{
    public function getById(Request $request, string $id)
    {
        $collector = Collector::find($id);

        if (!$collector)
            return ResponseHelper::error("Collector not found", "NOT_FOUND", [], 404);

        return ResponseHelper::success($collector);
    }

    public function getOrganizations(Request $request, string $id)
    {
        $collector = Collector::find($id)->organizations()->get();

        if (!$collector)
            return ResponseHelper::error("Collector not found", "NOT_FOUND", [], 404);

        return ResponseHelper::success($collector);
    }

    public function update(Request $request, string $id)
    {

        $collector = Collector::find($id);
        if (!$collector)
            return ResponseHelper::error("Collector not found", "NOT_FOUND", [], 404);

        $schema = [
            "name" => "string|min:2",
            "dob" => "date|min:2",
            "aadhar_front_photo_key" => "string|min:2",
            "aadhar_back_photo_key" => "string|min:2",
        ];

        $validator = Validator::make($request->all(), $schema);

        if ($validator->fails())
            return ResponseHelper::error("Validation Failed", "VALIDATION_ERROR", $validator->errors(), 422);


        $collector->update($request->all());
        return ResponseHelper::success($collector);
    }
}
