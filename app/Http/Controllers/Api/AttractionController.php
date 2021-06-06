<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AttractionResource;
use App\Models\Attraction;

class AttractionController extends BasicCrudController
{

    private $rules;

    public function __construct()
    {
        $this->rules = [
            'name' => 'required|max:255',
            'description' => 'required',
            'coordinates' => 'required'
        ];;
    }

    protected function model()
    {
        return Attraction::class;
    }

    protected function rulesStore(): array
    {
        return $this->rules;
    }

    protected function rulesUpdate(): array
    {
        return $this->rules;
    }

    protected function resource(): string
    {
        return AttractionResource::class;
    }
}
