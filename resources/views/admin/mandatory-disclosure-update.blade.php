@extends('admin/layouts/app')

@section('admin-title', 'Edit Mandatory Disclosure – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Edit mandatory disclosure documents')
@section('admin-keywords', 'mandatory disclosure, edit, documents, admin, compliance')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Mandatory Disclosure (Edit)</h1>
                        <span class="font-size:10px;">The mandatory disclosure file must be a file of type: pdf.</span>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('md.get') }}">Mandatory Disclosure</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content h-100">
            <div class="container-fluid h-100">
                @if (Session::has('success'))
                    <div id="session-alert" class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-right">
                                <!-- Move the submit button here -->
                                <button class="btn btn-primary"><a style="color:white; text-decoration:none"
                                        href="{{ route('md.get') }}">Back</a></button>
                                <button type="submit" form="submitForm" class="btn btn-primary">Save</button>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <form method="POST" id="submitForm" action="{{ route('md.update') }}"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    {{-- first table --}}
                                    <table class="table table-hover table-striped text-uppercase">
                                        <thead class="table-info">
                                            <tr>
                                                <th class="text-uppercase" width="10%">#</th>
                                                <th class="text-uppercase" width="60%">INFORMATION</th>
                                                <th class="text-uppercase" width="30%">Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    NAME OF SCHOOL
                                                </td>
                                                <td>
                                                    <input type="text" name="name_of_school"
                                                        value="{{ old('name_of_school', $mandatory_disclosure->name_of_school) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2
                                                </td>
                                                <td>
                                                    Affiliation Number
                                                </td>
                                                <td>
                                                    <input type="text" name="affiliation"
                                                        value="{{ old('affiliation', $mandatory_disclosure->affiliation) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3
                                                </td>
                                                <td>
                                                    School Code
                                                </td>
                                                <td>
                                                    <input type="text" name="school_code"
                                                        value="{{ old('school_code', $mandatory_disclosure->school_code) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    4
                                                </td>
                                                <td>
                                                    Complete Address with Pin
                                                    Code
                                                </td>
                                                <td>
                                                    <input type="text" name="address"
                                                        value="{{ old('address', $mandatory_disclosure->address) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    5
                                                </td>
                                                <td>
                                                    Principal Name &
                                                    Qualification
                                                </td>
                                                <td>
                                                    <input type="text" name="principal"
                                                        value="{{ old('principal', $mandatory_disclosure->principal) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    6
                                                </td>
                                                <td>
                                                    School Email ID
                                                </td>
                                                <td>
                                                    <input type="text" name="school_email"
                                                        value="{{ old('school_email', $mandatory_disclosure->school_email) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    7
                                                </td>
                                                <td>
                                                    Contact Details
                                                    (Landline/Mobile)
                                                </td>
                                                <td>
                                                    <input type="text" name="school_contact"
                                                        value="{{ old('school_contact', $mandatory_disclosure->school_contact) }}">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    {{-- Second Table --}}
                                    <table class="table table-hover table-striped text-uppercase">
                                        <thead class="table-info">
                                            <tr>
                                                <th class="text-uppercase" width="10%">#</th>
                                                <th class="text-uppercase" width="60%"> Documents/Information </th>
                                                <th class="text-uppercase" width="30%"> Uploaded Document </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    Copies of
                                                    affiliation/upgradation letter and recent extension <br>of
                                                    affiliation,
                                                    if any
                                                </td>
                                                <td>
                                                    <input type="file" name="doc_affiliation" accept=".pdf">
                                                    @error('doc_affiliation')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2
                                                </td>
                                                <td>
                                                    Copies of
                                                    societies/trust/company registration/renewal certificate,<br> as
                                                    applicable
                                                </td>
                                                <td>
                                                    <input type="file" name="doc_trust" accept=".pdf">
                                                    @error('doc_trust')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3
                                                </td>
                                                <td>
                                                    Copy of no objection
                                                    certificate (NOC) issues, if applicable by <br>the state
                                                    govt/UT
                                                </td>
                                                <td>
                                                    <input type="file" name="doc_noc" accept=".pdf">
                                                    @error('doc_noc')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    4
                                                </td>
                                                <td>
                                                    Copies of recognition
                                                    certificate <br> under RTE Act. 2009 and its renewal if
                                                    applicable
                                                </td>
                                                <td>
                                                    <input type="file" name="doc_rte" accept=".pdf">
                                                    @error('doc_rte')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    5
                                                </td>
                                                <td>
                                                    Copy of valid building
                                                    safety certificate <br> as per the national building code
                                                </td>
                                                <td>
                                                    <input type="file" name="doc_building_safety" accept=".pdf">
                                                    @error('doc_building_safety')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    6
                                                </td>
                                                <td>
                                                    Copy of valid fire
                                                    safety certificate issued <br> by the competent authority

                                                </td>
                                                <td>
                                                    <input type="file" name="doc_fire_safety" accept=".pdf">
                                                    @error('doc_fire_safety')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    7
                                                </td>
                                                <td>
                                                    Copy of the deo
                                                    certificate submitted by <br>the school for
                                                    affiliation/upgradation/extension <br>of affiliation or self
                                                    certification by school

                                                </td>
                                                <td>
                                                    <input type="file" name="doc_deo_cerificate" accept=".pdf">
                                                    @error('doc_deo_cerificate')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>

                                                    8

                                                </td>
                                                <td>
                                                    Copies of valid water,
                                                    health and sanitation certificates

                                                </td>
                                                <td>
                                                    <input type="file" name="doc_water_health_sanitation" accept=".pdf">
                                                    @error('doc_water_health_sanitation')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>

                                                    9

                                                </td>
                                                <td>
                                                    Land Certificate
                                                </td>
                                                <td>
                                                    <input type="file" name="land_certificate" accept=".pdf">
                                                    @error('land_certificate')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    10
                                                </td>
                                                <td>
                                                    SARAS 5.0
                                                </td>
                                                <td>
                                                    <input type="file" name="cbse_saras" accept=".pdf">
                                                    @error('cbse_saras')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    {{-- Third Table --}}
                                    <table class="table table-hover  table-striped text-uppercase">
                                        <thead class="table-info">
                                            <tr>
                                                <th class="text-uppercase" width="10%">#</th>
                                                <th class="text-uppercase" width="60%"> Documents/Information </th>
                                                <th class="text-uppercase" width="30%"> Upload Documents </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    Fee Structure of the
                                                    school
                                                </td>
                                                <td>
                                                    <input type="file" name="fee_structure" accept=".pdf">
                                                    @error('fee_structure')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2
                                                </td>
                                                <td>
                                                    Annual Academic
                                                    Calendar

                                                </td>
                                                <td>
                                                    <input type="file" name="academic_calendar" accept=".pdf">
                                                    @error('academic_calendar')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3
                                                </td>
                                                <td>
                                                    List of school
                                                    Management Committee (SMC)

                                                </td>
                                                <td>
                                                    <input type="file" name="smc" accept=".pdf">
                                                    @error('smc')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    4
                                                </td>
                                                <td>
                                                    List of parents teachers
                                                    association (PTA) members
                                                </td>
                                                <td>
                                                    <input type="file" name="pta" accept=".pdf">
                                                    @error('pta')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    5
                                                </td>
                                                <td>
                                                    Last three-year result
                                                    of the board examination as per applicability

                                                </td>
                                                <td>
                                                    <input type="file" name="board_result" accept=".pdf">
                                                    @error('board_result')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-hover table-striped text-uppercase">
                                        <thead class="table-info">
                                            <tr>
                                                <th class="text-uppercase" width="10%">#</th>
                                                <th class="text-uppercase" width="60%">INFORMATION</th>
                                                <th class="text-uppercase" width="30%">Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    Total no. of
                                                    teachers
                                                </td>
                                                <td>
                                                    <input type="text" name="total_teachers"
                                                        value="{{ old('total_teachers', $mandatory_disclosure->total_teachers) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    #
                                                </td>
                                                <td>
                                                    PGT

                                                </td>
                                                <td>
                                                    <input type="text" name="pgt"
                                                        value="{{ old('pgt', $mandatory_disclosure->pgt) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    #
                                                </td>
                                                <td>
                                                    TGT

                                                </td>
                                                <td>
                                                    <input type="text" name="tgt"
                                                        value="{{ old('tgt', $mandatory_disclosure->tgt) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    #
                                                </td>
                                                <td>
                                                    PRT
                                                </td>
                                                <td>
                                                    <input type="text" name="prt"
                                                        value="{{ old('prt', $mandatory_disclosure->prt) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3
                                                </td>
                                                <td>
                                                    Teachers section
                                                    ratio
                                                </td>
                                                <td>
                                                    <input type="text" name="teacher_section_ratio"
                                                        value="{{ old('teacher_section_ratio', $mandatory_disclosure->teacher_section_ratio) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    4
                                                </td>
                                                <td>
                                                    Details of special
                                                    educator
                                                </td>
                                                <td>
                                                    <input type="text" name="special_education"
                                                        value="{{ old('special_education', $mandatory_disclosure->special_education) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    5
                                                </td>
                                                <td>
                                                    Details of Cousellor and
                                                    Wellness Teacher

                                                </td>
                                                <td>
                                                    <input type="text" name="counsellor_wellness"
                                                        value="{{ old('counsellor_wellness', $mandatory_disclosure->counsellor_wellness) }}">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-hover table-striped text-uppercase">
                                        <thead class="table-info">
                                            <tr>
                                                <th class="text-uppercase" width="10%">#</th>
                                                <th class="text-uppercase" width="60%">INFORMATION</th>
                                                <th class="text-uppercase" width="30%">Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    Total campus area of the
                                                    school (in square mtr)

                                                </td>
                                                <td>
                                                    <input type="text" name="campus_area"
                                                        value="{{ old('campus_area', $mandatory_disclosure->campus_area) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2
                                                </td>
                                                <td>
                                                    No, and size of the
                                                    class rooms (in square mtr)

                                                </td>
                                                <td>
                                                    <input type="text" name="class_rooms"
                                                        value="{{ old('class_rooms', $mandatory_disclosure->class_rooms) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3
                                                </td>
                                                <td>
                                                    No. and size of
                                                    laboratories including computer labs (in square mtr)

                                                </td>
                                                <td>
                                                    <input type="text" name="laboratories"
                                                        value="{{ old('laboratories', $mandatory_disclosure->laboratories) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    4
                                                </td>
                                                <td>
                                                    Internet Facility
                                                    (Y/N)

                                                </td>
                                                <td>
                                                    <input type="text" name="internet"
                                                        value="{{ old('internet', $mandatory_disclosure->internet) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    5
                                                </td>
                                                <td>
                                                    No. of girls
                                                    toilets
                                                </td>
                                                <td>
                                                    <input type="text" name="girls_toilets"
                                                        value="{{ old('girls_toilets', $mandatory_disclosure->girls_toilets) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    6
                                                </td>
                                                <td>
                                                    No. of boys
                                                    toilets
                                                </td>
                                                <td>
                                                    <input type="text" name="boys_toilets"
                                                        value="{{ old('boys_toilets', $mandatory_disclosure->boys_toilets) }}">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>7</td>
                                                <td>
                                                    Link of youtube video of
                                                    the inspection of school <br>covering the infrastructure of the
                                                    school
                                                </td>
                                                <td>
                                                    <input type="text" name="inspection_video"
                                                        value="{{ old('inspection_video', $mandatory_disclosure->inspection_video) }}">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
