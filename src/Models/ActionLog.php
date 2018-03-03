<?php
namespace SheaXiang\ActionLog\Models;

use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model {

	/**
	 * @var array
	 */
	protected $fillable = ['user_id','username','type','ip','content'];
}