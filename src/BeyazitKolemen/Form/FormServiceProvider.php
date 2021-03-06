<?php

namespace BeyazitKolemen\Form;

use BeyazitKolemen\Form\ErrorStore\IlluminateErrorStore;
use BeyazitKolemen\Form\OldInput\IlluminateOldInputProvider;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider {
	protected $defer = false;

	public function register() {
		$this->registerErrorStore();
		$this->registerOldInput();
		$this->registerFormBuilder();
	}

	protected function registerErrorStore() {
		$this->app->singleton('beyazitkolemen.form.errorstore', function ($app) {
			return new IlluminateErrorStore($app['session.store']);
		});
	}

	protected function registerOldInput() {
		$this->app->singleton('beyazitkolemen.form.oldinput', function ($app) {
			return new IlluminateOldInputProvider($app['session.store']);
		});
	}

	protected function registerFormBuilder() {
		$this->app->singleton('beyazitkolemen.form', function ($app) {
			$formBuilder = new FormBuilder;
			$formBuilder->setErrorStore($app['beyazitkolemen.form.errorstore']);
			$formBuilder->setOldInputProvider($app['beyazitkolemen.form.oldinput']);
			$formBuilder->setToken($app['session.store']->token());

			return $formBuilder;
		});
	}

	public function provides() {
		return ['beyazitkolemen.form'];
	}
}
