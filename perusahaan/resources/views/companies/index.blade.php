@foreach ($companies as $company)
    <div>
        <h3>{{ $company->name }}</h3>
        <p>{{ $company->email }}</p>
        <p>{{ $company->website }}</p>
    </div>
@endforeach

{{ $companies->links() }} <!-- Pagination -->
