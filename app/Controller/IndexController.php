<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class IndexController {

    public function home()  : Response
    {
        return new Response('<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta http-equiv="X-UA-Compatible" content="ie=edge"><title>Тестовый фронт на реакт</title></head><body><div id="root"></div><script type="text/javascript" src="index.js"></script></body></html>');
    }
}