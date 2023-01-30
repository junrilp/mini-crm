<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use WithFaker;
    /**
     * Return all companies.
     *
     * @return void
     */
    public function test_get_companies()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/companies');

        $response->assertOk();
    }

    /**
     * Add new company.
     *
     * @return void
     */
    public function test_add_company()
    {
        $user = User::factory()->create();

        Storage::fake('images');
        $file = UploadedFile::fake()->image('avatar.jpg', 120, 120);
      
        $array = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'logo' => $file,
            'website' =>  $this->faker->url
        ];

        $response = $this
            ->actingAs($user)
            ->post('/companies', $array);
        
        $response
            ->assertRedirectToRoute('companies.index');
    }

     /**
     * update new company.
     *
     * @return void
     */
    public function test_update_company()
    {
        $user = User::factory()->create();

        Storage::fake('images');
        $file = UploadedFile::fake()->image('avatar.jpg', 120, 120);
      
        $array = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'logo' => $file,
            'website' =>  $this->faker->url
        ];

        $response = $this
            ->actingAs($user)
            ->patch('/companies/' . 1, $array);
        
        $response
            ->assertRedirectToRoute('companies.index');
    }

     /**
     * delete new company.
     *
     * @return void
     */
    public function test_delete_company()
    {
        $user = User::factory()->create();

        $data = [ 'company_id' => 1 ];
        $response = $this
            ->actingAs($user)
            ->delete('/companies/' . 1, $data);
        
        $response
            ->assertRedirectToRoute('companies.index');
    }
}
