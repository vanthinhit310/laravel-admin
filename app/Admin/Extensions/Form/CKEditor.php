<?php


namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class CKEditor extends Field
{
    public static $js = [
        '/packages/ckeditor/ckeditor.js',
        '/packages/ckeditor/adapters/jquery.js',
    ];

    protected $view = 'admin.ckeditor';

    public function render()
    {
        $this->script = "$('textarea.{$this->getElementClassString()}').ckeditor({
            height: 500,
            filebrowserImageUploadUrl: '/admin/file-upload',
            removePlugins: 'base64image',
        });";

        return parent::render();
    }
}
