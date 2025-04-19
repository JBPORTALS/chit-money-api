<?php

namespace App\Http\Controllers;

use App\Models\Collector;
use App\Helpers\ResponseHelper;
use App\Traits\HasClerkUser;
use Illuminate\Http\Request;

class CollectorController extends Controller
{
    use HasClerkUser;

    public function get(Request $request)
    {

        $user = $this->getUser($request);

        $collector = Collector::findOrFail($user->id);

        return ResponseHelper::success([...$collector->toArray(), "imageUrl" => $user->imageUrl, "emailAddresses" => $user->emailAddresses]);
    }

    public function create(Request $request)
    {

        $schema = [
            "id" => 'string|required|min:2',
            "name" => 'string|min:2',
            "dob" => 'date|min:2',
            "aadhar_front_photo_key" => 'string|min:3',
            "aadhar_back_photo_key" => 'string|min:3',
        ];

        //Validate Incoming Request
        $this->validate($request, $schema);

        $user = $this->getUser($request);

        $collector = Collector::create($request->all())->refresh();

        return ResponseHelper::success($collector, 201);
    }

    public function update(Request $request)
    {

        $schema = [
            "name" => "string|min:2",
            "dob" => "date|min:2",
            "aadhar_front_photo_key" => "string|min:2",
            "aadhar_back_photo_key" => "string|min:2",
        ];

        //validate incoming request
        $this->validate($request, $schema);
        $user = $this->getUser($request);

        $collector = Collector::findOrFail($user->id);
        $collector->updateOrFail($request->all());


        return ResponseHelper::success($collector->refresh());
    }
    public function delete(Request $request)
    {

        $user = $this->getUser($request);

        $collector = Collector::findOrFail($user->id)->deleteOrFail();

        return ResponseHelper::success($collector, 204);
    }
}
