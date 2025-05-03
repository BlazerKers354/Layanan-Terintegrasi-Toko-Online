<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request) {
        $userId = $request->query('user_id');
        return Product::where('user_id', $userId)->get();
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'user_id' => 'required|integer'
        ]);
    
        // Consumer: Validasi user_id ke UserService
        $userResponse = Http::get("http://localhost:8000/api/users/{$validated['user_id']}");
        if ($userResponse->failed()) {
            return response()->json(['error' => 'User tidak valid'], 400);
        }
    
        return Product::create($validated);
    }
}
