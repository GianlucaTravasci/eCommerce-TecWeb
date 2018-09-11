<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Queries\CategoryQuery;
use Framework\Responses\Response;

/**
 * Manage products
 *
 * @package App\controllers
 */
class ProductController extends BaseAdminController
{
    const PRODUCTS_PER_PAGE = 15;

    /**
     * Display products
     *
     * @return Response
     */
    public function index()
    {
        return $this->view(
            'admin.products.index',
            $this->paginate(
                Product::orderBy('id', SORT_ASC),
                static::PRODUCTS_PER_PAGE,
                'products'
            )
        );
    }

    /**
     * Display product
     *
     * @return string
     */
    public function get()
    {
        $product = Product::find($this->request->get('id', 0));

        if (is_null($product)) {
            return $this->view('error.404', [], 404);
        }

        $categories = CategoryQuery::grouped();

        return $this->view('admin.products.show', compact('product', 'categories'));
    }

    /**
     * Display product create form
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('admin.products.create', [
            'categories' => CategoryQuery::grouped(),
        ]);
    }

    /**
     * Insert a product
     *
     * @return string
     */
    public function store()
    {
        $input = $this->validateInput();

        if (is_null($input)) {
            return $this->redirect('/admin/products/create')
                ->withInput();
        }

        $product = new Product($input);
        $product->save();

        return $this->redirect('/admin/product?id=' . $product->id);
    }

    /**
     * Update category
     *
     * @return string
     */
    public function update()
    {
        $product = Product::find($this->request->get('id', 0));

        if (is_null($product)) {
            return $this->view('error.404', [], 404);
        }

        $input = $this->validateInput();

        if (is_null($input)) {
            return $this->redirect('/admin/product?id=' . $product->id)
                ->withInput();
        }

        $product->setAttributes($input);

        if ($this->request->hasFile('image') && fnmatch('image/*', $this->request->mimeType('image'))) {
            $file = $this->request->file('image');
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

            // Slug based or more accurate name would be better
            // as well as cropping image to needed sizes.
            // We don't know if GD or Imagick extensions
            // are available, so we keep it simple™.
            $image = "product_{$product->id}.{$ext}";

            if ($product->image) {
                @unlink(storage_path("images/{$product->image}"));
            }

            if (!copy($file['tmp_name'], storage_path("images/{$image}"))) {
                return $this->view('error.500', [], 500);
            }

            $product->image = $image;
        }

        $product->save();

        return $this->redirect('/admin/product?id=' . $product->id)
            ->withFlash([
                'success' => 'product_updated',
            ]);
    }

    /**
     * Delete a product
     *
     * @return string
     */
    public function destroy()
    {
        $product = Product::find($this->request->get('id', 0));

        if (is_null($product)) {
            return $this->view('error.404', [], 404);
        }

        if (!$product->isDeletable()) {
            return $this->redirect('/admin/product?id=' . $product->id);
        }

        $product->destroy();

        return $this->redirect('/admin/products');
    }

    /**
     * Delete a product image
     *
     * @return string
     */
    public function destroyImage()
    {
        $product = Product::find($this->request->get('id', 0));

        if (is_null($product)) {
            return $this->view('error.404', [], 404);
        }

        $path = storage_path('images/' . $product->image);

        $product->image = null;
        $product->save();

        if (file_exists($path)) {
            @unlink($path);
        }

        return $this->redirect('/admin/product?id=' . $product->id);
    }

    /**
     * Validate and sanitize input
     *
     * @return null|array
     */
    protected function validateInput()
    {
        $name = $this->request->post('name');
        $category_id = $this->request->post('category_id', 0);
        $price = $this->request->post('price');
        $description = $this->request->post('description');
        $homepage = !!$this->request->post('homepage', false);

        if (empty($name) || empty($category_id) || !is_numeric($price)) {
            return null;
        }

        $category = Category::find($category_id);

        if (is_null($category) || !$category->parent_id) {
            return null;
        }

        return compact('name', 'category_id', 'price', 'description', 'homepage');
    }
}
