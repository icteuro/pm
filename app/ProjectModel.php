<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    //This model is related to projects
    protected $table='projects';
    protected $fillable=['project_name'];
}

