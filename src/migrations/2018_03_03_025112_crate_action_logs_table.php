<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateActionLogsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('action_logs')) {
			Schema::create('action_logs', function (Blueprint $table) {
				$table->increments('id');
				$table->integer("user_id")->nullable()->default(null)->comment("用户id");
				$table->string("username")->default(null)->comment("姓名");
				$table->string("guard",20)->nullable()->default(null);
				$table->string("type",50)->comment("操作类型");
				$table->ipAddress("ip")->comment("操作者ip");
				$table->string("browser",150)->comment("浏览器");
				$table->string("system",50)->comment("操作系统");
				$table->string("url",150)->comment('url');
				$table->string("content")->comment("操作描述");

				$table->timestamps();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('action_logs');
	}
}
