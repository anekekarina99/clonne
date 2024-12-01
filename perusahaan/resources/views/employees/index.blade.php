@foreach ($employees as $employee)
    <div>
        <h3>{{ $employee->name }}</h3>
        <p>{{ $employee->email }}</p>
    </div>
@endforeach

{{ $employees->links() }} <!-- Pagination -->
