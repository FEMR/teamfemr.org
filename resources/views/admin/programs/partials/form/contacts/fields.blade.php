<div class="columns">

    {{--<div class="column is-2">--}}
        {{--<div class="field">--}}
            {{--<label class="label">Prefix</label>--}}
            {{--<p class="control">--}}
                {{--{!! Form::text( 'prefix', null, [ 'class' => 'input', 'v-model' => 'prefix', ':class' => '{ "is-danger": errors.has( "prefix" ) }' ] ) !!}--}}
            {{--</p>--}}
            {{--<p class="help is-danger" v-if="errors.has('prefix')">@{{ errors.get('prefix') }}</p>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="column">
        <div class="field">
            <label class="label">First</label>
            <p class="control">
                {!! Form::text( 'first_name', null, [ 'class' => 'input', 'v-model' => 'first_name', ':class' => '{ "is-danger": errors.has( "first_name" ) }' ] ) !!}
            </p>
            <p class="help is-danger" v-if="errors.has('first_name')">@{{ errors.get('first_name') }}</p>
        </div>
    </div>

    {{--<div class="column is-3">--}}
        {{--<div class="field">--}}
            {{--<label class="label">Middle</label>--}}
            {{--<p class="control">--}}
                {{--{!! Form::text( 'middle_name', null, [ 'class' => 'input', 'v-model' => 'middle_name', ':class' => '{ "is-danger": errors.has( "middle_name" ) }' ] ) !!}--}}
            {{--</p>--}}
            {{--<p class="help is-danger" v-if="errors.has('middle_name')">@{{ errors.get('middle_name') }}</p>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="column">
        <div class="field">
            <label class="label">Last</label>
            <p class="control">
                {!! Form::text( 'last_name', null, [ 'class' => 'input', 'v-model' => 'last_name', ':class' => '{ "is-danger": errors.has( "last_name" ) }' ] ) !!}
            </p>
            <p class="help is-danger" v-if="errors.has('last_name')">@{{ errors.get('last_name') }}</p>
        </div>
    </div>

    {{--<div class="column is-2">--}}
        {{--<div class="field">--}}
            {{--<label class="label">Suffix</label>--}}
            {{--<p class="control">--}}
                {{--{!! Form::text( 'suffix', null, [ 'class' => 'input', 'v-model' => 'suffix', ':class' => '{ "is-danger": errors.has( "suffix" ) }' ] ) !!}--}}
            {{--</p>--}}
            {{--<p class="help is-danger" v-if="errors.has('suffix')">@{{ errors.get('suffix') }}</p>--}}
        {{--</div>--}}
    {{--</div>--}}

</div>











<div class="field">
    <label class="label">Title</label>
    <p class="control">
        {!! Form::text( 'title', null, [ 'class' => 'input', 'v-model' => 'title', ':class' => '{ "is-danger": errors.has( "title" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('title')">@{{ errors.get('title') }}</p>
</div>

<div class="field">
    <label class="label">Email</label>
    <p class="control">
        {!! Form::text( 'email', null, [ 'class' => 'input', 'v-model' => 'email', ':class' => '{ "is-danger": errors.has( "email" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('email')">@{{ errors.get('email') }}</p>
</div>

<div class="field">
    <label class="label">Phone</label>
    <p class="control">
        {!! Form::text( 'phone', null, [ 'class' => 'input', 'v-model' => 'phone', ':class' => '{ "is-danger": errors.has( "phone" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('phone')">@{{ errors.get('phone') }}</p>
</div>

<div class="field">
    <label class="label">Notes</label>
    <p class="control">
        {!! Form::textarea( 'notes', null, [ 'class' => 'textarea', 'v-model' => 'notes', ':class' => '{ "is-danger": errors.has( "notes" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('notes')">@{{ errors.get('notes') }}</p>
</div>