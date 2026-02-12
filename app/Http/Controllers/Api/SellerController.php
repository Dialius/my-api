<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SellerController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Seller::all()]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|unique:sellers',
            'email' => 'required|email|unique:sellers',
            'store' => 'required|unique:sellers',
        ]);

        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);

        $seller = Seller::create([
            'uuid' => Str::uuid(), // Auto generate UUID
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'store' => $request->store,
        ]);

        return response()->json(['message' => 'Seller created', 'data' => $seller], 201);
    }

    public function show($id)
    {
        $seller = Seller::find($id);
        if (!$seller) return response()->json(['message' => 'Seller not found'], 404);
        return response()->json(['data' => $seller]);
    }

    public function update(Request $request, $id)
    {
        $seller = Seller::find($id);
        if (!$seller) return response()->json(['message' => 'Seller not found'], 404);

        $validator = Validator::make($request->all(), [
            'phone' => 'unique:sellers,phone,' . $id,
            'email' => 'unique:sellers,email,' . $id,
            'store' => 'unique:sellers,store,' . $id,
        ]);

        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);

        $seller->update($request->all());

        return response()->json(['message' => 'Seller updated', 'data' => $seller]);
    }

    public function destroy($id)
    {
        $seller = Seller::find($id);
        if (!$seller) return response()->json(['message' => 'Seller not found'], 404);

        $seller->delete();
        return response()->json(['message' => 'Seller deleted']);
    }
}
