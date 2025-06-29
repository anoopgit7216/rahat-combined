@extends('lekhpal.deathSection.layouts.death_app')

@section('title', 'Rahat Combined Death Dashboard')

@section('content')

<style>
    .form-section {
        background-color: #fff;
        border: 1px solid #ddd;
        padding: 30px;
        border-radius: 10px;
        margin-top: 30px;
    }

    .form-header {
        padding-left: 0px !important;
        padding: 10px 15px;
        font-weight: bold;
        font-size: 25px;
    }

    .form-header span {
        font-size: 25px;
    }

    .required::after {
        content: "*";
    }

    .note {
        font-size: 0.9rem;
    }

    .btn-group-top {
        display: flex;
        justify-content: end;
        gap: 10px;
        margin-bottom: 15px;
    }

    .eng {
        font-weight: 600;
    }
</style>
<?php /* echo '<pre>';
    print_r($deadperson);
    die('==f='); */
    ?>
<div class="content-page">
    <div class="container">
        <div class="form-section">
            <div class="btn-group-top">
                <a href="{{ route('lekhpal.death.form') }}" class="btn btn-danger"><span class="eng">Go Back</span> /
                    वापस जाएं</a>
            </div>

            <div class="form-header mb-0 pb-0 mt-3"><span class="eng">Fill in Beneficiary Details for Disaster Relief
                    Grant</span> / क्षति अनुदान के साक्ष्य लाभार्थी का विवरण भरे</div>
            <hr>
            <form action="{{ route('lekhpal.death.form.benificiary.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row g-3 mt-2 ">
                    <input type="hidden" name="death_person_id" value="{{ $id }}">
                    <div class="col-md-6">
                        <label class="form-label required"><span class="eng">Select Type of Disaster</span> / आपदा का
                            प्रकार चुने</label>
                        <select class="form-select" name="disaster_t" required>
                            <option>--चयन करें--</option>
                            <option value="1">Flood (बाढ़)</option>
                            <option value="2">Drought (सूखा)</option>
                            <option value="3">Fire (अग्निकांड)</option>
                            <option value="4">Hailstorm (ओलावृष्टि)</option>
                            <option value="5">Earthquake / Tsunami (भूकंप/सुनामी)</option>
                            <option value="6">Cloud Burst (बादल फटना)</option>
                            <option value="7">Cold wave / Frost (कोल्ड वेव एवं शीतलहर)</option>
                            <option value="8">Cyclone (चक्रवात)</option>
                            <option value="9">Landslide (भूस्खलन)</option>
                            <option value="10">Pest Attack (कीट-आक्रमण)</option>
                            <option value="11">Unseasonal Rainfall / Heavy Rain (बेमौसम भारी वर्षा / अतिवृष्टि)
                            </option>
                            <option value="12">Lightening (आकाशीय बिजली)</option>
                            <option value="13">Thunderstorm (आंधी-तूफान)</option>
                            <option value="14">Heatwave (लू-प्रकोप)</option>
                            <option value="15">Boat Capsize (नाव दुर्घटना)</option>
                            <option value="16">Snake Bite (सर्पदंश)</option>
                            <option value="17">Sewer Cleaning/ Gas leakage (सीवर सफाई / गैस रिसाव)</option>
                            <option value="18">Dropping in Bore well (बोरवेल में गिरना)</option>
                            <option value="19">Man Animal Conflict (मानव वन्य जीव द्वंद्व)</option>
                            <option value="20">Death due to Drowning (डूबकर होने वाली मृत्यु)</option>
                            <option value="21">Hit by Bull & Neelgai (सांड एवं नीलगाय से घटना)</option>
                            <option value="22">Covid-19 (50 Lakhs) (कोविड-19 (50 लाख))</option>
                            <option value="23">Covid-19 (50 Thousand) (कोविड-19 (50 हजार))</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required"><span class="eng">Select Type of Relief Grant</span> /
                            क्षति
                            अनुदान का प्रकार चुने</label>
                        {{-- <select class="form-select" name="relief_grant" required>
                            <option>-- चयन करें --</option>
                        </select> --}}
                        <select name="relief_grant" id="relief_grant" class="form-control form-select" required>
                            <option>चयन करें</option>
                            <option value="1">आपदा से मृत्यु</option>
                            <option value="2">मानव वन्य जीव द्वंद्व (जंगली जानवरों का हमला) से मृत्यु</option>
                            <option value="3">किसी अंग अथवा आँखों के बेकार हो जाने पर (अनुमानित 40% से 60% के बीच)
                            </option>
                            <option value="4">किसी अंग अथवा आँखों के बेकार हो जाने पर (अनुमानित 60% से अधिक)
                            </option>
                            <option value="5">गंभीर रूप से घायल व्यक्ति का उपचार (एक सप्ताह से अधिक अवधि के लिए)
                            </option>
                            <option value="6">गंभीर रूप से घायल व्यक्ति का उपचार (एक सप्ताह से कम अवधि के लिए)
                            </option>
                            <option value="7">वो परिवार जिनके कृषि भूमि से अधिक समय के लिए गंभीर रूप से जलमग्न हो
                                गये हैं, उनके लिए कपड़े और बर्तन/खाद्यान्न</option>
                            <option value="8">वे परिवार जो गांव में 72 घंटे के अंदर किसी व्यापक
                                आग/विस्फोट/आतंकवादी/सांप्रदायिक घटना से प्रभावित हुए हैं</option>
                        </select>

                    </div>
                    <div class="col-md-6">
                        <label for="reliefItem" class="form-label">
                            <b>Type of Relief Item</b> / राहत मद का प्रकार <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="relief_type" required
                            placeholder="Enter Relief Item Type">
                    </div>
                    <div class="col-md-6">
                        <label for="grantDetails" class="form-label">
                            <b>Type of Damage Grant</b> / क्षति अनुदान का प्रकार <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="grantDetails" required name="grants_type"
                            placeholder="Enter Damage Grant Type" />
                    </div>

                    <div class="col-12 note ">
                        <p><strong><span class="eng ">Note:</span> / नोट:</strong> आधार संख्या भरें या बिना आधार कार्ड
                            के आवेदन के लिए <a href="#">यहाँ क्लिक करें</a></p>
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" name="terms_condition" type="checkbox" id="consent">
                            <label class="form-check-label" for="consent">
                                <span class="eng">I agree to use Aadhaar details for verification</span> / मैं सहमत
                                हूँ
                                कि मेरा आधार विवरण सत्यापन हेतु प्रयुक्त हो।
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label required"><span class="eng">Aadhaar Card Number</span> / आधार कार्ड
                            संख्या</label>
                        <input type="text" name="aadhaar_no" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required"><span class="eng">Beneficiary Name</span> / लाभार्थी का
                            नाम</label>
                        <input type="text" name="beneficiary_name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required"><span class="eng">Gender</span> / लिंग</label>
                        <select class="form-select" name="gender" required>
                            <option>चयन करें</option>
                            <option value="male">पुरुष</option>
                            <option value="female">महिला</option>
                            <option value="other">अन्य</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label required"><span class="eng">Father/Husband Name</span> / पिता/पति का
                            नाम</label>
                        <input type="text" name="father_husb_name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required"><span class="eng">Age</span> / आयु</label>
                        <input type="number" name="age" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required"><span class="eng">Mobile Number</span> / मोबाइल
                            नंबर</label>
                        <input type="tel" name="mobile" class="form-control" required>
                    </div>

                    <div class="form-header mt-3 mb-0 pb-0"><span class="eng">Fill in Residential Details</span> /
                        लाभार्थी के गृह क्षेत्र का विवरण भरे</div>
                    <hr>
                    <div class="sub-sec col-12">
                        <label class="form-label required"><span class="eng">Is the resident of Uttar
                                Pradesh?</span>
                            /
                            क्या उत्तर प्रदेश का निवासी है?</label><br>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="residency" id="yes" value="yes" required>
                            <label class="form-check-label" for="yes"><span class="eng">Yes</span> / हाँ (UP
                                निवासी)</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="residency" value="no" id="no" required>
                            <label class="form-check-label" for="no"><span class="eng">No</span> /
                                नहीं</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label"><span class="eng">Address</span> / पता</label>
                        <textarea class="form-control" name="address" rows="2 " required></textarea>
                    </div>
                    <div class="form-header mt-3 mb-0 pb-0"><span class="eng">Document Uploads</span> /
                        दस्तावेज़ अपलोड</div>
                    <hr>
                    <div class="col-md-6">
                        <label for="photo2" class="form-label">
                            <b>Upload Panchnama report</b>/पंचनामा रिपोर्ट अपलोड करें <span class="text-danger">*</span>
                        </label>
                        <div class="btn btn-light w-100 d-flex align-items-center justify-content-center gap-2 p-4 dropbox-btn"
                            onclick="document.getElementById('photo2').click();">
                            <i class="fa-solid fa-file-lines fa-lg"></i> Click to upload Document
                        </div>
                        <input class="form-control d-none" type="file" id="photo2" name="panchnama_report"
                            accept="image/*,.pdf">
                        <div id="preview2" class="mt-2"></div>
                    </div>

                    <div class="col-md-6">
                        <label for="photo3" class="form-label">
                            <b>Upload post mortem report</b>/पोस्टमार्टम रिपोर्ट अपलोड करें <span
                                class="text-danger">*</span>
                        </label>
                        <div class="btn btn-light w-100 d-flex align-items-center justify-content-center gap-2 p-4 dropbox-btn"
                            onclick="document.getElementById('photo3').click();">
                            <i class="fa-solid fa-file-lines fa-lg"></i> Click to upload Document
                        </div>
                        <input class="form-control d-none" type="file" id="photo3" name="postmortem_report"
                            accept="image/*,.pdf">
                        <div id="preview3" class="mt-2"></div>
                    </div>

                    <div class="form-header mt-3 mb-0 pb-0"><span class="eng">Fill in Bank Account Details</span> /
                        लाभार्थी के बैंक खाते का विवरण भरे</div>
                    <hr>

                    <div class="col-md-6">
                        <label class="form-label required"><span class="eng">Enter District</span> / जनपद चयन
                            करें</label>
                        <input type="text" class="form-control" name="district" placeholder="Enter Your District"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required"><span class="eng">Bank Name</span> / बैंक का नाम</label>
                        <input type="text" class="form-control" name="bank_name" placeholder="Enter Your Bank Name"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required"><span class="eng">Branch</span> / शाखा</label>
                        <input type="text" class="form-control" name="branch" placeholder="Enter Your Branch Name"
                            required>
                    </div>


                    <div class="col-md-6">
                        <label class="form-label required"><span class="eng">Account Number</span> / खाता
                            संख्या</label>
                        <input type="text" name="account_number" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required"><span class="eng">Account Holder Name</span> / बैंक खाता
                            धारक
                            का नाम</label>
                        <input type="text" name="account_holder_name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required"><span class="eng">IFSC</span> / आईएफएससी</label>
                        <input type="text" name="ifsc" class="form-control" required>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label class="form-label"><span class="eng">Upload Bank Passbook</span> / बैंक पासबुक अपलोड
                            करें</label>
                        <input type="file" name="upload_bank_passbook" class="form-control" accept=".jpg" required>
                        <small class="text-danger d-none">FileType: .jpg only | File Size: Max 100 KB</small>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary"><span class="eng">Save</span> / सुरक्षित
                        करें</button>

                </div>
            </form>
        </div>
    </div>
</div>
<script>
        function showPreview(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            const file = input.files[0];
            preview.innerHTML = ""; // Clear previous

            if (file) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
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

        document.getElementById("photo2").addEventListener("change", function () {
            showPreview("photo2", "preview2");
        });
        document.getElementById("photo3").addEventListener("change", function () {
            showPreview("photo3", "preview3");
        });
    </script>


@endsection