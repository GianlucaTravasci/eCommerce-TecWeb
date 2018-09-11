<?php

namespace App\Controllers\Admin;

use App\Models\Category;

/**
 * Manage categories
 *
 * @package App\controllers
 */
class CategoryController extends BaseAdminController
{
    /**
     * Display categories
     *
     * @return string
     */
    public function index()
    {
        $categories = Category::orderBy('id', SORT_ASC)->all();

        $rootCategories = array_filter($categories, function (Category $category) {
            return !$category->parent_id;
        });

        return $this->view('admin.categories.index', compact('categories', 'rootCategories'));
    }

    /**
     * Display category
     *
     * @return string
     */
    public function get()
    {
        $category = Category::find($this->request->get('id', 0));

        if (is_null($category)) {
            return $this->view('error.404', [], 404);
        }

        $rootCategories = Category::where('parent_id', null)
            ->where('id', '!=', $category->id)
            ->orderBy('id', SORT_ASC)
            ->all();

        return $this->view('admin.categories.show', compact('category', 'rootCategories'));
    }

    /**
     * Insert a category
     *
     * @return string
     */
    public function store()
    {
        $input = $this->validateInput();

        if (is_null($input)) {
            return $this->redirect('/admin/categories')
                ->withInput();
        }

        $category = new Category($input);
        $category->save();

        return $this->redirect('/admin/category?id=' . $category->id);
    }

    /**
     * Update category
     *
     * @return string
     */
    public function update()
    {
        $category = Category::find($this->request->get('id', 0));

        if (is_null($category)) {
            return $this->view('error.404', [], 404);
        }

        $input = $this->validateInput();

        if (is_null($input)) {
            return $this->redirect('/admin/category?id=' . $category->id)
                ->withInput();
        }

        $category->setAttributes($input);
        $category->save();

        return $this->redirect('/admin/category?id=' . $category->id)
            ->withFlash([
                'success' => 'category_updated',
            ]);
    }

    /**
     * Delete a category
     *
     * @return string
     */
    public function destroy()
    {
        $category = Category::find($this->request->get('id', 0));

        if (is_null($category)) {
            return $this->view('error.404', [], 404);
        }

        if (!$category->isDeletable()) {
            return $this->redirect('/admin/category?id=' . $category->id);
        }

        $category->destroy();

        return $this->redirect('/admin/categories');
    }

    /**
     * Validate and sanitize input
     *
     * @return null|array
     */
    protected function validateInput()
    {
        $name = $this->request->post('name');
        $parent_id = $this->request->post('parent_id', 0);

        if (empty($name)) {
            return null;
        }

        $parent = Category::find($parent_id);

        if (is_null($parent) || $parent->parent_id) {
            $parent_id = null;
        }

        return compact('name', 'parent_id');
    }
}
