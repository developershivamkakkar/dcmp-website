@extends('layouts.app')
@section('title', 'Mandatory Disclosure � DBS')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/show.css') }}">
@endsection

@section('content')

    <!-- Floating WhatsApp Button -->
    <a href="https://api.whatsapp.com/send/?phone=9115992924&text=Hello%20Dass%20and%20Brown%20Experiential%20Learning%20School&type=phone_number&app_absent=0"
        class="whatsapp-button" target="_blank">
        <i class="fab fa-whatsapp"></i> Contact Us
    </a>

    

    {{-- Page Hero Banner --}}
    <div class="page-hero">
        <div class="page-hero-blob page-hero-blob-1"></div>
        <div class="page-hero-blob page-hero-blob-2"></div>
        <div class="page-hero-content">
            <h1 class="page-hero-title" data-aos="fade-up">Mandatory Disclosure</h1>
            <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="120">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home.get') }}"><i class="fas fa-home me-1"></i>Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mandatory Disclosure</li>
                </ol>
            </nav>
        </div>
        <div class="page-hero-wave">
            <svg viewBox="0 0 1440 56" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,28 C360,56 1080,0 1440,28 L1440,56 L0,56 Z" fill="#f4f6f9"/>
            </svg>
        </div>
    </div>

    <div class="container py-5" style="max-width:960px;">
        @foreach ($records as $record)

        {{-- -- Section 1: General Information -------------------------- --}}
        <div class="md-section-card" data-aos="fade-up">
            <div class="md-section-header">
                <i class="fas fa-school"></i> General Information
            </div>
            <div class="table-responsive">
                <table class="table md-table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="md-sno">#</th>
                            <th>Information</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="md-sno">1</td>
                            <td class="md-label">Name of School</td>
                            <td class="md-value">{{ $record->name_of_school }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">2</td>
                            <td class="md-label">Affiliation Number</td>
                            <td class="md-value">{{ $record->affiliation }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">3</td>
                            <td class="md-label">School Code</td>
                            <td class="md-value">{{ $record->school_code }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">4</td>
                            <td class="md-label">Complete Address with Pin Code</td>
                            <td class="md-value">{{ $record->address }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">5</td>
                            <td class="md-label">Principal Name &amp; Qualification</td>
                            <td class="md-value">{{ $record->principal }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">6</td>
                            <td class="md-label">School Email ID</td>
                            <td class="md-value">{{ $record->school_email }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">7</td>
                            <td class="md-label">Contact Details (Landline/Mobile)</td>
                            <td class="md-value">{{ $record->school_contact }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- -- Section 2: Legal & Compliance Documents ------------------ --}}
        <div class="md-section-card" data-aos="fade-up" data-aos-delay="50">
            <div class="md-section-header">
                <i class="fas fa-file-alt"></i> Legal &amp; Compliance Documents
            </div>
            <div class="table-responsive">
                <table class="table md-table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="md-sno">#</th>
                            <th>Document / Information</th>
                            <th style="width:140px;">Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="md-sno">1</td>
                            <td class="md-label">Copies of Affiliation/Upgradation Letter and Recent Extension of Affiliation, if any</td>
                            <td><a class="btn-md-doc" target="_blank" href="{{ Storage::url($record->doc_affiliation) }}"><i class="fas fa-download"></i> View/Download</a></td>
                        </tr>
                        <tr>
                            <td class="md-sno">2</td>
                            <td class="md-label">Copies of Societies/Trust/Company Registration/Renewal Certificate, as applicable</td>
                            <td><a class="btn-md-doc" target="_blank" href="{{ Storage::url($record->doc_trust) }}"><i class="fas fa-download"></i> View/Download</a></td>
                        </tr>
                        <tr>
                            <td class="md-sno">3</td>
                            <td class="md-label">Copy of No Objection Certificate (NOC) issued, if applicable by the State Govt/UT</td>
                            <td><a class="btn-md-doc" target="_blank" href="{{ Storage::url($record->doc_noc) }}"><i class="fas fa-download"></i> View/Download</a></td>
                        </tr>
                        <tr>
                            <td class="md-sno">4</td>
                            <td class="md-label">Copies of Recognition Certificate under RTE Act 2009 and its renewal if applicable</td>
                            <td><a class="btn-md-doc" target="_blank" href="{{ Storage::url($record->doc_rte) }}"><i class="fas fa-download"></i> View/Download</a></td>
                        </tr>
                        <tr>
                            <td class="md-sno">5</td>
                            <td class="md-label">Copy of Valid Building Safety Certificate as per the National Building Code</td>
                            <td><a class="btn-md-doc" target="_blank" href="{{ Storage::url($record->doc_building_safety) }}"><i class="fas fa-download"></i> View/Download</a></td>
                        </tr>
                        <tr>
                            <td class="md-sno">6</td>
                            <td class="md-label">Copy of Valid Fire Safety Certificate issued by the Competent Authority</td>
                            <td><a class="btn-md-doc" target="_blank" href="{{ Storage::url($record->doc_fire_safety) }}"><i class="fas fa-download"></i> View/Download</a></td>
                        </tr>
                        <tr>
                            <td class="md-sno">7</td>
                            <td class="md-label">Copy of DEO Certificate submitted by the School for Affiliation/Upgradation or Self Certification</td>
                            <td><a class="btn-md-doc" target="_blank" href="{{ Storage::url($record->doc_deo_cerificate) }}"><i class="fas fa-download"></i> View/Download</a></td>
                        </tr>
                        <tr>
                            <td class="md-sno">8</td>
                            <td class="md-label">Copies of Valid Water, Health and Sanitation Certificates</td>
                            <td><a class="btn-md-doc" target="_blank" href="{{ Storage::url($record->doc_water_health_sanitation) }}"><i class="fas fa-download"></i> View/Download</a></td>
                        </tr>
                        <tr>
                            <td class="md-sno">9</td>
                            <td class="md-label">Land Certificate</td>
                            <td><a class="btn-md-doc" target="_blank" href="{{ Storage::url($record->land_certificate) }}"><i class="fas fa-download"></i> View/Download</a></td>
                        </tr>
                        <tr>
                            <td class="md-sno">10</td>
                            <td class="md-label">SARAS 5.0</td>
                            <td><a class="btn-md-doc" target="_blank" href="{{ Storage::url($record->cbse_saras) }}"><i class="fas fa-download"></i> View/Download</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- -- Section 3: Academic Documents ----------------------------- --}}
        <div class="md-section-card" data-aos="fade-up" data-aos-delay="100">
            <div class="md-section-header">
                <i class="fas fa-book-open"></i> Academic Documents
            </div>
            <div class="table-responsive">
                <table class="table md-table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="md-sno">#</th>
                            <th>Document / Information</th>
                            <th style="width:140px;">Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="md-sno">1</td>
                            <td class="md-label">Fee Structure of the School</td>
                            <td><a class="btn-md-doc" target="_blank" href="{{ Storage::url($record->fee_structure) }}"><i class="fas fa-download"></i> View/Download</a></td>
                        </tr>
                        <tr>
                            <td class="md-sno">2</td>
                            <td class="md-label">Annual Academic Calendar</td>
                            <td><a class="btn-md-doc" target="_blank" href="{{ Storage::url($record->academic_calendar) }}"><i class="fas fa-download"></i> View/Download</a></td>
                        </tr>
                        <tr>
                            <td class="md-sno">3</td>
                            <td class="md-label">List of School Management Committee (SMC)</td>
                            <td><a class="btn-md-doc" target="_blank" href="{{ Storage::url($record->smc) }}"><i class="fas fa-download"></i> View/Download</a></td>
                        </tr>
                        <tr>
                            <td class="md-sno">4</td>
                            <td class="md-label">List of Parents Teachers Association (PTA) Members</td>
                            <td><a class="btn-md-doc" target="_blank" href="{{ Storage::url($record->pta) }}"><i class="fas fa-download"></i> View/Download</a></td>
                        </tr>
                        <tr>
                            <td class="md-sno">5</td>
                            <td class="md-label">Last Three-Year Result of the Board Examination as per Applicability</td>
                            <td><a class="btn-md-doc" target="_blank" href="{{ Storage::url($record->board_result) }}"><i class="fas fa-download"></i> View/Download</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- -- Section 4: Staff Details ----------------------------------- --}}
        <div class="md-section-card" data-aos="fade-up" data-aos-delay="150">
            <div class="md-section-header">
                <i class="fas fa-chalkboard-teacher"></i> Staff Details
            </div>
            <div class="table-responsive">
                <table class="table md-table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="md-sno">#</th>
                            <th>Information</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="md-sno">1</td>
                            <td class="md-label">Principal</td>
                            <td class="md-value">{{ $record->principal }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">2</td>
                            <td class="md-label">Total No. of Teachers</td>
                            <td class="md-value">{{ $record->total_teachers }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">&nbsp;</td>
                            <td class="md-label ps-4">? PGT</td>
                            <td class="md-value">{{ $record->pgt }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">&nbsp;</td>
                            <td class="md-label ps-4">? TGT</td>
                            <td class="md-value">{{ $record->tgt }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">&nbsp;</td>
                            <td class="md-label ps-4">? PRT</td>
                            <td class="md-value">{{ $record->prt }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">3</td>
                            <td class="md-label">Teacher Section Ratio</td>
                            <td class="md-value">{{ $record->teacher_section_ratio }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">4</td>
                            <td class="md-label">Details of Special Educator</td>
                            <td class="md-value">{{ $record->special_education }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">5</td>
                            <td class="md-label">Details of Counsellor and Wellness Teacher</td>
                            <td class="md-value">{{ $record->counsellor_wellness }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- -- Section 5: Infrastructure ---------------------------------- --}}
        <div class="md-section-card" data-aos="fade-up" data-aos-delay="200">
            <div class="md-section-header">
                <i class="fas fa-building"></i> Infrastructure
            </div>
            <div class="table-responsive">
                <table class="table md-table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="md-sno">#</th>
                            <th>Information</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="md-sno">1</td>
                            <td class="md-label">Total Campus Area of the School (in sq. mtr)</td>
                            <td class="md-value">{{ $record->campus_area }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">2</td>
                            <td class="md-label">No. and Size of the Class Rooms (in sq. mtr)</td>
                            <td class="md-value">{{ $record->class_rooms }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">3</td>
                            <td class="md-label">No. and Size of Laboratories including Computer Labs (in sq. mtr)</td>
                            <td class="md-value">{{ $record->laboratories }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">4</td>
                            <td class="md-label">Internet Facility (Y/N)</td>
                            <td class="md-value">{{ $record->internet }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">5</td>
                            <td class="md-label">No. of Girls Toilets</td>
                            <td class="md-value">{{ $record->girls_toilets }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">6</td>
                            <td class="md-label">No. of Boys Toilets</td>
                            <td class="md-value">{{ $record->boys_toilets }}</td>
                        </tr>
                        <tr>
                            <td class="md-sno">7</td>
                            <td class="md-label">Link of YouTube Video of School Inspection covering Infrastructure</td>
                            <td class="md-value">
                                @if($record->inspection_video)
                                    <a href="{{ $record->inspection_video }}" target="_blank" rel="noopener noreferrer"
                                        style="color: rgb(98,18,17); word-break:break-all;">
                                        <i class="fab fa-youtube me-1"></i>Watch Video
                                    </a>
                                @else
                                    �
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        @endforeach
    </div>

@endsection



