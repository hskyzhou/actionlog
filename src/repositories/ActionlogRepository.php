<?php
	namespace Hsky\Actionlog\Repositories;
	use DB;
	class ActionlogRepository{
		public function test(){
			echo 'test';
		}
		/**
		 * 记录用户行为日志
		 * @param		string  $action  操作名称
		 * @param       array|object    $old_data
		 * @param       array|object    $new_data
		 * $param 		array   $option
		 * @author		xezw211@gmail.com
		 * @date		2016-04-21 16:38:40
		 * @return		
		 */
		public function writeUserLog($action = '', $old_data = '', $new_data = '', $option=[]){
			$uid = '';
			if(isset($option['uid'])){
				$uid = $option['uid'];
			}else if(auth()->check()){
				$uid = auth()->user()->id;
			}

			$userLogData = [
				$uid,
				$action,
				json_encode($old_data),
				json_encode($new_data),
				isset($option['content']) ? $option['content'] : '',
				isset($option['module']) ? $option['module'] : '',
				isset($option['action_sql']) ? $option['action_sql'] : '',
				isset($option['reset_sql']) ? $option['reset_sql'] : '',
				isset($option['group']) ? $option['group'] : '',
				request()->ip(),
			];

			try {
				$sql = "insert into " . config('actionlog.userlog') . " (`uid`, `action`, `old_data`, `new_data`, `content`, `module`, `action_sql`, `reset_sql`, `group`, `ip`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";
				return DB::insert($sql, $userLogData);
			} catch (Exception $e) {
				\Log::error("用户行为日志记录失败");
				return false;
			}
		}

		/*select行为*/
		public function writeUserSelectLog($old_data = '', $new_data = '', $option = []){
			$this->writeUserLog('select', $old_data, $new_data, $option);
		}
		/*insert行为*/
		public function writeUserInsertLog(){
			$this->writeUserLog('insert', $old_data, $new_data, $option);
		}
		/*update行为*/
		public function writeUserUpdateLog(){
			$this->writeUserLog('update', $old_data, $new_data, $option);
		}
		/*delete行为*/
		public function writeUserDeleteLog(){
			$this->writeUserLog('delete', $old_data, $new_data, $option);
		}

		/**
		 * 记录api访问日志
		 * @param		array   $data
		 * @author		xezw211@gmail.com
		 * @date		2016-04-21 16:38:50
		 * @return		
		 */
		public function writeApiLog($url = '', $option = []){
			$uid = '';
			if(isset($option['uid'])){
				$uid = $option['uid'];
			}else if(auth()->check()){
				$uid = auth()->user()->id;
			}

			$apiLogData = [
				$url,
				$uid,
				isset($option['from']) ? $option['from'] : request('from', ''),
				isset($option['app']) ? $option['app'] : request('app', ''),
				isset($option['data']) ? json_encode($option['data']) : request('data', ''),
				request()->ip(),
			];

			try {
				$sql = "insert into " . config('actionlog.apilog') . " (`url`, `uid`, `from`, `app`, `data`, `ip`) values (?, ?, ?, ?, ?, ?) ";
				return DB::insert($sql, $apiLogData);
			} catch (Exception $e) {
				\Log::error("api记录日志记录失败");
				return false;
			}
		}
	}