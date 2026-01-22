<div class="card border-0 shadow-lg rounded-4 mb-4">
    <div class="card-header bg-white p-4">
        <h3 class="fw-bold fs-4">
            <i class="bi bi-files me-2 text-primary"></i> Uploaded Documents
        </h3>
    </div>

    <div class="card-body p-4">
        @if($application->documents->isEmpty())
            <div class="text-center py-4">
                <i class="bi bi-folder-x text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-2">No documents uploaded.</p>
            </div>
        @else
            <div class="row g-3">
                @foreach($application->documents as $doc)
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100">
                            <div class="card-body">
                                <h6 class="fw-bold text-capitalize">
                                    {{ str_replace('_', ' ', $doc->document_type) }}
                                </h6>
                                <small class="text-muted">
                                    {{ number_format($doc->file_size / 1024, 1) }} KB
                                </small>

                                <div class="mt-3 d-flex gap-2">
                                    <a target="_blank" href="{{ asset('storage/'.$doc->file_path) }}"
                                       class="btn btn-outline-primary btn-sm rounded-pill w-50">
                                        <i class="bi bi-eye"></i> View
                                    </a>

                                    <a download href="{{ asset('storage/'.$doc->file_path) }}"
                                       class="btn btn-outline-success btn-sm rounded-pill w-50">
                                        <i class="bi bi-download"></i> Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
