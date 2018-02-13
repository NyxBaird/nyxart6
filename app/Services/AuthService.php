<?php namespace Services;
/**
 * Copyright © 2011 - 2017 NyxArt.org
 * All Rights Reserved. No part of this code may be reproduced without Elize Baird's express consent.
 * http://www.nyxart.org
 *
 * Created by Elize
 */

use App\Domain\User;
use Domain\Spirit\ResponseType;
use Illuminate\Support\Facades\Auth;

/**
 * This service is meant for use exclusively by Spirit, hence no extension of the Service class
 *
 * Class AuthService
 * @package Services
 */
class AuthService
{
    /**
     * @var SpiritService
     */
    protected $spiritService;

    /**
     * AuthService constructor.
     * @param SpiritService $spiritService
     */
    public function __construct(SpiritService $spiritService)
    {
        $this->spiritService = $spiritService;
    }

    /**
     * @param $params
     * @return array
     */
    public function spiritRegister($params)
    {
        $oldPass = $params['password'];
        $params['password'] = bcrypt($params['password']);

        if (User::create($params)) {
            \auth()->attempt(['email' => $params['email'], 'password' => $oldPass]);

            return ['type' => $this->spiritService->applyImpact(ResponseType::success()), 'response' => 'Welcome to NyxArt ' . $params['username'] . '!'];
        }

        return [
            'type' => $this->spiritService->applyImpact(ResponseType::error()),
            'response' => 'There was a problem processing your registration. Please double check your credentials and try again!'
        ];
    }

    /**
     * @param $params
     * @return array
     */
    public function spiritLogin($params)
    {
        if (Auth::attempt(['email' => $params['email'], 'password' => $params['password']])) {
            return ['type' => $this->spiritService->applyImpact(ResponseType::success()), 'response' => 'Welcome back ' . \auth()->user()->username . '!'];
        }

        return [
            'type' => $this->spiritService->applyImpact(ResponseType::error()),
            'response' => 'There was a problem logging you in! Please double check everything and try again'
        ];
    }
}