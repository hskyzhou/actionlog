<?php 
	namespace Xezw211\Actionlog\Facades;

	use Illuminate\Support\Facades\Facade;

	class ActionLogFacade extends Facade{
		protected static function getFacadeAccessor(){
			return 'actionlogfacade';
		}
	}