<?php

namespace models;

use core\Core;
use core\Model;

/**
 * @property string $login Логін користувача
 * @property string $password Пароль користувача
 * @property string $firstname Ім'я користувача
 * @property string $lastname Прізвище користувача
 * @property string $role Роль користувача
 * @property int $id ID користувача
 */
class Users extends Model
{
    public static $tableName = 'users';

    public static function FindByLoginAndPassword($login, $password)
    {
        $rows = self::findByCondition(['login' => $login, 'password' => $password]);
        if (!empty($rows))
            return $rows[0];
        else
            return null;
    }

    public static function FindByLogin($login)
    {
        $rows = self::findByCondition(['login' => $login]);
        if (!empty($rows))
            return $rows[0];
        else
            return null;
    }

    public static function IsUserLogged()
    {
        return !empty(Core::get()->session->get('user'));
    }
    public static function IsUserAdmin()
    {
        $user = Core::get()->session->get('user');
        return $user['role'] === 'admin';
    }

    public static function LoginUser($user)
    {
        Core::get()->session->set('user', $user);
    }

    public static function LogoutUser()
    {
        Core::get()->session->remove('user');
    }

    public static function RegisterUser($login, $password,$lastname, $firstname){
        $user = new Users();
        $user->login = $login;
        $user->password = $password;
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->saveInsert();
    }
    public static function getInitials($user): string
    {
        $firstname = $user['firstname'];
        $firstname = str_split($firstname, 1);
        $lastname = str_split($user['lastname'], 1);
        return strtoupper($firstname[0] . $lastname[0]);
    }
}