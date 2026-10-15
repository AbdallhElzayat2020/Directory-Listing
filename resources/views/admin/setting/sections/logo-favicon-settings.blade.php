<div class="card border">
    <div class="card-body">

        <form action="{{ route('admin.logo-favicon-settings.update') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Logo --}}
            <div class="mb-3">
                <label>Logo</label>
                @if(config('settings.logo'))
                    <div class="mb-2">
                        <img src="{{ asset('settings/' . config('settings.logo')) }}"
                             alt="Logo"
                             style="max-height: 80px;">
                    </div>
                @endif
                <input type="file" name="logo"
                       class="form-control @error('logo') is-invalid @enderror"
                       accept="image/*">
                @error('logo')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Favicon --}}
            <div class="mb-3">
                <label>Favicon</label>
                @if(config('settings.favicon'))
                    <div class="mb-2">
                        <img src="{{ asset('settings/' .config('settings.favicon')) }}"
                             alt="Favicon"
                             style="max-height: 32px;">
                    </div>
                @endif
                <input type="file" name="favicon"
                       class="form-control @error('favicon') is-invalid @enderror"
                       accept=".ico,.png,.jpg,.jpeg">
                @error('favicon')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>

    </div>
</div>
