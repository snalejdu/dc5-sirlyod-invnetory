<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreCrudLinks
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
        if ($request->is('api/*')) {
            // Generate CRUD links for the current resource
            $crudLinks = $this->generateCrudLinks($request);

            // Store in request for use in controllers/responses
            $request->merge(['_crud_links' => $crudLinks]);
        }

        return $next($request);
    }

    /**
     * Generate CRUD links for API endpoints
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function generateCrudLinks(Request $request): array
    {
        $baseUrl = config('app.url');
        $apiVersion = 'v1';

        // Extract resource name from URL (e.g., products from /api/v1/products)
        preg_match('/api\/' . $apiVersion . '\/(\w+)/', $request->getPathInfo(), $matches);
        $resource = $matches[1] ?? null;

        if (!$resource) {
            return [];
        }

        $links = [
            'list' => "{$baseUrl}/api/{$apiVersion}/{$resource}",
            'create' => "{$baseUrl}/api/{$apiVersion}/{$resource}",
            'view' => "{$baseUrl}/api/{$apiVersion}/{$resource}/{id}",
            'update' => "{$baseUrl}/api/{$apiVersion}/{$resource}/{id}",
            'delete' => "{$baseUrl}/api/{$apiVersion}/{$resource}/{id}",
        ];

        // Store links in session/cache for global access
        cache()->put("crud_links_{$resource}", $links, now()->addHours(24));

        return $links;
    }
}
