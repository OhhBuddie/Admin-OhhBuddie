@extends('layouts.app')

@section('content')
<style>
    .form-container {
        max-width: 900px;
        margin: 30px auto;
        padding: 30px;
        background: #fdfdfd;
        border-radius: 15px;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.07);
        font-family: 'Segoe UI', sans-serif;
    }

    .form-container h2 {
        margin-bottom: 25px;
        color: #333;
        font-size: 24px;
        border-left: 5px solid #0d6efd;
        padding-left: 15px;
    }

    .form-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        flex: 1 1 45%;
        display: flex;
        flex-direction: column;
    }

    label {
        font-weight: 600;
        margin-bottom: 5px;
        color: #444;
    }

    input[type="text"],
    input[type="email"],
    input[type="date"],
    select {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
    }

    .form-actions {
        text-align: center;
        margin-top: 30px;
    }

    button[type="submit"] {
        padding: 12px 30px;
        background: #198754;
        border: none;
        color: white;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s;
    }

    button[type="submit"]:hover {
        background: #157347;
    }

    .text-danger {
        color: #dc3545;
        font-size: 13px;
        margin-top: 4px;
    }

    @media (max-width: 768px) {
        .form-group {
            flex: 1 1 100%;
        }
    }
</style>

<div class="form-container">
    <h2>Add New Employee</h2>
<form id="employeeForm" action="{{ route('employees.store') }}" method="POST">
        @csrf
        <input type="hidden" id="emp_id_hidden" name="id">

        <div class="form-row">
            <div class="form-group">
                <label>Employee ID</label>
                <input type="text" name="emp_id" required>
            </div>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" required>
                <div class="text-danger" id="phoneError"></div>
            </div>
            <div class="form-group">
                <label>Email (must end with @ohhbuddie.com)</label>
                <input type="email" name="email" required value="@ohhbuddie.com">
                <div class="text-danger" id="emailError"></div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" required>
            </div>
            <div class="form-group">
                <label>Date of Joining</label>
                <input type="date" name="doj" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" name="dob" required>
            </div>
            <div class="form-group">
                <label>Designation</label>
                <input type="text" name="designation" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Department</label>
                <input type="text" name="department" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <input type="text" name="role" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Employee Type</label>
                <select name="emp_type" required>
                    <option disabled selected>Select Type</option>
                    <option>Full time</option>
                    <option>Part time</option>
                    <option>Intern</option>
                    <option>Contract</option>
                </select>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option disabled selected>Select Status</option>
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit">Save Employee</button>
        </div>
    </form>
</div>
@endsection