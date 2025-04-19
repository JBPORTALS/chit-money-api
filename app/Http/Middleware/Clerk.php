<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use Clerk\Backend;
use Clerk\Backend\Helpers\Jwks\VerifyToken;
use Clerk\Backend\Helpers\Jwks\VerifyTokenOptions;
use Closure;
use Exception;

class Clerk
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $bearerToken = $request->bearerToken();

            if (empty($bearerToken)) {
                return ResponseHelper::error(
                    "Unauthorized",
                    "UNAUTHORIZED",
                    ["details" => "No bearerToken provided to the request"],
                    401
                );
            }

            // Initialize Clerk SDK
            $sdk = Backend\ClerkBackend::builder()
                ->setSecurity(getenv("CLERK_SECRET_KEY"))
                ->build();

            // Verify the token and extract claims
            $sessionClaims = VerifyToken::verifyToken(
                $bearerToken,
                new VerifyTokenOptions(getenv("CLERK_SECRET_KEY"))
            );

            $user = $sdk->users->get($sessionClaims->sub);

            if ($user === null)
                return ResponseHelper::error(401, "USER NOT FOUND", ["message" => "May be user not found"]);

            // Attach the session claims to the request
            $request->attributes->set('user', $user->user);

            return $next($request);

        } catch (Exception $e) {
            return ResponseHelper::error(
                $e->getMessage(),
                $e->getCode() ?: 500,
                ["clerk_error" => true]
            );
        }
    }
}
