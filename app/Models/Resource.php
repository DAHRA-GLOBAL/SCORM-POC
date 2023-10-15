<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Peopleaps\Scorm\Model\ScormModel;

class Resource extends Model
{
    use HasFactory;

    public function scorms()
    {
        return $this->morphMany(ScormModel::class, 'resourceable');
    }
}
