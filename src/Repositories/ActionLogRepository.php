<?php
namespace SheaXiang\ActionLog\Repositories;

use SheaXiang\ActionLog\Services\clientService;

class ActionLogRepository {

	/**
	 * 记录用户操作日志
	 * @param $type
	 * @param $content
	 * @param string $guard
	 * @return mixed
	 */
    public function createActionLog($type, $content, $guard = 'api')
    {
    	$actionLog = new \SheaXiang\ActionLog\Models\ActionLog();
    	if(auth("$guard")->check()){
			$actionLog->guard = $guard;
    		$actionLog->user_id = auth("$guard")->user()->id;
    		$actionLog->username = auth("$guard")->user()->name;
    	}else{
			$actionLog->guard = null;
    		$actionLog->user_id= null;
    		$actionLog->username ="访客";
    	}
       	$actionLog->browser = clientService::getBrowser($_SERVER['HTTP_USER_AGENT'],true);
       	$actionLog->system = clientService::getPlatForm($_SERVER['HTTP_USER_AGENT'],true);
       	$actionLog->url = request()->getRequestUri();
        $actionLog->ip = request()->getClientIp();
        $actionLog->type = $type;
        $actionLog->content = $content;
        $res = $actionLog->save();

        return $res;
    }
}