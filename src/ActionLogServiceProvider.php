<?php
namespace SheaXiang\ActionLog;

use Illuminate\Support\ServiceProvider;
use SheaXiang\ActionLog\Facades\ActionLog;

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
        // Publish files

        $this->publishes([
            __DIR__.'/migrations' => database_path('migrations'),
        ], 'migrations');


        $this->publishes([
            __DIR__.'/config/actionlog.php' => config_path('actionlog.php'),
        ], 'config');

        $action_log_config = config("actionlog");
		$models = $action_log_config['model'];
		$guard = $action_log_config['guard'];

		if($models){
			foreach($models as $k => $model) {
				(new $model)::updated(function($data) use ($guard){
					ActionLog::createActionLog('update',"更新的id:".$data->id, $guard);
				});

				(new $model)::saved(function($data) use ($guard){
					ActionLog::createActionLog('add',"添加的id:".$data->id, $guard);
				});

				(new $model)::deleted(function($data){
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
