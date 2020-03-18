<?php

namespace App\Http\Controllers\Snippet;

use App\Http\Controllers\Controller;
use App\Http\Resources\Snippet\SnippetResource;
use App\Http\Resources\User\PublicUserResource;
use App\Snippet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SnippetController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api'])
            ->only('store','update');
    }

    public function index()
    {
        return SnippetResource::collection(
            Snippet::latest()->public()->limit(5)->get()
        );
    }

    public function store(Request $request)
    {
        $snippet = $request->user()->snippets()->create($request->only('title', 'body'));

        return new SnippetResource($snippet);

    }

    public function show(Snippet $snippet)
    {
       $this->authorize('show', $snippet);

        return new SnippetResource($snippet->load(['steps', 'user']));
    }

    public function update(Snippet $snippet, Request $request)
    {
        $this->authorize('update', $snippet);

        $this->validate($request, [
            'title' => 'nullable',
            'is_public' => 'nullable|boolean'
        ]);
        $snippet->update($request->only('title', 'is_public'));

    }

    public function destroy(Snippet $snippet)
    {
        $this->authorize('destroy', $snippet);
        $snippet->delete();
    }
}
