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

                                    <form class="row g-3" method="POST" action="{{ route('admin.users.store') }}">
                                        @csrf

                                        <div class="col-md-6">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror" required>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Assign Role</label>
                                            <select name="role" class="form-select @error('role') is-invalid @enderror"
                                                required>
                                                <option value="" disabled selected>Select role</option>
                                                @foreach ($roles as $key => $role)
                                                    <option value="{{ $key }}"
                                                        {{ old('role') == $key ? 'selected' : '' }}>
                                                        {{ ucfirst($role) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 yes-belong other-belong">
                                            <label for="belong" class="form-label">
                                                <b>District</b> / ज़िला
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="district_id" id="district_id" required class="form-control">
                                                <option value="">Select District/ ज़िला चुने</option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->district_code }}">
                                                        {{ $district->dist_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 yes-belong other-belong">
                                            <label for="tehsilDropdown" class="form-label"><b>Tehsil</b> / तहसील <span
                                                    class="text-danger">*</span></label>
                                            <select name="tehsil_id" id="tehsilDropdown" class="form-control" required>
                                                <option value="">पहले ज़िला चुने / First select District</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 yes-belong other-belong">
                                            <label for="block" class="form-label"><b>Block</b> / ब्लॉक <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" name="block_id" id="blockDropdown" required>
                                                <option value="">पहले तहसील चुने / First select Tehsil</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit">Create User</button>
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
