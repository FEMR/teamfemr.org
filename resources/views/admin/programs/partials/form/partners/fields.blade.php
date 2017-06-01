<div class="field">
    <label class="label">Name</label>
    <p class="control">
        {!! Form::text( 'name', null, [ 'class' => 'input', 'v-model' => 'name', ':class' => '{ "is-danger": errors.has( "name" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('name')">@{{ errors.get('name') }}</p>
</div>

{{--<div class="field">--}}
    {{--<label class="label">Slug</label>--}}
    {{--<p class="control">--}}
        {{--{!! Form::text( 'slug', null, [ 'class' => 'input', 'v-model' => 'slug', ':class' => '{ "is-danger": errors.has( "slug" ) }' ] ) !!}--}}
    {{--</p>--}}
    {{--<p class="help is-danger" v-if="errors.has('slug')">@{{ errors.get('slug') }}</p>--}}
{{--</div>--}}

<div class="field">
    <label class="label">Website</label>
    <p class="control">
        {!! Form::text( 'website', null, [ 'class' => 'input', 'v-model' => 'website', ':class' => '{ "is-danger": errors.has( "website" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('website')">@{{ errors.get('website') }}</p>
</div>