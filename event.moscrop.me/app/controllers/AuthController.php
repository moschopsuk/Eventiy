<?php

use MrJuliuss\Syntara\Services\Validators\User as UserValidator;

class AuthController extends Controller {

	public function getSession() {
		if(Sentry::check()) {
			return Response::json(array('logged' => true, 'user' => Sentry::getUser()));
		} else {
			return Response::json(array('logged' => false));
		}
	}

	public function postLogin() {
		try {
            $validator = new UserValidator(Input::all(), 'login');

            if(!$validator->passes()) {
                 return Response::json(array('logged' => false, 'errorMessages' => $validator->getErrors()));
            }

            $credentials = array(
                'email' 	=> Input::get('email'),
                'password' 	=> Input::get('pass'),
            );

            Sentry::authenticate($credentials, (bool)Input::get('remember'));

        } catch(\Cartalyst\Sentry\Throttling\UserBannedException $e) {
            return Response::json(array('logged' => false, 'errorMessage' => trans('syntara::all.messages.banned'), 'errorType' => 'danger'));
        } catch (\RuntimeException $e) {
            return Response::json(array('logged' => false, 'errorMessage' => trans('syntara::all.messages.login-failed'), 'errorType' => 'danger'));
        }
        return Response::json(array('logged' => true, 'user' => Sentry::getUser()));
	}

	public function getLogout() {
		Sentry::logout();
		return Response::json(array('logged' => false));
	}

	public function postRegister() {
		return Response::json(array('name' => 'Steve', 'state' => 'CA'));
	}
}
