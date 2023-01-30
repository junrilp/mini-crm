<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'email', 'logo', 'address', 'website'];

    protected $perPage = 10;

    public function nameLink()
    {
        return link_to_route('companies.show', $this->name, [$this], [
            'title' => trans(
                'app.show_detail_title',
                ['name' => $this->name, 'type' => trans('company.company')]
            ),
        ]);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
