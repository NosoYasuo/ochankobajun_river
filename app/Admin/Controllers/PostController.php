<?php

namespace App\Admin\Controllers;

use App\Models\Post;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('message', __('Message'));
        $grid->column('file_name', __('File name'));
        $grid->column('y_id', __('Y id'));
        $grid->column('file_ext', __('File ext'));
        $grid->column('river_id', __('River id'));
        $grid->column('address', __('Address'));
        $grid->column('latitude', __('Latitude'));
        $grid->column('longitude', __('Longitude'));
        $grid->column('user_id', __('User id'));
        $grid->column('user_name', __('User name'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('message', __('Message'));
        $show->field('file_name', __('File name'));
        $show->field('y_id', __('Y id'));
        $show->field('file_ext', __('File ext'));
        $show->field('river_id', __('River id'));
        $show->field('address', __('Address'));
        $show->field('latitude', __('Latitude'));
        $show->field('longitude', __('Longitude'));
        $show->field('user_id', __('User id'));
        $show->field('user_name', __('User name'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Post());

        $form->text('title', __('Title'));
        $form->textarea('message', __('Message'));
        $form->textarea('file_name', __('File name'));
        $form->textarea('y_id', __('Y id'));
        $form->number('file_ext', __('File ext'));
        $form->number('river_id', __('River id'));
        $form->text('address', __('Address'));
        $form->decimal('latitude', __('Latitude'));
        $form->decimal('longitude', __('Longitude'));
        $form->number('user_id', __('User id'));
        $form->text('user_name', __('User name'));

        return $form;
    }
}
