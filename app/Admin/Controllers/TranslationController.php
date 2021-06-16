<?php


namespace App\Admin\Controllers;


use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;
Use Encore\Admin\Admin;

class TranslationController extends Controller
{
    public function index(Content $content)
    {
        $content->breadcrumb(
            ['text' => 'Dashboard', 'url' => '/admin'],
            ['text' => 'Translation manager']
        );

        $content->body(view('admin.pages.translations.index')->render());

        return $content->render();
    }
}
