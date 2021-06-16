<?php

namespace App\Admin\Controllers;

use App\Entities\Post;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Str;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Post';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'))->limit(50);
        $grid->column('image', __('Image'))->image('', 50, 50);;
        $grid->column('content', __('Content'))->display(function ($content) {
            return strip_tags(Str::words($content, 20));
        });
        $grid->column('user.name', __('Author'));
        $grid->column('status', __('Status'))->label([
            'draft' => 'danger',
            'pending' => 'warning',
            'published' => 'success'
        ]);
        $grid->column('created_at', __('Created at'))->display(function ($created_at) {
            return Carbon::parse($created_at)->format('d/m/Y');
        });

        //config filter
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->contains('title', __('Title'));
            $filter->contains('content', __('Content'));
            $filter->where(function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->where('name', 'like', "%{$this->input}%");
                });

            }, 'Author');
            $filter->equal('status', __('Status'))->select(['published' => 'Published', 'pending' => 'Pending', 'draft' => 'Draft']);
            $filter->between('created_at', __('Created At'))->datetime();
        });

        $grid->quickSearch('title', 'content');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id): Show
    {
        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('image', __('Image'));
        $show->field('content', __('Content'));
        $show->field('user_id', __('User id'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new Post());

        $form->text('title', __('Title'));
        $form->image('image', __('Image'));
        $form->textarea('content', __('Content'));
        $form->number('user_id', __('User id'));
        $form->text('status', __('Status'))->default('published');

        return $form;
    }
}
