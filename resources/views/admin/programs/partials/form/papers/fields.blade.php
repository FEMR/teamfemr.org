<div class="field">
    <label class="label">Title</label>
    <p class="control">
        {!! Form::text( 'title', null, [ 'class' => 'input', 'v-model' => 'title', ':class' => '{ "is-danger": errors.has( "title" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('title')">@{{ errors.get('title') }}</p>
</div>

<div class="field">
    <label class="label">Url</label>
    <p class="control">
        {!! Form::text( 'url', null, [ 'class' => 'input', 'v-model' => 'url', ':class' => '{ "is-danger": errors.has( "url" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('url')">@{{ errors.get('url') }}</p>
</div>

<div class="field">
    <label class="label">Description</label>
    <p class="control">
        {!! Form::textarea( 'description', null, [ 'class' => 'textarea', 'v-model' => 'description', ':class' => '{ "is-danger": errors.has( "description" ) }' ] ) !!}
    </p>
    <p class="help is-danger" v-if="errors.has('description')">@{{ errors.get('description') }}</p>
</div>