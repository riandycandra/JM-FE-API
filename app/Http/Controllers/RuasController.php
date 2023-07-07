<?php

namespace App\Http\Controllers;

use App\Models\Ruas;
use App\Models\Unit;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use App\Service\UploadService;
use App\Http\Requests\RuasRequest;
use Illuminate\Database\QueryException;
use App\Http\Requests\UpdateRuasRequest;

class RuasController extends Controller
{

    protected $service;

    use ApiResponses;

    public function __construct(UploadService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if($request->show == 'active_only') {
            $data = Ruas::where('status', '1')->get();

            return $this->successResponse($data);
        }

        $perPage = is_numeric($request->per_page) ? $request->per_page : 5;
        return Ruas::orderBy('id', 'desc')->paginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RuasRequest $request)
    {
        $ruas = new Ruas();

        $ruas->ruas_name = $request->ruas_name;
        $ruas->long      = $request->long;
        $ruas->km_awal   = $request->km_awal;
        $ruas->km_akhir  = $request->km_akhir;
        $ruas->photo_url = $this->service->uploadFile($request->photo);
        $ruas->doc_url   = $this->service->uploadFile($request->file);
        $ruas->status    = $request->status;

        $unit = Unit::find($request->unit_id);

        $ruas->unit()->associate($unit);

        $ruas->save();

        return $this->createdResponse($ruas);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Ruas::where('id', $id)->first();

        if($data == null) {
            return $this->errorResponse($data, __('crud.failed.get'), 404);
        } else {
            return $this->successResponse($data, message: __('crud.success.get'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRuasRequest $request, string $id)
    {
        try {
            $ruas = Ruas::where('id', $id)->first();
        } catch (Exception|QueryException $e) {
            return $this->errorResponse([], 'Data not found.', 404);
        }

        if ($ruas == null) {
            return $this->errorResponse($ruas, __('crud.failed.update'), 404);
        }

        $ruas->ruas_name = $request->ruas_name;
        $ruas->long      = $request->long;
        $ruas->km_awal   = $request->km_awal;
        $ruas->km_akhir  = $request->km_akhir;
        $ruas->status    = $request->status;

        $ruas->photo_url = ($request->photo == null ? $ruas->photo_url : $this->service->uploadFile($request->photo));
        $ruas->doc_url   = ($request->file == null ? $ruas->doc_url : $this->service->uploadFile($request->file));

        $unit = Unit::find($request->unit_id);

        $ruas->unit()->associate($unit);

        $ruas->save();

        return $this->successResponse($ruas, message: __('crud.success.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $ruas = Ruas::where('id', $id)->first();
        } catch (Exception|QueryException $e) {
            return $this->errorResponse([], 'Data not found.', 404);
        }

        if ($ruas == null) {
            return $this->errorResponse($ruas, __('crud.failed.update'), 404);
        }

        $ruas->delete();

        return $this->successResponse([], message: __('crud.success.delete'));
    }
}
