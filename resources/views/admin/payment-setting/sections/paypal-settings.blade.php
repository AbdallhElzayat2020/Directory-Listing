<div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">


    <div class="card border">
        <div class="card-body">

            <form action="{{ route('admin.payment-settings.update') }}" method="post">
                @csrf

                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="paypal_status">Paypal Status</label>
                            <select name="paypal_status" id="paypal_status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paypal_mode">Paypal Mode</label>
                            <select name="paypal_mode" id="paypal_mode" class="form-control">
                                <option value="sandbox">Sandbox</option>
                                <option value="live">Live</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paypal_country">Paypal Country</label>
                            <select name="paypal_country" id="paypal_country" class="form-control select2">
                                <option value="">Select</option>
                                @foreach (config('countries') as $code => $country)
                                    <option value="{{ $code }}">{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="paypal_currency">Paypal Currency</label>
                            <select name="paypal_currency" id="paypal_currency" class="form-control select2">
                                @foreach (config('currency.currency_list') as $key => $currency)
                                    <option value="{{ $currency }}">
                                        {{ $key }} ({{ $currency }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paypal_currency_rate">Paypal Currency Rate (Per
                                {{ config('settings.site_default_currency') }})</label>
                            <input type="text" class="form-control" name="paypal_currency_rate"
                                value="{{ old('paypal_currency_rate') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paypal_client_id">Paypal Client ID</label>
                            <input type="text" class="form-control" name="paypal_client_id"
                                value="{{ old('paypal_client_id') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paypal_secret_key">Paypal Secret Key</label>
                            <input type="text" class="form-control" name="paypal_secret_key"
                                value="{{ old('paypal_secret_key') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paypal_app_key">Paypal App Key</label>
                            <input type="text" class="form-control" name="paypal_app_key"
                                value="{{ old('paypal_app_key') }}">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>

        </div>
    </div>

</div>
