<?php

namespace App\Modules\Blog;

use App\Modules\Blog\Http\Controllers\Admin\BlogController;
use Charlotte\Administration\Helpers\Dashboard;
use Charlotte\Administration\Interfaces\Structure;
use Illuminate\Support\Facades\Route;

class  Administration implements Structure {


    public function routes() {
        Route::resource('blog', BlogController::class);
    }

    public function menu($menu) {
        $menu->add("Blog", ['icon' => 'ti-comments']);

        $menu->get('blog')->add('Add', ['url' => \Charlotte\Administration\Helpers\Administration::route('blog.create')]);
        $menu->get('blog')->add('View all', ['url' => \Charlotte\Administration\Helpers\Administration::route('blog.index')]);

//        $menu->add("Users", ['url' => \Charlotte\Administration\Helpers\Administration::route('blog.edit', ['id' => 3]), 'icon' => 'ti-user']);

    }

    public function dashboard() {
        $dashboard = new Dashboard();

        $dashboard->colorBox('haha', 3);


        return $dashboard->generate();
    }


    public function settings($model, $form, $form_model) :void {
        $form->add('title', 'text', [
            'title' => 'Title',
            'translate' => true,
            'model' => $form_model
        ]);
    }
}
