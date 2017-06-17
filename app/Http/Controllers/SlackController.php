<?php

namespace FEMR\Http\Controllers;

use FEMR\Http\Requests\SlackRequest;

class SlackController extends Controller
{
    /**
     * @param SlackRequest $request
     *
     * @return mixed
     */
    public function invite( SlackRequest $request )
    {
        $t = time();

        $url = 'https://femr.slack.com/api/users.admin.invite?t=' . $t;
        $fields = $request->all();
//        $auto_join_channels = 'code,random,meetup';

        $fields['scope'] = 'admin+client';
        $fields['set_active'] = true;
//        $fields['channels'] = urlencode( $auto_join_channels );
        $fields['client_id'] = env( 'SLACK_CLIENT_ID' );
        $fields['team_id'] = env( 'SLACK_TEAM_ID' );
        $fields['token'] = env( 'SLACK_INVITE_TOKEN' );

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }
}
