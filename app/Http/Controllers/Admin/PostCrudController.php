<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use App\Models\PostToCategory;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

/**
 * Class PostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PostCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Post::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/post');
        CRUD::setEntityNameStrings('post', 'posts');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('title');
        CRUD::column('content');
        CRUD::column('slug');
        CRUD::column('published');
        // CRUD::column('image');
        $this->crud->addColumn([
            'name' => 'image',
            'label' => 'Image',
            'type' => 'image',
            'height' => '100px',
            'width' => '100px',
        ]);
        $this->crud->addColumn([
            'label' => 'Author',
            'type' => 'select',
            'name' => 'author_id',
            'entity' => 'author',
            'attribute' => 'name',
            'model' => "App\Models\User",
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation([
            'title' => 'required|min:2',
            'slug' => 'required|min:2|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'content' => 'required|min:2',
            'author_id' => 'required|exists:users,id',
            'published' => 'required|boolean',
        ]);
        
        CRUD::field('title');
        $this->crud->field('content')->type('ckeditor');
        $this->crud->addField([
            'name'  => 'slug',
            'target'  => 'title', // will turn the title input into a slug
            'label' => "Slug",
            'type'  => 'slug',
        ]);
        $this->crud->addField([
            'name' => 'image',
            'label' => 'Header Image',
            'type' => 'image',
            'crop' => true,
            'aspect_ratio' => 3,
        ]);
        $this->crud->addField([
            'label' => 'Category',
            'type' => 'select2_multiple',
            'name' => 'categories', // the method that defines the relationship in your Model
            'entity' => 'categories', // the method that defines the relationship in your Model
            'model' => "App\Models\Category", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot' => true
        ]);
        $this->crud->addField([
            'type' => 'switch',
            'name' => 'published',
            'label' => 'Published',
            'color' => 'primary', // May be any bootstrap color class or an hex color
            'onLabel' => '✓',
            'offLabel' => '✕',
            'value' => request('published'),
        ]);
        $this->crud->addField([
            'name'  => 'author_id',
            'type'  => 'hidden',
            'value' => backpack_user()->id
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function store(Request $request)
    {
        $this->crud->setRequest($this->crud->validateRequest());
        DB::beginTransaction();
        try {
            $post = $this->crud->create($request->except(['categories']));
            $categories = $request->input('categories');

            if ($categories) {
                foreach ($categories as $category) {
                    $postToCategory = new PostToCategory();
                    $postToCategory->post_id = $post->id;
                    $postToCategory->category_id = $category;
                    $postToCategory->save();
                }
            }

            DB::commit();
            return redirect()->route('post.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
