@extends('layouts.app')

@section('content')
<div class="bg-light min-vh-100 py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                {{-- Success / Error --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm mb-4">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm mb-4">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Header --}}
                <div class="card border-0 shadow-lg rounded-4 mb-4 overflow-hidden"
                     style="background: linear-gradient(135deg, #003d82 0%, #0052a8 100%);">
                    <div class="card-body p-4 p-md-5 text-white">
                        <h1 class="h2 fw-bold mb-2">Upload Required Documents</h1>
                        <p class="lead mb-0 opacity-90">
                            Application ID: <strong>#{{ $application->id }}</strong> |
                            Program: <strong>{{ $application->program->code }}</strong>
                        </p>
                    </div>
                </div>

                {{-- Upload Form --}}
                <div class="card border-0 shadow-lg rounded-4 mb-4">
                    <div class="card-body p-4">
                        <form action="{{ route('student.documents.store', $application->id) }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Document Type *</label>
                                    <select name="document_type" class="form-select shadow-sm" required>
                                        <option value="">-- Select Document Type --</option>

                                        <option value="photo" {{ $application->documents->where('document_type','photo')->count() ? 'disabled' : '' }}>📷 Passport Photo</option>

                                        <option value="cnic_front" {{ $application->documents->where('document_type','cnic_front')->count() ? 'disabled' : '' }}>🆔 CNIC Front</option>

                                        <option value="cnic_back" {{ $application->documents->where('document_type','cnic_back')->count() ? 'disabled' : '' }}>🆔 CNIC Back</option>

                                        <option value="matric_certificate" {{ $application->documents->where('document_type','matric_certificate')->count() ? 'disabled' : '' }}>📜 Matric Certificate</option>

                                        <option value="inter_certificate" {{ $application->documents->where('document_type','inter_certificate')->count() ? 'disabled' : '' }}>📜 Intermediate Certificate</option>

                                        <option value="domicile" {{ $application->documents->where('document_type','domicile')->count() ? 'disabled' : '' }}>📄 Domicile Certificate</option>

                                        <option value="paid_challan" {{ $application->documents->where('document_type','paid_challan')->count() ? 'disabled' : '' }}>💳 Paid Fee Challan</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Choose File *</label>
                                    <input type="file" name="document" class="form-control shadow-sm" required>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary rounded-pill px-4">
                                        <i class="bi bi-cloud-upload-fill me-2"></i>Upload
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Uploaded Documents --}}
                <div class="card border-0 shadow-lg rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="row g-3">
                            @foreach($application->documents as $document)
                                <div class="col-md-6">
                                    <div class="card border-success h-100">
                                        <div class="card-body">
                                            <h6 class="fw-bold">
                                                @switch($document->document_type)
                                                    @case('photo') 📷 Passport Photo @break
                                                    @case('cnic_front') 🆔 CNIC Front @break
                                                    @case('cnic_back') 🆔 CNIC Back @break
                                                    @case('matric_certificate') 📜 Matric Certificate @break
                                                    @case('inter_certificate') 📜 Inter Certificate @break
                                                    @case('domicile') 📄 Domicile @break
                                                    @case('paid_challan') 💳 Paid Fee Challan @break
                                                @endswitch
                                            </h6>

                                            <div class="d-flex gap-2">
                                                <a href="{{ asset('storage/'.$document->file_path) }}"
                                                   target="_blank"
                                                   class="btn btn-sm btn-primary rounded-pill">
                                                    View
                                                </a>

                                                <form action="{{ route('student.documents.destroy', [$application->id, $document->id]) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this document?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger rounded-pill">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Checklist --}}
                <div class="card border-0 shadow-lg rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="row g-2">
                            @foreach([
                                'photo' => '📷 Passport Photo',
                                'cnic_front' => '🆔 CNIC Front',
                                'cnic_back' => '🆔 CNIC Back',
                                'matric_certificate' => '📜 Matric Certificate',
                                'inter_certificate' => '📜 Intermediate Certificate',
                                'domicile' => '📄 Domicile Certificate',
                                'paid_challan' => '💳 Paid Fee Challan'
                            ] as $type => $label)
                                <div class="col-md-6">
                                    <div class="p-2 rounded {{ $application->documents->where('document_type',$type)->count() ? 'bg-success bg-opacity-10' : 'bg-light' }}">
                                        {!! $label !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                @if($application->documents->whereIn('document_type',[
                    'photo','cnic_front','cnic_back','matric_certificate','inter_certificate','domicile','paid_challan'
                ])->count() === 7)
                    <div class="text-center mb-4">
                        <form action="{{ route('student.application.submit', $application->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success rounded-pill px-4">
                                <i class="bi bi-send-fill me-2"></i>Submit Application
                            </button>
                        </form>
                    </div>
                @endif

                <div class="text-center">
                    <a href="{{ route('student.dashboard') }}" class="btn btn-outline-primary rounded-pill">
                        ← Back to Dashboard
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
