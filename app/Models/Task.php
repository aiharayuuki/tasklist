<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

// app/Models/Task.php

protected $fillable = ['content', 'status'];

public function user()
{
    return $this->belongsTo(User::class);
}

}

