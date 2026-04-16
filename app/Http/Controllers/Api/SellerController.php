<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SellerController extends Controller
{
    public function index(Request $request)
    {
        $query = Seller::query();

        // Search by name, email, or store
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('store', 'like', "%{$search}%");
            });
        }

        $sellers = $query->latest()->paginate(10);

        return \App\Http\Resources\SellerResource::collection($sellers)->additional([
            'success' => true,
            'message' => 'List of sellers'
        ]);
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

        return (new \App\Http\Resources\SellerResource($seller))->additional([
            'success' => true,
            'message' => 'Seller created'
        ]);
    }

    public function show($id)
    {
        $seller = Seller::find($id);
        if (!$seller) return response()->json(['message' => 'Seller not found'], 404);
        return (new \App\Http\Resources\SellerResource($seller))->additional([
            'success' => true,
            'message' => 'Seller detail'
        ]);
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

        return (new \App\Http\Resources\SellerResource($seller))->additional([
            'success' => true,
            'message' => 'Seller updated'
        ]);
    }

    public function destroy($id)
    {
        $seller = Seller::find($id);
        if (!$seller) return response()->json(['message' => 'Seller not found'], 404);

        $seller->delete();
        return response()->json(['message' => 'Seller deleted']);
    }
}

