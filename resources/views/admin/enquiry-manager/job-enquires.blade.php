@extends('admin/layouts/app')
@section('admin-title', 'Job Enquiries – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'View and manage job application inquiries')
@section('admin-keywords', 'job enquiries, applications, careers, admin, management')
@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Job Enquries</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content h-100">
            <div class="container-fluid h-100">
                @if (Session::has('success'))
                    <div id= "session-alert" class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="10%">Name</th>
                                            <th width="10%">Email</th>
                                            <th width="10%">Contact</th>
                                            <th width="10%">Position Applied</th>
                                            <th width="10%">Qualification</th>
                                            <th width="10%">Resume</th>
                                            <th width="35%">Message</th>
                                            <th width="10%">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($enquires !== null && count($enquires) > 0)
                                            @foreach ($enquires as $key => $enquiry)
                                                @php
                                                    $sno = $loop->index + 1; // Manually incrementing the S.No
                                                @endphp
                                                <tr>
                                                    <td>{{ $sno }}</td>
                                                    <td>{{ $enquiry->name }}</td>
                                                    <td>{{ $enquiry->email }}</td>
                                                    <td>{{ $enquiry->phone_number }}</td>
                                                    <td>{{ $enquiry->position_applied }}</td>
                                                    <td>{{ $enquiry->qualification }}</td>
                                                    <td>
                                                        @if (!empty($enquiry->resume_file_path))
                                                            <button class="btn btn-primary">
                                                                <a style="color: white" target="_blank"
                                                                    href="{{ Storage::url($enquiry->resume_file_path) }}">View/Download
                                                                </a>
                                                            </button>
                                                        @else
                                                            <p class="badge badge-info">Resume not Uploaded by a Candidate
                                                            </p>
                                                        @endif
                                                    </td>

                                                    <td>{{ $enquiry->message }}</td>
                                                    <td>{{ $enquiry->created_at->format('d F Y') }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="12" class="text-center">No Enquries Found.</td>
                                            </tr>
                                        @endif
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
