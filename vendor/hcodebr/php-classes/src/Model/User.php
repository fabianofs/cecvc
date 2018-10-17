<?php 

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;
use \Hcode\Mailer;

class User extends Model {

	const SESSION = "User";
	const SECRET = "HcodePhp7_Secret";
	const ERROR = "UserError";
	const ERROR_REGISTER = "UserErrorRegister";
	const SUCCESS = "UserSUCCESS";


	public static function login($login, $password)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(

			":LOGIN"=>$login

		));

		if (count($results) === 0)
		{
			throw new \Exception("Usuário inexistente ou senha inválida.");
		}

		$data = $results[0];

		if (password_verify($password, $data["despassword"]) === true)
		{

			$user = new User();

			$user->setiduser($data["iduser"]);

		} else{
			throw new \Exception("Usuário inexistente ou senha inválida.");
		}

	}

}

 ?>