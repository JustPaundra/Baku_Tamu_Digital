<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'head_of_department', 'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}