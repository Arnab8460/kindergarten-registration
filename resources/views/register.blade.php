<!DOCTYPE html>
<html>
<head>
    <title>Kindergarten Registration</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Add some basic styling */
    </style>
</head>
<body>

<h2>Register Child</h2>

@if(session('success'))
    <div style="color:green;">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('child.register') }}" method="POST" enctype="multipart/form-data" id="registrationForm">
    @csrf
    <h3>Child Details</h3>

    <label>Child Name:</label>
    <input type="text" name="name" required><br>

    <label>Date of Birth:</label>
    <input type="date" name="dob" required><br>

    <label>Class:</label>
    <select name="class" required>
        @for($i = 1; $i <= 12; $i++)
            <option value="Class {{ $i }}">Class {{ $i }}</option>
        @endfor
    </select><br>

    <label>Address:</label>
    <textarea name="address" required></textarea><br>

    <label>City:</label>
    <input type="text" name="city" required><br>

    <label>Country:</label>
    <select id="country" name="country" required onchange="loadStates()">
        <option value="India">India</option>
        <!-- Add more countries -->
    </select><br>

    <label>State:</label>
    <select id="state" name="state" required>
        <!-- populated by JS -->
    </select><br>

    <label>Zip Code:</label>
    <input type="text" name="zip_code" maxlength="7" required pattern="\d{7}"><br>

    <label>Child Photo:</label>
    <input type="file" name="photo" accept="image/jpeg,image/jpg,image/png" required><br>

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
    <button type="button" onclick="addPickupPerson()">Add More</button><br><br>

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
        addPickupPerson(); // Minimum 1 row
    };
</script>

</body>
</html>
