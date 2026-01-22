<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-header bg-primary text-white fw-bold">
        Update Profile Information
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label class="form-label fw-semibold">Name</label>
                <input type="text" class="form-control" name="name"
                    value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" name="email"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            <button class="btn btn-success px-4">Save</button>
        </form>

    </div>
</div>
