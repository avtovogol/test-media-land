<?php
/**
 * Created by PhpStorm.
 * User: Георгий
 * Date: 03.11.2019
 * Time: 18:38
 */

namespace app\controllers;

use Twig_Loader_Filesystem;

class SiteController
{
    public function actionHome()
    {
        $loader = new Twig_Loader_Filesystem('../app/views');
        $twig = new \Twig\Environment($loader);
        echo $twig->render('site/home.tmpl', ['status' => 'guest']);
    }

    public function actionSignup()
    {
        $loader = new Twig_Loader_Filesystem('../app/views');
        $twig = new \Twig\Environment($loader);
        echo $twig->render('site/signup.tmpl', ['status' => 'guest']);
    }
    public function actionSignin()
    {
        $loader = new Twig_Loader_Filesystem('../app/views');
        $twig = new \Twig\Environment($loader);
        echo $twig->render('site/signin.tmpl', ['status' => 'guest']);

    }

    public function actionAccount()
    {
        $loader = new Twig_Loader_Filesystem('../app/views');
        $twig = new \Twig\Environment($loader);
        echo $twig->render('site/account.tmpl', ['status' => 'guest']);
    }

}