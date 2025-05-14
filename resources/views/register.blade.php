<!DOCTYPE html>
<html>
<head>
    <title>Kindergarten Registration</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f6fc;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            background: #fff;
            padding: 20px;
            max-width: 800px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #4A90E2;
            border-bottom: 2px solid #4A90E2;
            padding-bottom: 5px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="file"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: vertical;
        }

        button[type="submit"],
        button[type="button"] {
            background-color: #4A90E2;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
        }

        button[type="button"]:hover,
        button[type="submit"]:hover {
            background-color: #357ABD;
        }

        table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #f5f5f5;
        }

        .success-message {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
        }
        .login-button {
        background-color: #4A90E2;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        float: right;
        margin-bottom: 20px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

.login-button:hover {
    background-color: #357ABD;
}

    </style>
</head>
<body>
<a href="{{ url('school-login') }}" class="login-button">Login</a>
<h2>Register Child</h2>

@if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('child.register') }}" method="POST" enctype="multipart/form-data" id="registrationForm">
    @csrf

    <h3>Child Details</h3>

    <label>Child Name:</label>
    <input type="text" name="name" required>

    <label>Date of Birth:</label>
    <input type="date" name="dob" required>

    <label>Class:</label>
    <select name="class" required>
        @for($i = 1; $i <= 12; $i++)
            <option value="Class {{ $i }}">Class {{ $i }}</option>
        @endfor
    </select>

    <label>Address:</label>
    <textarea name="address" required></textarea>

    <label>City:</label>
    <input type="text" name="city" required>

    <label>Country:</label>
    <select id="country" name="country" required onchange="loadStates()">
        <option value="India">India</option>
    </select>

    <label>State:</label>
    <select id="state" name="state" required></select>

    <label>Zip Code:</label>
    <input type="text" name="zip_code" maxlength="7" required pattern="\d{7}">

    <label>Child Photo:</label>
    <input type="file" name="photo" accept="image/jpeg,image/jpg,image/png" required>

    <hr>

    <h3>Pickup Person Details</h3>
    <table id="pickup-person-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Relation</th>
                <th>Contact No</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="pickup-person-body">
        </tbody>
    </table>
    <button type="button" onclick="addPickupPerson()">Add More</button>

    <br><br>
    <button type="submit">Submit</button>
</form>

@if(session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
@endif

<script>
    let maxPickupPersons = 6;

    function addPickupPerson() {
        let tbody = document.getElementById('pickup-person-body');
        if (tbody.rows.length >= maxPickupPersons) {
            alert('Maximum 6 persons can be added.');
            return;
        }

        let row = tbody.insertRow();
        row.innerHTML = `
            <td><input type="text" name="pickup_name[]" required></td>
            <td>
                <select name="pickup_relation[]" required>
                    <option value="Father">Father</option>
                    <option value="Mother">Mother</option>
                    <option value="Brother">Brother</option>
                    <option value="Sister">Sister</option>
                    <option value="Grand Father">Grand Father</option>
                    <option value="Grand Mother">Grand Mother</option>
                </select>
            </td>
            <td><input type="text" name="pickup_contact[]" pattern="\\d{10}" required></td>
            <td><button type="button" onclick="this.parentElement.parentElement.remove()">Remove</button></td>
        `;
    }

    function loadStates() {
        let country = document.getElementById('country').value;
        let stateDropdown = document.getElementById('state');
        stateDropdown.innerHTML = '';

        if (country === 'India') {
            let states = ['West Bengal', 'Maharashtra', 'Karnataka', 'Tamil Nadu'];
            states.forEach(function(state) {
                let opt = document.createElement('option');
                opt.value = state;
                opt.innerHTML = state;
                stateDropdown.appendChild(opt);
            });
        }
    }

    window.onload = function() {
        loadStates();
        addPickupPerson(); // Add one by default
    };
</script>

</body>
</html>
