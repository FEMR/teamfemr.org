<div class="field">
    <label class="label">Name</label>
    <p class="control">
        {!! Form::text( 'name', null, [ 'class' => 'input' ] ) !!}
    </p>
</div>

<div class="columns">
    <div class="column is-half">

        <div class="field">
            <label class="label">Uses an EMR</label>
            <p class="control">
            <span class="select">
              {!! Form::select( 'uses_emr', [ 1 => 'Yes', 0 => 'No' ], null ) !!}
            </span>
            </p>
        </div>

    </div>
    <div class="column is-half">

        <div class="field">
            <label class="label">Year Initiated</label>
            <p class="control">
                {!! Form::text( 'year_initiated', null, [ 'class' => 'input' ] ) !!}
            </p>
        </div>

    </div>
</div>

<div class="columns">
    <div class="column is-half">

        <div class="field">
            <label class="label">Participants per year</label>
            <p class="control">
                {!! Form::text( 'yearly_outreach_participants', null, [ 'class' => 'input' ] ) !!}
            </p>
        </div>

    </div>
    <div class="column is-half">

        <div class="field">
            <label class="label">Matriculants per class</label>
            <p class="control">
                {!! Form::text( 'matriculants_per_class', null, [ 'class' => 'input' ] ) !!}
            </p>
        </div>

    </div>
</div>

<div class="field">
    <label class="label">Classes</label>
    <p class="control">
        <span class="select is-fullwidth select2-wrapper">
            {!! Form::select( 'school_classes[]', $school_classes, null, [ 'multiple', 'class' => 'select2' ] ) !!}
        </span>
    </p>
</div>

<div class="field is-grouped">
    <p class="control">
        <button class="button is-primary">Submit</button>
    </p>
</div>
