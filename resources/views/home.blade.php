@extends ('layouts.app')

@section('content')

    <h1>HOME</h1>

    <div class="content_top">
        <h1>A fast EMR solution for transient medical teams.</h1>
        <p>We are using open source technology to promote data driven communciation in low resource settings.</p>
        <a class="button" href="./other/Annual_Report_2014_2015.pdf">First Annual Report</a>
    </div>

    <div class="content_top slack-info">

        <h2>Slack</h2>

        <p>Interested in development? Join the fEMR discussion in our slack chat! </p>

        <a class="button slack-button" href="/slack.html">Join Our Slack!</a>
    </div>

    <div class="content_middle">
        <div class="tiles">
            <div class="tiles_firstrow">
                <div class="tile1">
                    <h2>Team fEMR!</h2>
                    <div class="tileContent">
                        <img src="/images/screenshots/team_femr.png" alt="Team fEMR">
                        <p>We are students, doctors, and engineers. More importantly we are volunteers helping to provide the best healthcare possible to people who are often without access to life's basic necessities.</p>
                    </div>
                </div>
                <div class="tile2">
                    <h2>Who is fEMR for?</h2>
                    <div class="tileContent">
                        <img src="/images/screenshots/who_is_femr_for.png" alt="Who is fEMR for">
                        <p>We have designed fEMR for transient medical teams who need a fast and easy way to record patient information. Most of our users work in settings with limited infrastructure.</p>
                    </div>
                </div>
            </div>
            <div class="tiles_secondrow">
                <div class="tile3">
                    <h2>Open Source</h2>
                    <div class="tileContent">
                        <img src="/images/screenshots/open_source.png" alt="Open Source">
                        <p>fEMR is both free and open source. As a responsive web application, it can be used on any smart device.</p>
                        <a href="https://github.com/femr/femr" target="_blank" class="devButton" id="home_repoBtn">Repository</a>
                        <a href="https://groups.google.com/forum/?utm_medium=email&utm_source=footer#!forum/team-femr" target="_blank" class="devButton" id="home_repoBtn">Mailing List</a>
            <a href="https://teamfemr.atlassian.net" target="_blank" class="devButton" id="jiraButton">Backlog</a>
                        <a href="/slack.html" target="_blank" class="devButton" id="slackButton">Slack</a>
                        <!-- <a class="devButton" id="ircButton">IRC</a> -->
                    </div>
                </div>
                <div class="tile4">
                    <h2>Demo</h2>
                    <div class="tileContent">
                        <img src="/images/screenshots/demo.png" alt="Demo">
                        <p>
                            We currently have a development version of fEMR available for testing <a href="http://femr.teamfemr.org">here.</a>
                            <span id="username">Username: visitor</span>
                            <span id="password">Password: femr1</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content_bottom">

    </div>

@endsection
