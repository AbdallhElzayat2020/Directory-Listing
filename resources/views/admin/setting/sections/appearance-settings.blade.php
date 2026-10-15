<div class="card border">
    <div class="card-body">
        <form action="{{ route('admin.appearance-settings.update') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="font-weight-bold">Default Site Color</label>
                <div class="d-flex align-items-center gap-3">
                    <input type="color" class="form-control form-control-color @error('site_color') is-invalid @enderror"
                           value="{{ old('site_color', config('settings.site_color', '#0d6efd')) }}" name="site_color"
                           id="siteColorPicker" style="width: 60px; height: 45px; padding: 4px; cursor: pointer;">
                    <input type="text" class="form-control" id="siteColorText"
                           value="{{ old('site_color', config('settings.site_color', '#0d6efd')) }}" style="max-width: 150px;">
                </div>
                @error('site_color')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">
                <i class="fas fa-save me-1"></i> Save
            </button>
        </form>
    </div>
</div>
