<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{   
    use Notifiable;
    use HasFactory;
        protected $fillable = [
        'name', 'email','logo', 'website'
    ];

    public function Emp()
    {
        return Employee::where('company_id', $this->id)->count();
    }
}
