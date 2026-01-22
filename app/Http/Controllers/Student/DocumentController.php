<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /* ===============================
     * DOCUMENT UPLOAD PAGE
     * =============================== */
    public function index($applicationId)
    {
        $application = Application::where('user_id', auth()->id())
            ->with(['documents', 'program'])
            ->findOrFail($applicationId);

        return view('student.documents.upload', compact('application'));
    }

    /* ===============================
     * STORE DOCUMENT (CNIC FRONT / BACK INCLUDED)
     * =============================== */
    public function store(Request $request, $applicationId)
    {
        $application = Application::where('user_id', auth()->id())
            ->findOrFail($applicationId);

        $request->validate([
            'document_type' => 'required|in:photo,cnic_front,cnic_back,matric_certificate,inter_certificate,domicile,paid_challan',
            'document'      => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Prevent duplicate upload of same document type
        $exists = Document::where('application_id', $applicationId)
            ->where('document_type', $request->document_type)
            ->exists();

        if ($exists) {
            return back()->with('error', 'This document is already uploaded.');
        }

        $file = $request->file('document');
        $fileName = time() . '_' . $file->getClientOriginalName();

        $filePath = $file->storeAs(
            'documents/' . $applicationId,
            $fileName,
            'public'
        );

        Document::create([
            'application_id' => $applicationId,
            'document_type'  => $request->document_type,
            'file_name'      => $fileName,
            'file_path'      => $filePath,
            'file_size'      => $file->getSize(),
            'mime_type'      => $file->getMimeType(),
            'is_verified'    => false,
        ]);

        return back()->with('success', 'Document uploaded successfully!');
    }

    /* ===============================
     * DELETE DOCUMENT
     * =============================== */
    public function destroy($applicationId, $documentId)
    {
        $document = Document::where('application_id', $applicationId)
            ->findOrFail($documentId);

        Storage::disk('public')->delete($document->file_path);
        $document->delete();

        return back()->with('success', 'Document deleted successfully!');
    }

    /* ===============================
     * SUBMIT APPLICATION
     * =============================== */
    public function submit($applicationId)
    {
        $application = Application::where('user_id', auth()->id())
            ->with('documents')
            ->findOrFail($applicationId);

        /*
        |--------------------------------------------------
        | REQUIRED DOCUMENTS (CNIC FRONT + BACK INCLUDED)
        |--------------------------------------------------
        */
        $requiredDocs = [
            'photo',
            'cnic_front',
            'cnic_back',
            'matric_certificate',
            'inter_certificate',
            'domicile',
            'paid_challan',
        ];

        $uploadedDocs = $application->documents
            ->pluck('document_type')
            ->toArray();

        $missingDocs = array_diff($requiredDocs, $uploadedDocs);

        if (!empty($missingDocs)) {
            return back()->with(
                'error',
                'Please upload ALL required documents (including CNIC front & back and paid challan) before submitting.'
            );
        }

        $application->update([
            'status'       => 'submitted',
            'submitted_at' => now(),
        ]);

        return redirect()
            ->route('student.dashboard')
            ->with('success', 'Application submitted successfully!');
    }
}
