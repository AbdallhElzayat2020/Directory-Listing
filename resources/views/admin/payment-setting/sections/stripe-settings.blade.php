<div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">


    <div class="card border">
        <div class="card-body">

            <form action="{{ route('admin.stripe-settings.update') }}" method="post">
                @csrf

                <div class="row">
                    {{-- Stripe Status --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="stripe_status">Stripe Status</label>
                            <select name="stripe_status" id="stripe_status" class="form-control">
                                <option @selected(old('stripe_status', config('payment.stripe_status')) == 'active') value="active">Active</option>
                                <option @selected(old('stripe_status', config('payment.stripe_status')) == 'inactive') value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    {{-- Stripe Country --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="stripe_country">Stripe Country</label>
                            <select name="stripe_country" id="stripe_country" class="form-control select2">
                                <option value="">Select</option>
                                @foreach (config('countries') as $code => $country)
                                    <option @selected(old('stripe_country', config('payment.stripe_country')) == $code) value="{{ $code }}">
                                        {{ $country }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Stripe Currency --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="stripe_currency">Stripe Currency</label>
                            <select name="stripe_currency" id="stripe_currency" class="form-control select2">
                                @foreach (config('currency.currency_list') as $key => $currency)
                                    <option value="{{ $currency }}" @selected(old('stripe_currency', config('payment.stripe_currency')) == $currency)>
                                        {{ $key }} ({{ $currency }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Stripe Currency Rate --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="stripe_currency_rate">Stripe Currency Rate
                                (Per{{ config('settings.site_default_currency') }})</label>
                            <input type="text" class="form-control" name="stripe_currency_rate"
                                value="{{ old('stripe_currency_rate', config('payment.stripe_currency_rate')) }}">
                        </div>
                    </div>

                    {{-- Stripe Key --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="stripe_key">Stripe Publishable Key</label>
                            <input type="text" class="form-control" name="stripe_key"
                                value="{{ old('stripe_key', config('payment.stripe_key')) }}">
                        </div>
                    </div>

                    {{-- Stripe Secret Key --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="stripe_secret_key">Stripe Secret Key</label>
                            <input type="text" class="form-control" name="stripe_secret_key"
                                value="{{ old('stripe_secret_key', config('payment.stripe_secret_key')) }}">
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>

        </div>
    </div>

</div>
