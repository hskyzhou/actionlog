<?php 
	namespace Hsky\Actionlog;

	use Illuminate\Support\ServiceProvider;

	class ActionlogServiceProvider extends ServiceProvider{
		protected $defer = false;

		public function boot(){
			/*发布migrations*/
	        $this->publishes([
	        	__DIR__.'/migrations' => database_path('migrations'),
	        ], 'migrations');

	        /*发布配置文件*/
	        $this->publishes([
	        	__DIR__.'/config/actionlog.php' => config_path('actionlog.php'),
	        ], 'config');
	    }
     
	    public function register(){
	 		$this->app->bind('actionlogfacade', function($app){
	 			return new \Hsky\Actionlog\Repositories\ActionlogRepository();
	 		});
	    }
	}