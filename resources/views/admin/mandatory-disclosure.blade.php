@extends('admin/layouts/app')
@section('admin-title', 'Mandatory Disclosure – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Manage mandatory disclosure documents and information')
@section('admin-keywords', 'mandatory disclosure, documents, admin, compliance')
@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Mandatory Disclosure</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('md.edit') }}">Edit Mandatory Disclosure</a>
                            </li>
                            <li class="breadcrumb-item"><a target="_blank" href="#">View MD on
                                    Website</a>
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
                                <a class="btn btn-primary" href="{{ route('md.edit') }}">Edit</a>
                            </div>
                            <div class="card-body table-responsive p-0">

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
                                                {{ $mandatory_disclosure->name_of_school }}
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
                                                {{ $mandatory_disclosure->affiliation }}
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
                                                {{ $mandatory_disclosure->school_code }}
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
                                                {{ $mandatory_disclosure->address }}
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
                                                {{ $mandatory_disclosure->principal }}
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

                                                {{ $mandatory_disclosure->school_email }}
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
                                                {{ $mandatory_disclosure->school_contact }}
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
                                            <th class="text-uppercase" width="30%"> Uploaded Documents </th>
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
                                                <a class="btn btn-primary" target="_blank"
                                                    href="{{ Storage::url($mandatory_disclosure->doc_affiliation) }}">View/Download</a>
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
                                                <a class="btn btn-primary" target="_blank"
                                                    href="{{ Storage::url($mandatory_disclosure->doc_trust) }}">View/Download</a>
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
                                                <a class="btn btn-primary" target="_blank"
                                                    href="{{ Storage::url($mandatory_disclosure->doc_noc) }}">View/Download</a>
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
                                                <a class="btn btn-primary" target="_blank"
                                                    href="{{ Storage::url($mandatory_disclosure->doc_rte) }}">View/Download</a>
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
                                                <a class="btn btn-primary" target="_blank"
                                                    href="{{ Storage::url($mandatory_disclosure->doc_building_safety) }}">View/Download</a>
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
                                                <a class="btn btn-primary" target="_blank"
                                                    href="{{ Storage::url($mandatory_disclosure->doc_fire_safety) }}">View/Download</a>
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
                                                <a class="btn btn-primary" target="_blank"
                                                    href="{{ Storage::url($mandatory_disclosure->doc_deo_cerificate) }}">View/Download</a>
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
                                                <a class="btn btn-primary" target="_blank"
                                                    href="{{ Storage::url($mandatory_disclosure->doc_water_health_sanitation) }}">View/Download</a>
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
                                                <a class="btn btn-primary" target="_blank"
                                                    href="{{ Storage::url($mandatory_disclosure->land_certificate) }}">View/Download</a>
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
                                                <a class="btn btn-primary" target="_blank"
                                                    href="{{ Storage::url($mandatory_disclosure->cbse_saras) }}">View/Download</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                {{-- Third Table --}}
                                <table class="table table-hover table-striped text-uppercase">
                                    <thead class="table-info">
                                        <tr>
                                            <th class="text-uppercase" width="10%">#</th>
                                            <th class="text-uppercase" width="60%"> Documents/Information </th>
                                            <th class="text-uppercase" width="30%"> Uploaded Documents </th>
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
                                                <a class="btn btn-primary" target="_blank"
                                                    href="{{ Storage::url($mandatory_disclosure->fee_structure) }}">View/Download</a>
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
                                                <a class="btn btn-primary" target="_blank"
                                                    href="{{ Storage::url($mandatory_disclosure->academic_calendar) }}">View/Download</a>
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
                                                <a class="btn btn-primary" target="_blank"
                                                    href="{{ Storage::url($mandatory_disclosure->smc) }}">View/Download</a>
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
                                                <a class="btn btn-primary" target="_blank"
                                                    href="{{ Storage::url($mandatory_disclosure->pta) }}">View/Download</a>
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
                                                <a class="btn btn-primary" target="_blank"
                                                    href="{{ Storage::url($mandatory_disclosure->board_result) }}">View/Download</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-hover table-striped text-uppercase">
                                    <thead class="table-info">
                                        <tr>
                                            <th class="text-uppercase" width="10%">#</th>
                                            <th class="text-uppercase" width="60">INFORMATION</th>
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
                                                {{ $mandatory_disclosure->total_teachers }}
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
                                                {{ $mandatory_disclosure->pgt }}
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
                                                {{ $mandatory_disclosure->tgt }}

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
                                                {{ $mandatory_disclosure->prt }}
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
                                                {{ $mandatory_disclosure->teacher_section_ratio }}
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
                                                {{ $mandatory_disclosure->special_education }}
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
                                                {{ $mandatory_disclosure->counsellor_wellness }}
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
                                                {{ $mandatory_disclosure->campus_area }}
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
                                                {{ $mandatory_disclosure->class_rooms }}
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
                                                {{ $mandatory_disclosure->laboratories }}
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
                                                {{ $mandatory_disclosure->internet }}
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
                                                {{ $mandatory_disclosure->girls_toilets }}
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
                                                {{ $mandatory_disclosure->boys_toilets }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                7
                                            </td>
                                            <td>
                                                Link of youtube video of
                                                the inspection of school <br>covering the infrastructure of the
                                                school
                                            </td>
                                            <td>
                                                {{ $mandatory_disclosure->inspection_video }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
