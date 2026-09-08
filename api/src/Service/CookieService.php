<?php

namespace App\Service;

use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;


class CookieService
{
    public function readOrSetCookie(Request $request): JsonResponse
    {
        $response = new JsonResponse();
        $sessionId = $request->cookies->get('session_uuid');
        if ($sessionId) {
            $cookieValue = $sessionId;
        }
        else {
            $cookieValue = Uuid::uuid7()->toString();
        }

        $cookie = new Cookie(
                      "session_uuid",                      // Cookie name
                      $cookieValue,                                       // Cookie content
                      time() + 60*60*24*30, // Expiration date
                      "/",                                     // Path
                      null,//"localhost",                             // Domain
                      false, //$request->getScheme() === 'https',       // Secure
                      true,//false,                                   // HttpOnly
                      false,//true,                                    // Raw
                      'Lax',//'Strict'                                 // SameSite policy
                  );

        
        $response->headers->setCookie($cookie);

        return $response;
    }
}
