@foreach( \FEMR\Data\Models\OutreachProgram::$default_fields as $key => $title )

    <div class="field">
        <label class="label">{{ $title }}</label>
        <p class="control">
            {!! Form::textarea( 'additional_fields[' . $key . ']', isset( $program ) ? $program->getAdditionalFieldValue( $key ) : null, [ 'class' => 'textarea' ] ) !!}
        </p>
    </div>

@endforeach