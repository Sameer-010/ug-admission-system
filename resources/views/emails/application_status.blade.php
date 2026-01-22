@component('mail::message')
# Application Status Update

Dear {{ $application->user->name }},

Your application for **{{ $application->program->name }}** has been updated.

**Current Status:** {{ ucfirst(str_replace('_', ' ', $application->status)) }}

@if($application->admin_comments)
**Admin Comments:**  
{{ $application->admin_comments }}
@endif

@component('mail::button', ['url' => route('student.application.show', $application->id)])
View Application
@endcomponent

Thank you,  
**University of Gwadar Admission Office**
@endcomponent
