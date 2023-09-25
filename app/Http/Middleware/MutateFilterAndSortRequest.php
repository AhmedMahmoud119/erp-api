<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MutateFilterAndSortRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /*
        * Middleware to prepare request to be satisfay with current solution
        * In case of sorting with multiple coulumn the middleware must to be deleted
        */
        if ($request->has('sort_by')) {
            $sortField = $request->input('sort_by');
            $sortOrder = $request->input('sort_type') == 'asc' ? 'asc' : 'desc';

            $request->merge([
                'sort' => [
                    'by' => $sortField,
                    'order' => $sortOrder,
                ],
            ]);
        }
        return $next($request);
    }
}
