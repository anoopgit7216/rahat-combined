@extends('lekhpal.deathSection.layouts.death_app')

@section('title', 'Rahat Combined Death Dashboard')

@section('content')

    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container my-sm-5 my-lg-0 ">
                <div class="designforform shadow-sm mt-3">
                    <h2 class=" text-center">
                        <b>मृत्यु रिपोर्टिंग फॉर्म</b><br />
                        <small class="text-muted">Death Reporting Form</small>
                    </h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h3 class="text-center mb-4">राहत आयुक्त कार्यालय के लिए मृत्यु की रिपोर्ट करने हेतु फॉर्म भरें
                    </h3>
                    <form action="{{route('lekhpal.deathform.store')}}" method="POST" class="custom-form needs-validation"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="card mb-4 custom-form-card">
                            <div class="card-header ">
                                <h4><b>Basic Information / मूलभूत जानकारी</b></h4>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="area" class="form-label">
                                            <b>Area of Lekhpal</b> / लेखपाल क्षेत्र <span class="text-danger">*</span>
                                        </label>

                                        <select id="" class="form-control" name="area_type" required>
                                            <option value="">Select Lekhpal Area</option>
                                            <option value="Rural">ग्रामीण</option>
                                            <option value="Urban">शहरी</option>

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="deceasedName" class="form-label">
                                            <b>Name of Deceased</b> / मृतक का नाम <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter deceased name" name="name" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="fatherName" class="form-label">
                                            <b>Father/Husband’s Name</b>/ मृतक के पिता/पति का नाम <span
                                                class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="guardian_name"
                                            placeholder="Enter father or husband name" name="guardian_name" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <b>Gender</b> / लिंग चुने <span class="text-danger">*</span>
                                        </label>

                                        <select id="" class="form-control" name="gender" required>
                                            <option value="">Select Gender/ लिंग चुने</option>
                                            <option value="Male">Male / पुरुष</option>
                                            <option value="Female">Female/ महिला</option>
                                            <option value="Other">Other / अन्य</option>

                                        </select>
                                        <div>


                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="dateOfDeath" class="form-label">
                                            <b>Date of Death</b> / मृत्यु की तिथि <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" class="form-control" id="dateOfDeath" required
                                            name="death_date" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="timeOfDeath" class="form-label">
                                            <b>Time of Death</b> / मृत्यु का समय
                                        </label>
                                        <input type="time" class="form-control" id="timeOfDeath" name="death_time"
                                            required />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="age" class="form-label">
                                            <b>Age</b> / आयु <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" class="form-control" id="age" placeholder="Enter age"
                                            required name="age" />
                                    </div>
                                    <div class="card-header">
                                        <h4><b>Death Details / मृत्यु का विवरण</b></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="causeOfDeath" class="form-label">
                                            <b>Cause of Death</b> / मृत्यु का कारण <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select" id="causeOfDeath" required name="cause_of_death">
                                            <option value="">Select cause of death</option>
                                            <option value="Flood">Flood/बाढ़</option>
                                            <option value="Accident">Accident/दुर्घटना</option>
                                            <option value="Fire">Fire/आग</option>
                                            <option value="Earthquake">Earthquake/भूकंप</option>
                                            <option value="Other">Other/अन्य</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="disasterType" class="form-label">
                                            <b>Type of Disaster</b> / आपदा का प्रकार <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select" id="disasterType" name="disaster_type" required>
                                            <option value="">Select disaster type</option>
                                            <option value="Natural">Natural/प्राकृतिक</option>
                                            <option value="Man-made">Man-made/मानव निर्मित</option>

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="dateOfDisaster" class="form-label">
                                            <b>Date of Disaster</b> / आपदा की तिथि <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" class="form-control" id="dateOfDisaster" required
                                            name="disaster_date" />
                                    </div>

                                    <div class="card-header">
                                        <h4><b>Address Details / पता विवरण</b></h4>
                                    </div>

                                    <div class="col-16">
                                        <label class="form-label">
                                            <b>Is the resident of Uttar Pradesh? <span class="text-danger">*</span></b> /
                                            क्या उत्तर प्रदेश का निवासी है? <span class="text-danger">*</span>
                                        </label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="resident"
                                                    id="resYes" value="Yes" required />
                                                <label class="form-check-label" for="resYes"><b>Yes</b> / हाँ</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="resident"
                                                    id="resNo" value="No" />
                                                <label class="form-check-label" for="resNo"><b>No</b> / नहीं</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="resident"
                                                    id="resother" value="Other" />
                                                <label class="form-check-label" for="resother"><b>Other Districts</b> /
                                                    अन्य
                                                    जनपद</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- All fields below should show/hide based on selection -->
                                    <div class="col-md-6" id="state-field">
                                        <label class="form-label"><b>Select State</b> / राज्य चुने <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="state">
                                            <option value="">चयन करे</option>
                                            <option value="1">Uttar Pradesh</option>
                                            <option value="2">Andaman</option>
                                            <option value="3">Delhi</option>
                                            <option value="4">Bihar</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 yes-belong other-belong">
                                        <label for="belong" class="form-label">
                                            <b>District</b> / ज़िला
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="dead_person_district" id="dead_person_district" required
                                            class="form-control">
                                            <option value="">Select District/ ज़िला चुने</option>
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->district_code }}">{{ $district->dist_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 yes-belong other-belong">
                                        <label for="tehsilDropdown" class="form-label"><b>Tehsil</b> / तहसील <span
                                                class="text-danger">*</span></label>
                                        <select name="dead_person_tehsil" id="tehsilDropdown" class="form-control"
                                            required>
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
                                    <div class="col-md-6">
                                        <label for="pin_code" class="form-label">
                                            <b>Pin Code</b> / पिन कोड  <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" class="form-control" id="pin_code" required
                                            name="pin_code" />
                                    </div>
                                    <div class="col-12">
                                        <label for="address" class="form-label">
                                            <b>Address</b> / पता<span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control" rows="3" name="address" required placeholder="Enter complete address"
                                            style="max-height: 300px;"></textarea>

                                    </div>
                                    <div class="card-header">
                                        <h4><b>Document Uploads/दस्तावेज़ अपलोड</b></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="photo1" class="form-label">
                                            <b>Upload photo of the deceased</b>/मृतक का फोटो अपलोड करें <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="btn btn-light w-100 d-flex align-items-center justify-content-center gap-2 p-4 dropbox-btn"
                                            onclick="document.getElementById('photo1').click();">
                                            <i class="fab fa-dropbox fa-lg"></i> Click to upload Photo
                                        </div>
                                        <input class="form-control d-none" type="file" id="photo1"
                                            name="dead_person_pic" accept="image/*,.pdf">
                                        <div id="preview1" class="mt-2"></div>
                                    </div>



                                </div>
                            </div>
                        </div>
                        <!-- Submit -->
                        <div class="text-end ">
                            <button type="reset" class="btn btn-lg  me-4" style="border: 1px solid gray;">
                                Cancel/ रद्द करें
                            </button>
                            <button type="submit" class="btn btn-lg btn-primary mt-3 mt-md-0">
                                Save and
                                Continue/ सहेजें और जारी रखें
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function toggleFields() {
                var selected = $("input[name='resident']:checked").val();

                if (selected === "Yes") {
                    $(".yes-belong").show().find("select, input").attr("required", true);
                    $("#state-field").hide().find("select, input").removeAttr("required");
                } else if (selected === "No") {
                    $(".yes-belong").show().find("select, input").attr("required", true);
                    $("#state-field").show().find("select, input").attr("required", true);
                } else if (selected === "Other") {
                    $(".yes-belong").show().find("select, input").attr("required", true);
                    $("#state-field").hide().find("select, input").removeAttr("required");
                } else {
                    $(".yes-belong").hide().find("select, input").removeAttr("required");
                    $("#state-field").hide().find("select, input").removeAttr("required");
                }
            }

            toggleFields();

            $("input[name='resident']").on("change", toggleFields);
        });
    </script>
    <script>
        // Bootstrap 5 custom validation
        (function() {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })();
    </script>

    <script>
        function showPreview(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            const file = input.files[0];
            preview.innerHTML = ""; // Clear previous

            if (file) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.style.maxWidth = "100px";
                        img.style.maxHeight = "100px";
                        img.classList.add("img-thumbnail", "me-2", "mt-2");
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                } else if (file.type === "application/pdf") {
                    const nameTag = document.createElement("div");
                    nameTag.textContent = "Selected PDF: " + file.name;
                    nameTag.classList.add("mt-2", "text-muted");
                    preview.appendChild(nameTag);
                } else {
                    preview.textContent = "Unsupported file format";
                }
            }
        }

        document.getElementById("photo1").addEventListener("change", function() {
            showPreview("photo1", "preview1");
        });
        document.getElementById("photo2").addEventListener("change", function() {
            showPreview("photo2", "preview2");
        });
        document.getElementById("photo3").addEventListener("change", function() {
            showPreview("photo3", "preview3");
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#dead_person_district').on('change', function() {
                let districtCode = $(this).val();
                $('#tehsilDropdown').html(
                    '<option value="">पहले ज़िला चुने / First select District</option>');

                if (districtCode) {
                    $.ajax({
                        url: '{{ url('/get-tehsils') }}/' + districtCode,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            let $tehsil = $('#tehsilDropdown');
                            $tehsil.empty().append(
                                '<option value="">Select Tehsil/ तहसील चुने</option>');

                            $.each(data, function(index, tehsil) {
                                $tehsil.append('<option value="' + tehsil.tehsil_code +
                                    '">' +
                                    tehsil.tehsil_name + '</option>');
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
