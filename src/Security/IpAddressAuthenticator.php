<?php

declare(strict_types=1);

namespace App\Security;

use App\Service\UserProvider;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class IpAddressAuthenticator extends AbstractAuthenticator
{
    public function __construct(
        private UserProvider $userProvider
    ) {}

    public function supports(Request $request): ?bool
    {
        return null !== $request->getClientIp();
    }

    public function authenticate(Request $request): PassportInterface
    {
        return new SelfValidatingPassport(
            new UserBadge(
                $request->getClientIp(),
                fn(string $ip) => $this->userProvider->createIfNotExists($ip)
            )
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse(['data' => 'Client IP Address not provided'], Response::HTTP_UNAUTHORIZED);
    }
}
