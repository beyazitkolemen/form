<?php

namespace BeyazitKolemen\Form\Facades;

use Illuminate\Support\Facades\Facade;

class Form extends Facade {
	protected static function getFacadeAccessor() {
		return 'beyazitkolemen.form';
	}
}
