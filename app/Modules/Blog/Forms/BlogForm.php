<?php

namespace App\Modules\Blog\Forms;

use App\Modules\Blog\Models\Blog;
use Charlotte\Administration\Helpers\AdministrationSeo;
use Kris\LaravelFormBuilder\Form;

class BlogForm extends Form {

    public function buildForm() {
        $this->add('title', 'text', [
            'title' => 'Title',
            'translate' => true,
            'model' => @$this->model
        ]);


        $this->add('description', 'editor', [
            'title' => 'Description',
            'translate' => true,
            'model' => @$this->model
        ]);


        AdministrationSeo::seoFields($this, $this->model);

        $this->add('active', 'switch', [
            'title' => 'Active',
        ]);

        $this->add('select', 'select', [
            'title' => 'dsasdass',
            'choices' => ['dada', 'kk']
        ]);

        $choices = Blog::all()->pluck('title', 'id')->toArray();
        $this->add('dasdas', 'multiple', [
            'title' => 'dsasdass',
            'choices' =>$choices,
        ]);


        $this->add('map', 'map', [
            'default_values' => [
                'lng' => 24.620621,
                'lat' => 43.408329,
                'zoom' => 11
            ]
        ]);


        $this->add('multiple', 'multiple', [
            'title' => 'Multi',
            'model' => @$this->model,
            'choices' => [
                1 => 'haha',
                2 => 'haha2',
                3 => 'haha3',
            ]
        ]);


        $this->add('submit', 'button', [
            'title' => 'Submit'
        ]);
    }
}