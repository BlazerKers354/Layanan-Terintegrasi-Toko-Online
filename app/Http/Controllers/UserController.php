<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;
class UserController extends Controller
{
    public function showWithProducts($id) {
        $user = User::findOrFail($id);
        $products = Http::get("http://localhost:8001/api/products", [
            'user_id' => $id
        ])->json();
    
        return response()->json([
            'user' => $user,
            'products' => $products
        ]);
    }
    public function index() {
        return User::all();
    }
    
    public function show($id) {
        return User::findOrFail($id);
    }
    
}
