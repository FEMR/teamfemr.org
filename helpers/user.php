<?php

if( ! function_exists( 'user_token' ) )
{
    /**
     * Get the user token value.
     *
     * @return string
     */
    function user_token()
    {
        if( auth()->check() ) return auth()->user()->getAttribute( 'api_token' );
        return 'guest';
    }
}