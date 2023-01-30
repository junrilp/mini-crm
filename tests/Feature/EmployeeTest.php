<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use WithFaker;
    /**
     * Return all employees.
     *
     * @return void
     */
    public function test_get_employees()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/employees');

        $response->assertOk();
    }

    /**
     * Add new employee.
     *
     * @return void
     */
    public function test_add_employee()
    {
        $user = User::factory()->create();

        $company = Company::first();

        $array = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'company_id' => $company->id,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
        ];

        $response = $this
            ->actingAs($user)
            ->post('/employees', $array);
        
        $response
            ->assertRedirectToRoute('employees.index');
    }

     /**
     * update new employee.
     *
     * @return void
     */
    public function test_update_employee()
    {
        $user = User::factory()->create();

        $company = Company::first();

        $employee = Employee::first();
        $array = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'company_id' => $company->id,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
        ];

        $response = $this
            ->actingAs($user)
            ->patch('/employees/' . $employee->id, $array);
        
        $response
            ->assertRedirectToRoute('employees.index');
    }

     /**
     * delete new employee.
     *
     * @return void
     */
    public function test_delete_employee()
    {
        $user = User::factory()->create();

        $employee = Employee::first();

        $data = [ 'employee_id' => $employee->id ];
        $response = $this
            ->actingAs($user)
            ->delete('/employees/' . $employee->id, $data);
        
        $response
            ->assertRedirectToRoute('employees.index');
    }
}
