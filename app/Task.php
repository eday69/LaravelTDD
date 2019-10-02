<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Task extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    // changes the updated table field of project
    protected $touches = ['project'];

    protected $casts = [
      'completed' => 'boolean'
    ];

    protected static $recordableEvents = ['created', 'deleted'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

    public function complete()
    {
        $this->update(['completed' => true]);
        $this->recordActivity('completed_task');
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);
        $this->recordActivity('incompleted_task');
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }
}
