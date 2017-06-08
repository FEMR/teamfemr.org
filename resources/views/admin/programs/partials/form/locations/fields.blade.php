<div class="field">
    <label class="label">Start Date</label>
    <p class="control">
        {!! Form::input( 'date', 'start_date', null, [ 'class' => 'input', 'v-model' => 'start_date', ':class' => '{ "is-danger": errors.has( "start_date" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('start_date')">@{{ errors.get('start_date') }}</p>
</div>

<div class="field">
    <label class="label">End Date</label>
    <p class="control">
        {!! Form::input( 'date', 'end_date', null, [ 'class' => 'input', 'v-model' => 'end_date', ':class' => '{ "is-danger": errors.has( "end_date" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('end_date')">@{{ errors.get('end_date') }}</p>
</div>

<div class="field">
    <label class="label">Address</label>
    <p class="control">
        {!! Form::text( 'address', null, [ 'class' => 'input', 'v-model' => 'address', ':class' => '{ "is-danger": errors.has( "address" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('address')">@{{ errors.get('address') }}</p>
</div>

<div class="field">
    <label class="label">Address Ext</label>
    <p class="control">
        {!! Form::text( 'address_ext', null, [ 'class' => 'input', 'v-model' => 'address_ext', ':class' => '{ "is-danger": errors.has( "address_ext" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('address_ext')">@{{ errors.get('address_ext') }}</p>
</div>

<div class="field">
    <label class="label">City</label>
    <p class="control">
        {!! Form::text( 'locality', null, [ 'class' => 'input', 'v-model' => 'locality', ':class' => '{ "is-danger": errors.has( "locality" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('locality')">@{{ errors.get('locality') }}</p>
</div>

<div class="field">
    <label class="label">State</label>
    <p class="control">
        {!! Form::text( 'administrative_area_level_1', null, [ 'class' => 'input', 'v-model' => 'administrative_area_level_1', ':class' => '{ "is-danger": errors.has( "administrative_area_level_1" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('administrative_area_level_1')">@{{ errors.get('administrative_area_level_1') }}</p>
</div>

{{--<div class="field">--}}
    {{--<label class="label">Administrative Area Level 2</label>--}}
    {{--<p class="control">--}}
        {{--{!! Form::text( 'administrative_area_level_2', null, [ 'class' => 'input', 'v-model' => 'administrative_area_level_2', ':class' => '{ "is-danger": errors.has( "administrative_area_level_2" ) }' ] ) !!}--}}
    {{--</p>--}}
    {{--<p class="help is-danger" v-if="errors.has('administrative_area_level_2')">@{{ errors.get('administrative_area_level_2') }}</p>--}}
{{--</div>--}}

<div class="field">
    <label class="label">Postal Code</label>
    <p class="control">
        {!! Form::text( 'postal_code', null, [ 'class' => 'input', 'v-model' => 'postal_code', ':class' => '{ "is-danger": errors.has( "postal_code" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('postal_code')">@{{ errors.get('postal_code') }}</p>
</div>

<div class="field">
    <label class="label">Country</label>
    <p class="control">
        {!! Form::text( 'country', null, [ 'class' => 'input', 'v-model' => 'country', ':class' => '{ "is-danger": errors.has( "country" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('country')">@{{ errors.get('country') }}</p>
</div>

<div class="field">
    <label class="label">Latitude</label>
    <p class="control">
        {!! Form::text( 'latitude', null, [ 'class' => 'input', 'v-model' => 'latitude', ':class' => '{ "is-danger": errors.has( "latitude" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('latitude')">@{{ errors.get('latitude') }}</p>
</div>

<div class="field">
    <label class="label">Longitude</label>
    <p class="control">
        {!! Form::text( 'longitude', null, [ 'class' => 'input', 'v-model' => 'longitude', ':class' => '{ "is-danger": errors.has( "longitude" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('longitude')">@{{ errors.get('longitude') }}</p>
</div>