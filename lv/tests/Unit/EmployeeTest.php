<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\Employee;
use App\Models\Company;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_create_employee()
    {
        $company = Company::factory()->create(); // Buat data perusahaan terlebih dahulu

        $response = $this->post(route('employees.store'), [
            'name' => 'Test Employee',
            'email' => 'test@employee.com',
            'company_id' => $company->id,
        ]);

        $response->assertStatus(201); // Pastikan response berhasil
        $this->assertDatabaseHas('employees', [
            'name' => 'Test Employee',
            'email' => 'test@employee.com',
            'company_id' => $company->id,
        ]);
    }

    /** @test */
    public function test_update_employee()
    {
        $employee = Employee::factory()->create(); // Buat data karyawan

        $response = $this->put(route('employees.update', $employee->id), [
            'name' => 'Updated Employee',
            'email' => 'updated@employee.com',
            'company_id' => $employee->company_id, // Pertahankan ID perusahaan yang sama
        ]);

        $response->assertStatus(200); // Pastikan response berhasil
        $this->assertDatabaseHas('employees', [
            'name' => 'Updated Employee',
            'email' => 'updated@employee.com',
        ]);
    }

    /** @test */
    public function test_delete_employee()
    {
        $employee = Employee::factory()->create(); // Buat data karyawan

        $response = $this->delete(route('employees.destroy', $employee->id));

        $response->assertStatus(200); // Pastikan response berhasil
        $this->assertDatabaseMissing('employees', [
            'id' => $employee->id,
        ]);
    }

    /** @test */
    public function test_show_employee()
    {
        $employee = Employee::factory()->create(); // Buat data karyawan

        $response = $this->get(route('employees.show', $employee->id));

        $response->assertStatus(200); // Pastikan response berhasil
        $response->assertJsonFragment([
            'id' => $employee->id,
            'name' => $employee->name,
            'email' => $employee->email,
            'company_id' => $employee->company_id,
        ]);
    }
}
