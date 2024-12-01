<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\Company;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_create_company()
    {
        $response = $this->post(route('companies.store'), [
            'name' => 'Test Company',
            'email' => 'test@company.com',
            'logo' => UploadedFile::fake()->image('logo.png', 100, 100),
            'website' => 'http://testcompany.com',
        ]);

        $response->assertStatus(201); // Pastikan response berhasil
        $this->assertDatabaseHas('companies', [
            'name' => 'Test Company',
            'email' => 'test@company.com',
        ]);
    }

    /** @test */
    public function test_update_company()
    {
        $company = Company::factory()->create();

        $response = $this->put(route('companies.update', $company->id), [
            'name' => 'Updated Company',
            'email' => 'updated@company.com',
            'logo' => UploadedFile::fake()->image('updated_logo.png', 100, 100),
            'website' => 'http://updatedcompany.com',
        ]);

        $response->assertStatus(200); // Pastikan response berhasil
        $this->assertDatabaseHas('companies', [
            'name' => 'Updated Company',
            'email' => 'updated@company.com',
        ]);
    }

    /** @test */
    public function test_delete_company()
    {
        $company = Company::factory()->create();

        $response = $this->delete(route('companies.destroy', $company->id));

        $response->assertStatus(200); // Pastikan response berhasil
        $this->assertDatabaseMissing('companies', [
            'id' => $company->id,
        ]);
    }

    /** @test */
    public function test_show_company()
    {
        $company = Company::factory()->create();

        $response = $this->get(route('companies.show', $company->id));

        $response->assertStatus(200); // Pastikan response berhasil
        $response->assertJsonFragment([
            'id' => $company->id,
            'name' => $company->name,
            'email' => $company->email,
        ]);
    }
}
