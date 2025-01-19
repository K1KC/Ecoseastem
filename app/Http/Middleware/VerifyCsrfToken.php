<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '*'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function handle($request, Closure $next)
    {
        // Skip CSRF verification for excluded URIs
        if ($this->isReading($request) || $this->runningUnitTests() || $this->shouldPassThrough($request)) {
            return $this->addCookieToResponse($request, $next($request));
        }

        // Log incoming CSRF token for debugging
        logger()->info('Incoming CSRF Token:', [
            'header' => $request->header('X-CSRF-TOKEN'),
            'input' => $request->input('_token'),
        ]);

        // Check if tokens match
        if (!$this->tokensMatch($request)) {
            logger()->error('CSRF token mismatch!', [
                'expected' => $request->session()->token(),
                'provided' => $request->header('X-CSRF-TOKEN') ?: $request->input('_token'),
            ]);

            throw new TokenMismatchException('CSRF token mismatch.');
        }

        return $this->addCookieToResponse($request, $next($request));
    }

    /**
     * Determine if the session and input CSRF tokens match.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function tokensMatch($request)
    {
        // Get the token from the request header or input
        $token = $request->header('X-CSRF-TOKEN') ?: $request->input('_token');

        // Compare the provided token with the one stored in the session
        return is_string($request->session()->token()) &&
            is_string($token) &&
            hash_equals($request->session()->token(), $token);
    }

    /**
     * Add the CSRF token cookie to the response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function addCookieToResponse($request, $response)
    {
        $config = config('session');

        // Set the CSRF token as a cookie
        $response->headers->setCookie(
            cookie(
                'XSRF-TOKEN',
                $request->session()->token(),
                $config['lifetime'],
                $config['path'],
                $config['domain'],
                $config['secure'],
                $config['http_only'] ?? false,
                false,
                $config['same_site'] ?? null
            )
        );

        return $response;
    }
}
