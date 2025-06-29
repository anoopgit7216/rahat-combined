@extends('layouts.admin_app')

@section('title', 'Rahat Combined Dashboard')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid my-4">
                <div class="container my-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-header">
                                    <h5 class="card-title mb-0">Create User</h5>
                                </div>

                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif

                                    <form class="row g-3" method="POST"
                                        action="{{ route('admin.users.update', $user->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="col-md-6">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $user->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Password (Leave blank to keep current)</label>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Assign Role</label>
                                            <select name="role" class="form-select @error('role') is-invalid @enderror"
                                                required>
                                                <option value="" disabled selected>Select role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ old('role', $user->role_id) == $role->id ? 'selected' : '' }}>
                                                        {{ ucfirst($role->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @error('role')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Bind district, tehsil, block -->
                                        <div class="col-md-6">
                                            <label for="district_id" class="form-label">District / ज़िला</label>
                                            <select name="district_id" id="district_id" class="form-select" required>
                                                <option value="">Select District</option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->district_code }}"
                                                        {{ old('district_id', $user->district_id) == $district->district_code ? 'selected' : '' }}>
                                                        {{ $district->dist_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="tehsil_id" class="form-label">Tehsil / तहसील</label>
                                            <select name="tehsil_id" id="tehsilDropdown" class="form-select" required>
                                                @if ($tehsils ?? false)
                                                    @foreach ($tehsils as $tehsil)
                                                        <option value="{{ $tehsil->tehsil_code }}"
                                                            {{ old('tehsil_id', $user->tehsil_id) == $tehsil->tehsil_code ? 'selected' : '' }}>
                                                            {{ $tehsil->tehsil_name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="">Select District first</option>
                                                @endif
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="block_id" class="form-label">Block / ब्लॉक</label>
                                            <select name="block_id" id="blockDropdown" class="form-select" required>
                                                @if ($blocks ?? false)
                                                    @foreach ($blocks as $block)
                                                        <option value="{{ $block->id }}"
                                                            {{ old('block_id', $user->block_id) == $block->id ? 'selected' : '' }}>
                                                            {{ $block->block_name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="">Select Tehsil first</option>
                                                @endif
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-success" type="submit">Update User</button>
                                        </div>
                                    </form>

                                </div> <!-- card-body -->

                            </div> <!-- card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#district_id').on('change', function() {
                let districtCode = $(this).val();
                $('#tehsilDropdown').html(
                    '<option value="">पहले ज़िला चुने / First select District</option>'
                );

                if (districtCode) {
                    $.ajax({
                        url: '{{ url('/get-tehsils') }}/' + districtCode,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            let $tehsil = $('#tehsilDropdown');
                            $tehsil.empty().append(
                                '<option value="">Select Tehsil/ तहसील चुने</option>'
                            );

                            $.each(data, function(index, tehsil) {
                                $tehsil.append(
                                    '<option value="' + tehsil.tehsil_code + '">' +
                                    tehsil.tehsil_name + '</option>'
                                );
                            });
                        },
                        error: function() {
                            alert('Tehsil data could not be loaded.');
                        }
                    });
                } else {
                    $('#tehsilDropdown').html('<option value="">Select Tehsil/ तहसील चुने</option>');
                }
            });
        });


        $('#tehsilDropdown').on('change', function() {
            let tehsilCode = $(this).val();
            $('#blockDropdown').html('<option value="">पहले तहसील चुने / First select Tehsil</option>');

            if (tehsilCode) {
                $.ajax({
                    url: '{{ url('/get-blocks') }}/' + tehsilCode,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        let $block = $('#blockDropdown');
                        $block.empty().append('<option value="">चयन करे</option>');

                        $.each(data, function(index, block) {
                            $block.append('<option value="' + block.id + '">' + block
                                .block_name + '</option>');
                        });
                    },
                    error: function() {
                        alert('Block data could not be loaded.');
                    }
                });
            } else {
                $('#blockDropdown').html('<option value="">चयन करे</option>');
            }
        });
    </script>

@endsection
