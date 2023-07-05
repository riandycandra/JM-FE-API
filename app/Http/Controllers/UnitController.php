<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class UnitController extends Controller
{

    use ApiResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Unit::all();

        return $this->successResponse($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
