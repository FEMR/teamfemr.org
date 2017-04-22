@if( $errors->any() )
    <article class="message is-danger">
        <div class="message-header">
            <p><strong>Please fix the following errors and submit again</strong></p>
            <button class="delete"></button>
        </div>
        <div class="message-body">

            @foreach( $errors->all() as $error )
            <p>{{ $error }}</p>
            @endforeach

        </div>
    </article>
@endif