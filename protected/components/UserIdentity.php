<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	private $_nick_name;
	
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate($autoLogin=FALSE)
	{

		$user_telephone =trim($this->username);
        $user = User::model()->getUserByLoginName($user_telephone);
		if (!isset($user))
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if($user['u_error_count']>5){
			$this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
		}else if($user->validatePassword($this->password) || $autoLogin){
			$this->_id = $user->id;

			$this->username = $user['u_tel'];
			$this->_nick_name = $user->u_name;
			$this->errorCode=self::ERROR_NONE;
		}
		else 
		{
			$this->_id = $user->id;
			$this->errorCode = self::ERROR_PASSWORD_INVALID;

		}

		return $this->errorCode;
	}
	
	/**
	 * 返回用户ID
	 */
	public function getId()
	{
		return $this->_id;
	}
	
	public function  getName()
	{
		return  $this->_nick_name;
	}
	
	public function getUserName()
	{
		return $this->username;
	}
	
}