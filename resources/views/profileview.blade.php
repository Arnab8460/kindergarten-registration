<!DOCTYPE html>
<html>
<head>
    <title>Registered Children</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f8fa;
            padding: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .edit-btn {
            background-color: #4CAF50;
            color: white;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }

        .add-btn {
            background-color: #3498db;
            color: white;
            margin-bottom: 20px;
            display: inline-block;
        }
       .button-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .logout-btn {
        background-color: #e67e22;
        color: white;
        font-size: 16px;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        transition: background-color 0.3s ease, transform 0.2s;
    }

    .logout-btn:hover {
        background-color: #d35400;
        transform: scale(1.05);
    }

    </style>
</head>
<body>

<h2>Registered Children</h2>

<div class="button-bar">
    <a href="{{ url('create') }}" class="btn add-btn">+ Add New Child</a>

    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn logout-btn">Logout</button>
    </form>
</div>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>id</th>
            <th>Child Name</th>
            <th>DOB</th>
            <th>Class</th>
            <th>City</th>
            <th>Photo</th>
            <th>Pickup person</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($childprofile as $index => $child)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $child->name }}</td>
                <td>{{ $child->dob }}</td>
                <td>{{ $child->class }}</td>
                <td>{{ $child->city }}</td>
                <td>
                    @if($child->photo)
                        <img src="{{ asset('storage/'.$child->photo) }}" width="60" height="60" style="border-radius: 6px;">
                    @else
                        N/A
                    @endif
                </td>
                <td>--</td>
                <td>
                    <a href="#" class="btn edit-btn">Edit</a>

                    <form action="#" method="POST" style="display:inline;" 
                          onsubmit="return confirm('Are you sure you want to delete this child?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align:center;">No records found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
