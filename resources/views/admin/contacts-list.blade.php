@extends('admin/layouts/app')

@section('admin-title', 'Contacts – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'View and manage contact form submissions')
@section('admin-keywords', 'contacts, inquiries, messages, admin, management')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Contact Form Enquries</h1>
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
                                            <th width="10%">#</th>
                                            <th width="10%">Name</th>
                                            <th width="10%">Email</th>
                                            <th width="10%">Phone</th>
                                            <th width="50%">Message</th>
                                            <th width="10%">Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($contacts !== null && count($contacts) > 0)
                                            @foreach ($contacts as $key => $contact)
                                                @php
                                                    $sno = $loop->index + 1; // Manually incrementing the S.No
                                                @endphp
                                                <tr>
                                                    <td>{{ $sno }}</td>
                                                    <td>{{ $contact->name }}</td>
                                                    <td>{{ $contact->email }}</td>
                                                    <td>{{ $contact->phone_number }}</td>
                                                    <td>{{ $contact->message }}</td>
                                                    <td>{{ $contact->created_at->format('d F Y') }}</td>
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
