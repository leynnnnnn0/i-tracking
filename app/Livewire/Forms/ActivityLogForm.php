<?php

namespace App\Livewire\Forms;

use App\Models\ActivityLog;
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

    public function setActivityLog($before, $after, $desciption, $action_type)
    {
        $this->user_id = auth()->user()->id;
        $this->action_type = $action_type;
        $this->description = $desciption;
        $this->before_data = !$before ? $before : $before->toArray();
        $this->after_data = !$after ? $after : $after->toArray();
        self::setModelType($before, $after);
        self::setId($before, $after);
    }

    public function setId($before, $after)
    {
        if ($before) {
            $this->model_id = $before->id;
        } elseif ($after) {
            $this->model_id = $after->id;
        } else {
            $this->model_id = 'N/A';
        }
    }

    public function setModelType($before, $after)
    {
        if ($before) {
            $this->model_type = $before::class;
        } elseif ($after) {
            $this->model_type = $after::class;
        } else {
            $this->model_type = 'N/A';
        }
    }
    public function store()
    {
        $this->validate();
        ActivityLog::create($this->all());
    }
}
