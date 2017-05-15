<div class="columns">

    <div class="column is-half">

        <div class="notification ">

            <div class="field">
                <label class="label">Title</label>
                <p class="control">
                    {!! Form::text( 'title', null, [ 'class' => 'input' ] ) !!}
                </p>
            </div>

            <div class="field">
                <label class="label">Url</label>
                <p class="control">
                    {!! Form::text( 'url', null, [ 'class' => 'input' ] ) !!}
                </p>
            </div>

            <div class="field">
                <label class="label">Description</label>
                <p class="control">
                    {!! Form::textarea( 'description', null, [ 'class' => 'textarea' ] ) !!}
                </p>
            </div>

            <div class="field is-grouped">
                <p class="control">
                    <button class="button is-primary">Submit</button>
                </p>
            </div>

        </div>

    </div>

</div>

