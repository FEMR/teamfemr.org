<div class="field">
    <label class="label">Title</label>
    <p class="control">
        {!! Form::text( 'title', null, [ 'class' => 'input', 'v-model' => 'title' ] ) !!}
    </p>
</div>

<div class="field">
    <label class="label">Url</label>
    <p class="control">
        {!! Form::text( 'url', null, [ 'class' => 'input', 'v-model' => 'url' ] ) !!}
    </p>
</div>

<div class="field">
    <label class="label">Description</label>
    <p class="control">
        {!! Form::textarea( 'description', null, [ 'class' => 'textarea', 'v-model' => 'description' ] ) !!}
    </p>
</div>