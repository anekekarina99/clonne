@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Companies</h1>

    {{-- Navigation Buttons --}}
    <div class="mb-3">
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">All Companies</a>
        <button class="btn btn-primary" id="btn-create-company">Add New Company</button>
    </div>

    {{-- Index: List Companies --}}
    @if(request()->is('companies'))
        <div>
            <h2>List of Companies</h2>
            @if($companies->count())
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Logo</th>
                            <th>Website</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                        <tr>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->email }}</td>
                            <td><img src="{{ Storage::url($company->logo) }}" alt="logo" width="50"></td>
                            <td>{{ $company->website }}</td>
                            <td>
                                <a href="{{ route('companies.edit', $company) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('companies.destroy', $company) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $companies->links() }}
            @else
                <p>No companies found.</p>
            @endif
        </div>
    @endif

    {{-- Form: Create/Edit Company --}}
    @if(request()->is('companies/create') || request()->is('companies/*/edit'))
        <div>
            <h2>{{ isset($company) ? 'Edit Company' : 'Add New Company' }}</h2>
            <form 
                action="{{ isset($company) ? route('companies.update', $company) : route('companies.store') }}" 
                method="POST" 
                enctype="multipart/form-data">
                @csrf
                @if(isset($company)) 
                    @method('PUT') 
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $company->name ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $company->email ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="website" class="form-label">Website</label>
                    <input type="text" class="form-control" name="website" value="{{ old('website', $company->website ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" class="form-control" name="logo">
                    @if(isset($company) && $company->logo)
                        <img src="{{ Storage::url($company->logo) }}" alt="logo" width="100" class="mt-2">
                    @endif
                </div>

                <button type="submit" class="btn btn-success">{{ isset($company) ? 'Update' : 'Create' }}</button>
            </form>
        </div>
    @endif
</div>
@endsection
