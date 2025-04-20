<?php

namespace App\Http\Controllers;

use App\Enums\AccountType;
use App\Helpers\ResponseHelper;
use App\Models\Collector;
use App\Traits\HasClerkUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BankDetailController extends Controller
{
    use HasClerkUser;
    public function getForCollector(Request $request)
    {
        $user = $this->getUser($request);

        $contact = Collector::findOrFail($user->id)->bankDetails()->get()->first();

        return ResponseHelper::success($contact, 200);
    }

    public function updateForCollector(Request $request)
    {
        $updateSchema = [
            "account_holder_name" => "string|min:2",
            "account_number" => "string|min:6",
            "ifsc_code" => "string|min:6",
            "branch_name" => "string|min:2",
            "account_type" => ["required", Rule::enum(AccountType::class)],
            "upi_id" => "string|min:4",
            "city" => "string|min:2",
            "state" => "string|min:2",
            "pincode" => "integer|min:6"
        ];

        $insertSchema = [
            "account_holder_name" => "string|required|min:2",
            "account_number" => "string|required|min:6",
            "ifsc_code" => "string|required|min:6",
            "branch_name" => "string|required|min:2",
            "account_type" => ["required", Rule::enum(AccountType::class)],
            "upi_id" => "string|required|min:4",
            "city" => "string|required|min:2",
            "state" => "string|required|min:2",
            "pincode" => "required|digits:6"
        ];

        $this->validate($request, $updateSchema);

        $user = $this->getUser($request);

        $collector = Collector::findOrFail($user->id);

        $bankDetails = $collector->bankDetails();

        if (!$bankDetails->exists()) {
            $this->validate($request, $insertSchema);
        }

        $bankDetails->updateOrCreate(["id" => $collector->bank_details_id], $request->all());

        return ResponseHelper::success($bankDetails->first(), $bankDetails->exists() ? 200 : 201);
    }
}
