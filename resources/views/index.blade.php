<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <title>Student List</title>
</head>
<style>
    /* Modern CSS Reset */
    *, *::before, *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    :root {
        --primary-color: #4f46e5;
        --primary-hover: #4338ca;
        --danger-color: #ef4444;
        --danger-hover: #dc2626;
        --success-color: #22c55e;
        --background-color: #f8fafc;
        --card-background: #ffffff;
        --text-color: #1f2937;
        --border-color: #e5e7eb;
        --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--background-color);
        color: var(--text-color);
        line-height: 1.6;
        padding: 2rem;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Headers */
    h1, h2, h3 {
        color: var(--text-color);
        margin-bottom: 1.5rem;
        font-weight: 600;
    }

    h1 {
        font-size: 2.25rem;
        text-align: center;
        margin-bottom: 2rem;
    }

    /* Success Message */
    .success-message {
        background-color: var(--success-color);
        color: white;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        animation: slideIn 0.3s ease-out;
    }

    /* Export Button */
    .export-btn {
        display: inline-block;
        background-color: var(--primary-color);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        text-decoration: none;
        margin-bottom: 2rem;
        transition: background-color 0.2s;
    }

    .export-btn:hover {
        background-color: var(--primary-hover);
    }

    /* Form Styles */
    .form-container {
        background-color: var(--card-background);
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: var(--shadow);
        margin-bottom: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        font-size: 1rem;
        transition: border-color 0.2s;
    }

    input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    button[type="submit"] {
        padding: 0.75rem 1.5rem;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        font-weight: 500;
        transition: background-color 0.2s;
    }

    button[type="submit"]:hover {
        background-color: var(--primary-hover);
    }

    .button-group {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    /* Table Styles */
    .table-container {
        background-color: var(--card-background);
        border-radius: 0.75rem;
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-top: 2rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    th, td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
    }

    th {
        background-color: #f9fafb;
        font-weight: 600;
    }

    tr:hover {
        background-color: #f9fafb;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-edit {
        color: var(--primary-color);
        text-decoration: none;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        background-color: rgba(79, 70, 229, 0.1);
    }

    .btn-edit:hover {
        background-color: rgba(79, 70, 229, 0.2);
    }

    .btn-delete {
        background-color: rgba(239, 68, 68, 0.1);
        color: var(--danger-color);
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 0.375rem;
        cursor: pointer;
    }

    .btn-delete:hover {
        background-color: rgba(239, 68, 68, 0.2);
    }

    /* Animations */
    @keyframes slideIn {
        from {
            transform: translateY(-1rem);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        body {
            padding: 1rem;
        }

        .form-container {
            padding: 1.5rem;
        }

        .button-group {
            flex-direction: column;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            font-size: 0.8125rem;
        }

        th, td {
            padding: 0.75rem;
        }

        .action-buttons {
            flex-direction: column;
        }
    }
</style>
<body>

<div class="container">
    <h1>Student List</h1>

    <!-- Success message -->
    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <!-- Export button -->
    <a href="{{ route('export') }}" class="export-btn">Export to CSV</a>

    <!-- Student Form (Create/Edit) -->
    <div class="form-container">
        <h2>{{ isset($student) ? 'Edit' : 'Add New' }} Student</h2>
        <form action="{{ isset($student) ? route('update', $student->id) : route('store') }}" method="POST">
            @csrf
            @if(isset($student))
                @method('PUT')
            @endif

            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" value="{{ old('name', $student->name ?? '') }}" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="{{ old('email', $student->email ?? '') }}" required>
            </div>

            <div class="form-group">
                <label>Age:</label>
                <input type="number" name="age" value="{{ old('age', $student->age ?? '') }}" required>
            </div>

            <button type="submit">{{ isset($student) ? 'Update' : 'Save' }}</button>

            @if(isset($student))
                <a href="{{ route('index') }}" class="btn-secondary">Cancel Edit</a>
            @endif
        </form>
    </div>

    <!-- Student Table -->
    <h3>All Students</h3>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->age }}</td>
                        <td>
                            <div class="action-buttons">
                                <!-- Edit Link -->
                                <a href="{{ route('edit', $student->id) }}" class="btn-edit">Edit</a>

                                <!-- Delete Button -->
                                <form action="{{ route('destroy', $student->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
