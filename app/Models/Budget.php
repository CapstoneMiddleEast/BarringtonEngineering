<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = ['project_name', 'date_files_uploaded', 'file_path'];
}
