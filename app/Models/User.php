<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{    
    protected $table = "users";
    public $timestamp = false;
    protected $fillable = ['id','name', 'title'];
 }