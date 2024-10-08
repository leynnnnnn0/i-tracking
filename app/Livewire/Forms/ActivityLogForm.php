<?php

namespace App\Livewire\Forms;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ActivityLogForm extends Form
{
    public $user_id;
    public $action_type;
    public $description;
    public $model_type;
    public $model_id;
    public $before_data;
    public $after_data;

    public function rules()
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'action_type' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'model_type' => ['nullable', 'string', 'max:255'],
            'model_id' => ['nullable', 'integer'],
            'before_data' => ['nullable', 'array'],
            'after_data' => ['nullable', 'array'],
        ];
    }

    public function setActivityLog(Model $before, $after, $desciption, $action_type)
    {
        $this->user_id = auth()->user()->id;
        $this->action_type = $action_type;
        $this->description = $desciption;
        $this->model_type = $before::class;
        $this->model_id = $before->id;
        $this->before_data = $before->toArray();
        $this->after_data = $after;
    }
    public function store()
    {
        $this->validate();
        ActivityLog::create($this->all());
    }
}
