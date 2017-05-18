<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUserModel extends Model
{
    //This model is related to projects user
    protected $table='project_user';
    protected $fillable=['id'];
}

