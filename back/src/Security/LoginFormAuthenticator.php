<?php

namespace App\Security;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CustomCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractLoginFormAuthenticator
{

    use TargetPathTrait;

    private const BACKOFFICE_LOGIN_ROUTE_NAME = 'backoffice_login_index';
    private const BACKOFFICE_SUCCESS_ROUTE_NAME = 'backoffice_riddle_list';

    /** @var UserRepository $userRepository */
    private UserRepository $userRepository;

    /** @var RouterInterface $router */
    private RouterInterface $router;

    public function __construct(UserRepository $userRepository, RouterInterface $routerInterface) {
        $this->userRepository = $userRepository;
        $this->router = $routerInterface;
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        return new Passport(
            new UserBadge($email, function($userIdentifier){
                $user = $this->userRepository->findOneBy(['email' => $userIdentifier]);

                if(!$user){
                    throw new UserNotFoundException();
                }

                return $user;
            }),
            new PasswordCredentials($password),
            [
                new CsrfTokenBadge(
                    'authenticate',
                    $request->request->get('_csrf_token')
                )
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {

        if($target = $this->getTargetPath($request->getSession(), $firewallName)){
            return new RedirectResponse($target);
        }

        return new RedirectResponse(
            $this->router->generate(self::BACKOFFICE_SUCCESS_ROUTE_NAME)
        );
    }

    public function getLoginUrl(Request $request): string{
        return $this->router->generate(self::BACKOFFICE_LOGIN_ROUTE_NAME);
    }
}
