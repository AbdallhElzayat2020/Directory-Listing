<div class="card border">
    <div class="card-body">

        <form action="{{ route('admin.general-settings.update') }}" method="post">
            @csrf

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Site Name</label>
                        <input type="text" class="form-control"
                               name="site_name"
                               value="{{ old('site_name', config('settings.site_name')) }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Site Email</label>
                        <input type="text" class="form-control"
                               name="site_email"
                               value="{{ old('site_email', config('settings.site_email')) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Site Phone</label>
                        <input type="text" class="form-control"
                               name="site_phone"
                               value="{{ old('site_phone', config('settings.site_phone')) }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Site Default Currency </label>
                        <select name="site_default_currency"
                                id="site_default_currency"
                                class="form-control select2">
                            @foreach (config('currency.currency_list') as $key => $currency)
                                <option value="{{ $currency }}"
                                    @selected($currency === config('settings.site_default_currency'))>
                                    {{ $key }} ({{ $currency }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{--                                                            <div class="col-md-12">--}}
                {{--                                                                <div class="form-group">--}}
                {{--                                                                    <label for="">Site Default Timezone </label>--}}
                {{--                                                                    <select name="site_default_timezone" id="site_default_timezone" class="form-control select2">--}}

                {{--                                                                        @foreach (config('time-zone') as $key => $timezone)--}}
                {{--                                                                            <option value="{{ $timezone }}"@selected($timezone === config('settings.site_default_timezone'))>--}}
                {{--                                                                                {{ $key }} ({{ $timezone }})--}}
                {{--                                                                            </option>--}}
                {{--                                                                        @endforeach--}}

                {{--                                                                    </select>--}}
                {{--                                                                </div>--}}
                {{--                                                            </div>--}}

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Site Currency Icon</label>
                        <input type="text" class="form-control"
                               name="site_currency_icon"
                               value="{{ old('site_currency_icon', config('settings.site_currency_icon')) }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Site Currency Position</label>
                        <select name="site_currency_position"
                                id="site_currency_position" class="form-control">
                            <option value="left"
                                @selected('left' === config('settings.site_currency_position'))>Left
                            </option>
                            <option value="right"
                                @selected('right' === config('settings.site_currency_position'))>Right
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>

    </div>
</div>
