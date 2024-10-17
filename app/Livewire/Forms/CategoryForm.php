<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryForm extends Form
{
    public $name;

    public function rules()
    {
        return [
            'name' => ['required']
        ];
    }

    public function store()
    {
        $this->validate();
        return Category::create($this->all());
    }

    public function setCategoryForm(Category $category)
    {
        $this->name = $category->name;
    }

    public function update(Category $category)
    {
        $this->validate();
        $category->update($this->all());
        return $category->fresh();
    }
}
