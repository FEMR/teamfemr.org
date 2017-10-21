<?php

namespace FEMR\Http\Controllers\API;

use FEMR\Http\Controllers\Controller;
use FEMR\Http\Requests\API\SlackInviteRequest;

class SlackInviteController extends Controller
{
    /**
     * Sends a post to the Slack API inviting the user to join
     *
     * Note: This uses an "undocumented" Slack API method
     *
     * https://github.com/ErikKalkoken/slackApiDoc/blob/master/users.admin.invite.md
     *
     *
     * @param SlackInviteRequest $request
     *
     * @return mixed
     */
    public function create( SlackInviteRequest $request )
    {

        $t = time();

        $url = 'https://femr.slack.com/api/users.admin.invite?t=' . $t;
        $fields = $request->all();
        // TODO -- these need to be channel id -- not channel name. Figure out how to get the channel id
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
