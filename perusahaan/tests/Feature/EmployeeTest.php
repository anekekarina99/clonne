<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_can_be_created()
    {
        $company = Company::create(['name' => 'Sample Company', 'email' => 'sample@company.com']);

        $response = $this->post('/employees', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'company_id' => $company->id,
        ]);

        $response->assertRedirect('/employees');
        $this->assertDatabaseHas('employees', ['name' => 'John Doe']);
    }

    public function test_employee_can_be_updated()
    {
        $employee = Employee::create(['name' => 'Jane Doe', 'email' => 'jane@example.com', 'company_id' => 1]);

        $response = $this->put("/employees/{$employee->id}", [
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            // tambahkan field lain jika perlu
        ]);

        $response->assertRedirect('/employees');
        $this->assertDatabaseHas('employees', ['name' => 'Jane Smith']);
    }

    public function test_employee_can_be_deleted()
    {
        $employee = Employee::create(['name' => 'Delete Me', 'email' => 'delete@example.com', 'company_id' => 1]);

        $response = $this->delete("/employees/{$employee->id}");
        
        $response->assertRedirect('/employees');
        $this->assertDatabaseMissing('employees', ['name' => 'Delete Me']);
    }
}