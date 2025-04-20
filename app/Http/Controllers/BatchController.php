<?php

namespace App\Http\Controllers;

use App\Enums\BatchType;
use App\Helpers\ResponseHelper;
use App\Models\Batch;
use App\Models\Collector;
use App\Models\Organization;
use App\Traits\HasClerkUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;

class BatchController extends Controller
{
    use HasClerkUser;
    public function list(Request $request, string $orgId)
    {
        $user = $this->getUser($request);

        $batches = Collector::findOrFail($user->id)->organizations()->findOrFail($orgId)->batches()->get();

        return ResponseHelper::success($batches);
    }

    public function create(Request $request, string $orgId)
    {
        $schema = [
            "name" => "string|required|min:2",
            "batch_type" => ["required", Rule::enum(BatchType::class)],
            "starts_on" => "date|required",
            "due_date" => "integer|required|min:1|max:25",
            "scheme" => "integer|required",
            "fund_amount" => "decimal:0|required",
            "commission_rate" => "decimal:0|required"
        ];

        $validatedBody = $this->validate($request, $schema);

        //create ends_on date using scheme
        $ends_on = Date::parse($validatedBody["starts_on"]);
        $ends_on = $ends_on->addMonths($validatedBody["scheme"]);

        $user = $this->getUser($request);

        $batches = Collector::findOrFail($user->id)->organizations()->findOrFail($orgId)->batches()->create([...$validatedBody, "ends_on" => $ends_on]);

        return ResponseHelper::success($batches);
    }

    public function getById(Request $request, string $batchId)
    {
        $batch = Batch::findOrFail($batchId);

        return ResponseHelper::success($batch);
    }

    public function update(Request $request, string $batchId)
    {
        $schema = [
            "name" => "string|min:2",
            "batch_type" => ["required", Rule::enum(BatchType::class)],
            "starts_on" => "date",
            "due_date" => "integer|min:1|max:25",
            "scheme" => "integer",
            "fund_amount" => "decimal:0",
            "commission_rate" => "decimal:0"
        ];

        $validatedBody = $this->validate($request, $schema);

        $batch = Batch::findOrFail($batchId);

        $batch->update($validatedBody);

        $newBatch = $batch->refresh();

        return ResponseHelper::success($newBatch);
    }

    public function delete(Request $request, string $batchId)
    {
        $batch = Batch::findOrFail($batchId);

        $batch->deleteOrFail();

        return ResponseHelper::success($batch);
    }
}
