<!-- resources/views/companies/create.blade.php -->
<form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="name">Nama Perusahaan:</label>
    <input type="text" name="name" value="{{ old('name') }}" required>
    @error('name')
        <div>{{ $message }}</div>
    @enderror

    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ old('email') }}" required>
    @error('email')
        <div>{{ $message }}</div>
    @enderror

    <label for="logo">Logo:</label>
    <input type="file" name="logo" required>
    @error('logo')
        <div>{{ $message }}</div>
    @enderror

    <label for="website">Website:</label>
    <input type="url" name="website" value="{{ old('website') }}" required>
    @error('website')
        <div>{{ $message }}</div>
    @enderror

    <!-- Dropdown untuk memilih company (menggunakan Select2) -->
    <label for="company_id">Pilih Perusahaan:</label>
    <select id="company-select" name="company_id">
        <option value="">Select Company</option>
    </select>
    @error('company_id')
        <div>{{ $message }}</div>
    @enderror

    <button type="submit">Tambah Perusahaan</button>
</form>

<!-- Form Import Excel -->
<hr>
<form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="file">Import Data Employees (Excel):</label>
    <input type="file" name="file" accept=".xlsx,.csv" required>
    @error('file')
        <div>{{ $message }}</div>
    @enderror
    <button type="submit">Import Employees</button>
</form>
@push('scripts')
    <!-- Menyertakan Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- Menyertakan Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 dengan AJAX untuk mengambil data perusahaan
            $('#company-select').select2({
                ajax: {
                    url: '{{ route('companies.select2') }}', // Endpoint AJAX untuk mengambil data perusahaan
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: data.map(function(company) {
                                return {
                                    id: company.id,
                                    text: company.name
                                };
                            })
                        };
                    }
                },
                placeholder: 'Pilih Perusahaan',
                allowClear: true
            });
        });
    </script>
@endpush
