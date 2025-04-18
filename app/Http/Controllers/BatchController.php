<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function list(Request $request)
    {
        $batches = Batch::all();

        if (!$batches)
            return ResponseHelper::error("Collector not found", "NOT_FOUND", [], 404);

        return ResponseHelper::success($batches);
    }

    public function create(Request $request)
    {
    }

    public function getById(Request $request, string $id)
    {

    }

    public function update(Request $request, string $id)
    {

    }

    public function delete(Request $request, string $id)
    {

    }
}
