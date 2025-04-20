<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Collector;
use App\Traits\HasClerkUser;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    use HasClerkUser;
    public function getForCollector(Request $request)
    {
        $user = $this->getUser($request);

        $contact = Collector::findOrFail($user->id)->contact()->get()->first();

        return ResponseHelper::success($contact, 200);
    }

    public function updateForCollector(Request $request)
    {
        $updateSchema = [
            "address" => "string|min:2",
            "city" => "string|min:2",
            "state" => "string|min:2",
            "pincode" => "integer|min:6"
        ];

        $insertSchema = [
            "address" => "string|required|min:2",
            "city" => "string|required|min:2",
            "state" => "string|required|min:2",
            "pincode" => "required|digits:6"
        ];

        $this->validate($request, $updateSchema);

        $user = $this->getUser($request);

        $collector = Collector::findOrFail($user->id);

        $contact = $collector->contact();

        if (!$contact->exists()) {
            $this->validate($request, $insertSchema);
        }

        $contact->updateOrCreate(["id" => $collector->contact_id], $request->all());

        return ResponseHelper::success($contact->first(), $contact->exists() ? 200 : 201);
    }
}
