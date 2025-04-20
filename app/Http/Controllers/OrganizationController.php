<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Collector;
use App\Traits\HasClerkUser;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    use HasClerkUser;
    public function get(Request $request)
    {
        $user = $this->getUser($request);

        $organization = Collector::findOrFail($user->id)->organizations()->first();

        return ResponseHelper::success($organization, 200);
    }

    public function updateOrCreate(Request $request)
    {
        $updateSchema = [
            "name" => "string|min:2",
            "registration_certificate_key" => "string|min:6",
            "address" => "string|min:4",
            "city" => "string|min:2",
            "state" => "string|min:2",
            "pincode" => "integer|min:6"
        ];

        $insertSchema = [
            "name" => "string|required|min:2",
            "registration_certificate_key" => "string|required|min:6",
            "address" => "string|required|min:4",
            "city" => "string|required|min:2",
            "state" => "string|required|min:2",
            "pincode" => "integer|required|min:6"
        ];

        $this->validate($request, $updateSchema);

        $user = $this->getUser($request);

        $collector = Collector::findOrFail($user->id);

        $organization = $collector->organizations()->first();

        //Organization doesn't exists validate insert schema
        if (!$organization) {
            $this->validate($request, $insertSchema);
        }

        //Incase organization doesn't exists for this collector create one
        $newOrganization = $collector->organizations()->updateOrCreate(["collector_id" => $collector->id], $request->all());

        return ResponseHelper::success($newOrganization);
    }
}
