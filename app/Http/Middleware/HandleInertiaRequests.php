<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\ArrayRule;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [

            'auth' => [
                'user' => $request->user(),
            ],
            'success'=>fn()=>$request->session()->get('success'),
        ]);
    }
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof InertiaResponse) {
            $response->toResponse($request)
                     ->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
                     ->header('Pragma','no-cache')
                     ->header('Expires','0');
        } else {
            $response->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
                     ->header('Pragma','no-cache')
                     ->header('Expires','0');
        }

        return $response;
    }
}