<?php
namespace SheaXiang\ActionLog;

use Illuminate\Support\ServiceProvider;

class ActionLogServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish configuration files

        $this->publishes([
            __DIR__.'/migrations' => database_path('migrations'),
        ], 'migrations');


        $this->publishes([
            __DIR__.'/config/actionlog.php' => config_path('actionlog.php'),
        ], 'config');

        $model = config("actionlog");
		if($model){
			foreach($model as $k => $v) {
				
			$v::updated(function($data){
					ActionLog::createActionLog('update',"更新的id:".$data->id);
				});
			
			$v::saved(function($data){
				ActionLog::createActionLog('add',"添加的id:".$data->id);
			});
			
			$v::deleted(function($data){
				ActionLog::createActionLog('delete',"删除的id:".$data->id);

			});
			
			}
		}

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
		$this->app->bind('ActionLog', function()
		{
			return new \SheaXiang\ActionLog\Repositories\ActionLogRepository();
		});
    }
}