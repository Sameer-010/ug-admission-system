<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-header bg-danger text-white fw-bold">
        Delete Account
    </div>

    <div class="card-body">

        <p class="text-muted">
            Once your account is deleted, all your data will be permanently removed.
        </p>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <div class="mb-3">
                <label class="form-label fw-semibold">Confirm Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <button class="btn btn-danger px-4"
                    onclick="return confirm('Are you sure you want to delete your account? This cannot be undone!');">
                Delete Account
            </button>
        </form>

    </div>
</div>
