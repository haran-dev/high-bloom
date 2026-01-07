@extends('layouts.app')

@section('content')

<div class="pagetitle">
    <h1 class="fw-semibold">{{ $heading }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active">Data</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card shadow-sm border-0">
                
                <!-- Card Header -->
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-semibold text-dark">
                        {{ $heading }}
                    </h5>

                    <button
                        type="button"
                        data-url="{{ route('company.create') }}"
                        class="btn btn-primary add-data d-flex align-items-center gap-2">
                        <i class="bi bi-plus-circle"></i>
                        <span class="btn-text">Add Company</span>
                        <span class="spinner-border spinner-border-sm d-none"
                              role="status" aria-hidden="true">
                        </span>
                    </button>
                </div>

                <!-- Card Body -->
                <div class="card-body pt-3">

                    <div class="table-responsive">
                        <table class="table table-hover table-striped datatable align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 25%">Name</th>
                                    <th>Ext.</th>
                                    <th>City</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                                    <th>Completion</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="fw-medium">Unity Pugh</td>
                                    <td>9958</td>
                                    <td>Curicó</td>
                                    <td>2005/02/11</td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success fw-semibold">
                                            37%
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="fw-medium">Unity Pugh</td>
                                    <td>9958</td>
                                    <td>Curicó</td>
                                    <td>2005/02/11</td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success fw-semibold">
                                            37%
                                        </span>
                                    </td>
                                </tr>


                                <tr>
                                    <td class="fw-medium">Unity Pugh</td>
                                    <td>9958</td>
                                    <td>Curicó</td>
                                    <td>2005/02/11</td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success fw-semibold">
                                            37%
                                        </span>
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

@endsection
