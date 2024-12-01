<html>
<head>
    <title>Employee List</title>
</head>
<body>
    <h1>Employees</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Company</th>
        </tr>
        @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->company->name }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
