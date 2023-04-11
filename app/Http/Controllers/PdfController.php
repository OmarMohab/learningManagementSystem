<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index(Material $material){ 
        return response()->file(public_path('storage/' . $material->path));
    }
}
