<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Storage;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_can_be_created()
    {
        $response = $this->post('/companies', [
            'name' => 'New Company',
            'email' => 'new@company.com',
            'logo' => UploadedFile::fake()->image('logo.png'),
            'website' => 'www.newcompany.com',
        ]);

        $response->assertRedirect('/companies');
        $this->assertDatabaseHas('companies', ['name' => 'New Company']);
        Storage::disk('local')->assertExists('company/logo.png'); // Verifikasi file tersimpan
    }

    public function test_company_can_be_updated()
    {
        $company = Company::create(['name' => 'Old Company', 'email' => 'old@company.com', 'logo' => '', 'website' => 'www.oldcompany.com']);

        $response = $this->put("/companies/{$company->id}", [
            'name' => 'Updated Company',
            'email' => 'updated@company.com',
            // tambahkan field lain jika perlu
        ]);

        $response->assertRedirect('/companies');
        $this->assertDatabaseHas('companies', ['name' => 'Updated Company']);
    }

    public function test_company_can_be_deleted()
    {
        $company = Company::create(['name' => 'Company to Delete', 'email' => 'delete@company.com']);

        $response = $this->delete("/companies/{$company->id}");
        
        $response->assertRedirect('/companies');
        $this->assertDatabaseMissing('companies', ['name' => 'Company to Delete']);
    }
}