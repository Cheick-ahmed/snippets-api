<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Snippet\SnippetResource;
use App\Snippet;
use Illuminate\Http\Request;

class SnippetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return SnippetResource::collection(
            Snippet::latest()->get()
        );
    }
}
