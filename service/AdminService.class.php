<?php

	require_once "../database/SqlHelper.class.php";
	//该类是一个业务逻辑类，主要完成对admin表操作
	class AdminService{ 
		
		private $errMessage;
		
		/**
	 * @return the $errMessage
	 */
	public function getErrMessage() {
		return $this->errMessage;
	}

		/**
	 * @param field_type $errMessage
	 */
	public function setErrMessage($errMessage) {
		$this->errMessage = $errMessage;
	}

		//提供一个验证用户是否合法的方法
		public function checkAdmin($username,$password){
			$sql = "select password from t_admin where username='$username'";
			 
			//创建一个SqlHelper对象
			$sqlHelper = new SqlHelper();

			$res = $sqlHelper->execute_dql($sql);
			// if($row = mysql_fetch_assoc($res)) {
			if($row = $res->fetch_assoc()) {
				//比对密码 
				// if(md5($password) == $row['password']) {
				if(($password) == $row['password']) {
					return $username;
				}  
			} 
			//资源
			// mysql_free_result($res);
			mysqli_free_result($res);
			//关闭链接
			$sqlHelper->close_connect();
			return ""; 
		}
		
		/*修改密码*/
		public function ChangePassword($username,$oldPassword,$newPassword) {
			$result = false;
			$sql = "select password from t_admin where username='$username'"; 
	 
			//创建一个SqlHelper对象
			$sqlHelper = new SqlHelper();
			$res = $sqlHelper->execute_dql($sql);
			if($row = mysql_fetch_assoc($res)) {
				//比对密码
				if(md5($oldPassword) == $row['password']) {
					$sql = "update t_admin set password='".md5($newPassword)."' where username='$username'";
					if($sqlHelper->execute_dml($sql)!=0) $result = true;
					else {
						$this->errMessage = "更新失败！";
					}
				} else {
					$this->errMessage = "原始密码不正确";
				}
			}
			//资源
			mysql_free_result($res);
			//关闭链接
			$sqlHelper->close_connect();
			return $result;
		}
		
		
	}

?>