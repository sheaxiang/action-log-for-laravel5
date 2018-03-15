# action-log-for-laravel5

# 说明

自动记录用户操作行为

# 安装

	composer require "sheaxiang/action-log:^1.2"
# 配置

1：注册ServiceProvider：

    \SheaXiang\ActionLog\ActionLogServiceProvider::class
    
2：创建配置文件：

    php artisan vendor:publish --provider="SheaXiang\ActionLog\ActionLogServiceProvider"
    
3：添加门面到config/app.php 中的 aliases 部分:

    'ActionLog' => \SheaXiang\ActionLog\ActionLogServiceProvider::class
    
4：在config/sms-auth.php

    //填写要记录的日志的模型
    	return [
    		'guard' => 'api',
    		'model' => [
    			\App\Models\AdminUser::class
    		]
    	];
    	
5:运行迁移

    php artisan migrate
    
这样就配置完成，系统会自动记录模型的增删改行为
    	
# 使用

    ActionLog::createActionLog('delete',"删除的id:".$data->id, $guard);//主动记录