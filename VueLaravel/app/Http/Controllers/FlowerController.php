<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flower;

class FlowerController extends Controller
{

    protected $flower;
    public function __construct(){
        $this->flower = new Flower();
        
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json($this->flower->all(), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $flower = $this->flower->create($request->all());
            return response()->json($flower, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $flower = $this->flower->find($id);
            if (!$flower) {
                return response()->json(['error' => 'Flower not found'], 404);
            }
            return response()->json($flower, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $flower = $this->flower->find($id);
            if (!$flower) {
                return response()->json(['error' => 'Flower not found'], 404);
            }
            $flower->update($request->all());
            return response()->json($flower, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $flower = $this->flower->find($id);
            if (!$flower) {
                return response()->json(['error' => 'Flower not found'], 404);
            }
            $flower->delete();
            return response()->json(['message' => 'Flower was deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
