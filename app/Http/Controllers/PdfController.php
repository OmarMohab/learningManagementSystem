<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index(Material $material){ 
        return response()->file(public_path('storage/' . $material->path));
    }

    public function assignment(Assignment $assignment)
    {
        return response()->file(public_path('storage/' . $assignment->path));
    }

    public function submission(Submission $submission)
    {
        return response()->file(public_path('storage/' . $submission->path));
    }
}
