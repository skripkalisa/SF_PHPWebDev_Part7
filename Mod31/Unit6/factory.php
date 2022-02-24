<?php
interface IUser
{
    public function getName();
}

class User implements IUser
{
    public function __construct($id)
    {
    }
    public function getName()
    {
        return "Jack";
    }
}

class UserFactory
{
    public static function Create($id)
    {
        return new User($id);
    }
}

$uo = UserFactory::Create(1);
echo($uo->getName()."\n");
