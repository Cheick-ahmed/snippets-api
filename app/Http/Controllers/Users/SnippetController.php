<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Snippet\SnippetResource;
use App\User;
use Illuminate\Http\Request;

class SnippetController extends Controller
{
    public function index(User $user)
    {
        return SnippetResource::collection($user->snippets()->public()->get());
    }
}
