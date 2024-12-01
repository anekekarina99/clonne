@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Employees</h1>

    {{-- Navigation Buttons --}}
    <div class="mb-3">
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">All Employees</a>
        <button class="btn btn-primary" id="btn-create-employee">Add New Employee</button>
    </div>

    {{-- Index: List Employees --}}
    @if(request()->is('employees'))
        <div>
            <h2>List of Employees</h2>
            @if($employees->count())
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->company->name }}</td>
                            <td>
                                <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('employees.destroy', $employee) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $employees->links() }}
            @else
                <p>No employees found.</p>
            @endif
        </div>
    @endif

    {{-- Form: Create/Edit Employee --}}
    @if(request()->is('employees/create') || request()->is('employees/*/edit'))
        <div>
            <h2>{{ isset($employee) ? 'Edit Employee' : 'Add New Employee' }}</h2>
            <form 
                action="{{ isset($employee) ? route('employees.update', $employee) : route('employees.store') }}" 
                method="POST">
                @csrf
                @if(isset($employee)) 
                    @method('PUT') 
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $employee->name ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $employee->email ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="company_id" class="form-label">Company</label>
                    <select name="company_id" class="form-select" required>
                        <option value="">Select Company</option>
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ isset($employee) && $employee->company_id == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">{{ isset($employee) ? 'Update' : 'Create' }}</button>
            </form>
        </div>
    @endif
</div>
@endsection
