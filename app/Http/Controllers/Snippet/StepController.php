<?php

namespace App\Http\Controllers\Snippet;

use App\Http\Controllers\Controller;
use App\Http\Resources\Snippet\StepResource;
use App\Snippet;
use App\Step;
use Illuminate\Http\Request;

class StepController extends Controller
{
    public function update(Snippet $snippet, Step $step, Request $request)
    {
        $this->authorize('update', $step);

        $step->update($request->only('title', 'body'));
    }

    public function store(Snippet $snippet, Request $request)
    {
        $this->authorize('storeStep', $snippet);

        $step = $snippet->steps()->create(array_merge($request->only('title', 'body'), [
            'order' => $this->getOrder($request)
        ]));

        return new StepResource($step);
    }

    protected function getOrder(Request $request)
    {
        return Step::where('uuid', $request->before)
            ->orWhere('uuid', $request->after)
            ->first()
            ->{($request->before ? 'before' : 'after') . 'Order'}();
    }

    public function destroy(Snippet $snippet, Step $step)
    {
        $this->authorize('destroy',$step);

        if ($snippet->steps()->count() == 1) {
            return response(null, 400);
        }

        $step->delete();
    }
}
