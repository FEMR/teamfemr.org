@if( isset( $admin_message ) )
<section class="section section-message">
    <div class="wrapper">
        <div class="notification {{ $admin_message->type }}">

            <button class="delete"></button>
            {{ $admin_message->message }}

        </div>
    </div>
</section>
@endif