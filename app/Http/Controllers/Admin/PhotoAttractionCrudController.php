<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PhotoAttractionRequest;
use App\Models\Attraction;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PhotoAttractionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PhotoAttractionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\PhotoAttraction::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/photoattraction');
        CRUD::setEntityNameStrings('foto ponto turístico', 'Fotos Ponto Turístico');
    }

    protected function setupListOperation()
    {
        CRUD::column('name')->label('Nome');
        CRUD::column('url_link')->label('Foto')->type('image');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(PhotoAttractionRequest::class);
        CRUD::field('name')->label('Nome');
//        CRUD::field('url')->label('Foto')->type('image');

        $this->crud->addField([
            'label' => "Foto",
            'name' => "url",
            'type' => 'image',
            'prefix' => 'storage/files/images/'
        ]);

        $attractionsModel = Attraction::all();
        $attractions = [];

        foreach ($attractionsModel as $item) {
            $attractions[$item['id']] = $item['name'];
        }

        $this->crud->addField([
            'name'    => 'attraction_id',
            'label'   => 'Ponto Turístico',
            'type'    => 'select_from_array',
            'options' => $attractions,
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
