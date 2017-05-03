<div class="field">
    <label class="label">Name</label>
    <p class="control">
        {!! Form::text( 'name', null, [ 'class' => 'input' ] ) !!}
    </p>
</div>

{{-- This is set by the HasSlug trait's observer. Uncomment later if we want to manually set slugs --}}
{{--<div class="field">--}}
{{--<label class="label">Slug</label>--}}
{{--<p class="control">--}}
{{--{!! Form::text( 'slug', null, [ 'class' => 'input', 'readonly' ] ) !!}--}}
{{--</p>--}}
{{--</div>--}}

<div class="field">
    <label class="label">Address</label>
    <p class="control">
        {!! Form::text( 'address', null, [ 'class' => 'input' ] ) !!}
    </p>
</div>

<div class="field">
    <label class="label">Address Ext.</label>
    <p class="control">
        {!! Form::text( 'address_ext', null, [ 'class' => 'input' ] ) !!}
    </p>
</div>

<div class="field">
    <label class="label">City (Locality)</label>
    <p class="control">
        {!! Form::text( 'locality', null, [ 'class' => 'input' ] ) !!}
    </p>
</div>

<div class="field">
    <label class="label">State (Ad. Level 1)</label>
    <p class="control">
        {!! Form::text( 'administrative_area_level_1', null, [ 'class' => 'input' ] ) !!}
    </p>
</div>

<div class="field">
    <label class="label">Country</label>
    <p class="control">
        {!! Form::text( 'country', null, [ 'class' => 'input' ] ) !!}
    </p>
</div>

<div class="field">
    <label class="label">Postal Code</label>
    <p class="control">
        {!! Form::text( 'postal_code', null, [ 'class' => 'input' ] ) !!}
    </p>
</div>

<div class="field">
    <label class="label">Latitude</label>
    <p class="control">
        {!! Form::text( 'latitude', null, [ 'class' => 'input' ] ) !!}
    </p>
</div>

<div class="field">
    <label class="label">Longitude</label>
    <p class="control">
        {!! Form::text( 'longitude', null, [ 'class' => 'input' ] ) !!}
    </p>
</div>

<div class="field">
    <label class="label">Notes</label>
    <p class="control">
        <textarea class="textarea" placeholder="Enter optional notes"></textarea>
    </p>
</div>

<div class="field is-grouped">
    <p class="control">
        <button class="button is-primary">Submit</button>
    </p>
</div>