<?php

namespace App\Modules\Blog\Http\Controllers\Admin;

use App\Modules\Blog\Forms\BlogForm;
use App\Modules\Blog\Models\Blog;
use Charlotte\Administration\Helpers\Administration;
use Charlotte\Administration\Helpers\AdministrationDatatable;
use Charlotte\Administration\Helpers\AdministrationField;
use Charlotte\Administration\Helpers\AdministrationForm;
use Charlotte\Administration\Helpers\Dashboard;
use Charlotte\Administration\Http\Controllers\BaseAdministrationController;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class BlogController extends BaseAdministrationController {

    public function index(DataTables $datatable) {

        $dashboard = new Dashboard();

        $dashboard->simpleBox('Users', 421412);
        $dashboard->simpleBox('Logged', 3214);
        $dashboard->simpleBox('Regular', 3211);
        $dashboard->colorBox('Regular', 3211);
        $dashboard->linkBox('Hackers', 3212, 'dsa');
        $dashboard->simpleBox('Hackers', 3);

        $dashboard->generate();

        $form = new AdministrationForm();
        $form->route(Administration::route('blog.store'));
        $form->form(BlogForm::class);


        Breadcrumbs::register('administration', function ($breadcrumbs) {
            $breadcrumbs->parent('base');
            $breadcrumbs->push('Blog', Administration::route('blog.index'));
            $breadcrumbs->push('Edit Article', Administration::route('blog.create'));
        });


        $form->generate();


        $columns = ['id', 'title', 'active', 'created_at', 'action'];
        $test = new AdministrationDatatable($datatable);
        $test->query(Blog::withTrashed()->reversed());
        $test->columns($columns);
        $test->addColumn('active', function ($article) {
            return AdministrationField::switch('active', $article);
        });
        $test->addColumn('action', function ($article) {
            $action = AdministrationField::edit(Administration::route('blog.edit', $article->id));
            $action .= AdministrationField::delete(Administration::route('blog.destroy', $article->id));
            $action .= AdministrationField::restore(Administration::route('blog.destroy', $article->id));
            $action .= AdministrationField::media($article, ['default', 'dodo']);
            return $action;
        });

        $test->smart(true);
        $test->filterColumn('title', function ($query, $keyword) {
            $query->whereHas('translations', function ($sub_q) use ($keyword) {
                $sub_q->where('title', 'LIKE', '%' . $keyword . '%');
            });
        });
        $test->rawColumns(['active', 'action']);

        return $test->generate();

    }

    public function create() {
        $form = new AdministrationForm();
        $form->route(Administration::route('blog.store'));
        $form->form(BlogForm::class);

        Breadcrumbs::register('administration', function ($breadcrumbs) {
            $breadcrumbs->parent('base');
            $breadcrumbs->push('Blog', Administration::route('blog.index'));
            $breadcrumbs->push('Create Article', Administration::route('blog.create'));
        });

        Administration::setTitle('Blog - Create');

        return $form->generate();
    }

    public function edit($id) {

        $blog = Blog::where('id', $id)->with(['translations'])->first();
        $form = new AdministrationForm();
        $form->route(Administration::route('blog.update', $blog->id));
        $form->form(BlogForm::class);
        $form->model($blog);
        $form->method('PUT');


        Breadcrumbs::register('administration', function ($breadcrumbs) {
            $breadcrumbs->parent('base');
            $breadcrumbs->push('Blog', Administration::route('blog.index'));
            $breadcrumbs->push('Edit Article', Administration::route('blog.create'));
        });

        Administration::setTitle('Blog - Edit');

        return $form->generate();
    }

    public function update($id, Request $request) {
        $blog = Blog::find($id);


    }

    public function store(Request $request) {
        $blog = new Blog();

        $blog->fill($request->all());
        $blog->save();

        if ($request->has('file')) {
            $blog->addMedia($request->file)->toMediaCollection('single');
        }


        return redirect(Administration::route('blog.index'));
    }

    public function destroy($id) {
        Blog::where('id', $id)->delete();
        return response()->json();
    }
}
