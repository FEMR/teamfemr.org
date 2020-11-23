<section class="hero is-dark news-hero">
    <div class="hero-body">
        <div id="news" class="container">

            <div class="columns">

                <div class="column">

                    <h2 class="title">
                        Featured News
                    </h2>

                    <carousel
                        :per-page="1"
                        :per-page-custom="[[768,2],[1024, 4]]"
                    >

                        @foreach( $featured_news as $news )
                            <slide class="news-item">

                                <figure class="image is-16by9">
                                    <a href="{{ $news->url }}" target="_blank">
                                        <img src="{{ Storage::url($news->thumbnail) }}" alt="{{ $news->thumbnail_alt }}" />
                                    </a>
                                </figure>
                                <h3 class="headline">
                                    <a href="{{ $news->url }}" target="_blank">
                                        {{ $news->title }}
                                    </a>
                                </h3>

                            </slide>
                        @endforeach

                        {{--<slide class="news-item">--}}

                            {{--<figure class="image is-16by9">--}}
                                {{--<a href="http://www.crainsdetroit.com/article/20180708/news/665511/wayne-state-students-develop-electronic-medical-record-used-by" target="_blank">--}}
                                    {{--<img src="{{ asset( "/images/news/nabil-othman-femr.jpg" ) }}" alt="Doctors and students using fEMR" />--}}
                                {{--</a>--}}
                            {{--</figure>--}}
                            {{--<h3 class="headline">--}}
                                {{--<a href="http://www.crainsdetroit.com/article/20180708/news/665511/wayne-state-students-develop-electronic-medical-record-used-by" target="_blank">--}}
                                    {{--Wayne State students develop electronic medical record used by international missions--}}
                                {{--</a>--}}
                            {{--</h3>--}}

                        {{--</slide>--}}

                        {{--<slide class="news-item">--}}

                            {{--<figure class="image is-16by9">--}}
                                {{--<a href="http://michiganradio.org/post/medical-records-platform-designed-detroit-offers-new-tool-humanitarian-aid-work" target="_blank">--}}
                                    {{--<img src="{{ asset( "/images/news/stateside-radio.png" ) }}" alt="Doctors and students using fEMR" />--}}
                                {{--</a>--}}
                                {{--<iframe src="https://www.youtube.com/embed/Zppwhc2vHgo" style="height: 100%; width: 100%; bottom: 0; left: 0; position: absolute; right: 0; top: 0;" frameborder="0" allowfullscreen></iframe>--}}
                            {{--</figure>--}}
                            {{--<h3 class="headline">--}}
                                {{--<a href="http://michiganradio.org/post/medical-records-platform-designed-detroit-offers-new-tool-humanitarian-aid-work" target="_blank">--}}
                                    {{--Team fEMR on Stateside on Michigan Radio--}}
                                {{--</a>--}}
                            {{--</h3>--}}

                        {{--</slide>--}}

                        {{--<slide class="news-item">--}}

                            {{--<figure class="image is-16by9">--}}
                                {{--<a href="http://www.youtube.com/watch?v=Zppwhc2vHgo" target="_blank">--}}
                                    {{--<img src="{{ asset( "/images/news/wsu-promo.png" ) }}" alt="Doctors and students using fEMR" />--}}
                                {{--</a>--}}
                                {{--<iframe src="https://www.youtube.com/embed/Zppwhc2vHgo" style="height: 100%; width: 100%; bottom: 0; left: 0; position: absolute; right: 0; top: 0;" frameborder="0" allowfullscreen></iframe>--}}
                            {{--</figure>--}}
                            {{--<h3 class="headline">--}}
                                {{--<a href="http://www.youtube.com/watch?v=Zppwhc2vHgo" target="_blank">--}}
                                    {{--Wayne State University promo campaign video featuring fEMR--}}
                                {{--</a>--}}
                            {{--</h3>--}}

                        {{--</slide>--}}

                        {{--<slide class="news-item">--}}

                            {{--<figure class="image is-16by9">--}}
                                {{--<a href="http://www.clickondetroit.com/news/live-in-the-d/detroit-college-students-aim-to-help-haiti-earthquake-victims/24959282" target="_blank">--}}
                                    {{--<img src="{{ asset( "/images/news/femr-live-in-the-d.png" ) }}" alt="Doctors and students using fEMR" />--}}
                                {{--</a>--}}
                            {{--</figure>--}}
                            {{--<h3 class="headline">--}}
                                {{--<a href="http://www.clickondetroit.com/news/live-in-the-d/detroit-college-students-aim-to-help-haiti-earthquake-victims/24959282" target="_blank">--}}
                                    {{--Live in the D, WDIV Detroit, news segment, "Detroit college students aim to help Haiti earthquake victims"--}}
                                {{--</a>--}}
                            {{--</h3>--}}

                        {{--</slide>--}}

                        {{--<slide class="news-item">--}}

                            {{--<figure class="image is-16by9">--}}
                                {{--<a href="http://www.emrandehr.com/tag/emergency-ehr/" target="_blank">--}}
                                    {{--<img src="{{ asset( "/images/news/doctor.png" ) }}" alt="Doctors and students using fEMR" />--}}
                                {{--</a>--}}
                            {{--</figure>--}}
                            {{--<h3 class="headline">--}}
                                {{--<a href="http://www.emrandehr.com/tag/emergency-ehr/" target="_blank">--}}
                                    {{--EMR & EHR Forum, Review by field expert, "fEMR targets pop-up clinics' needs"--}}
                                {{--</a>--}}
                            {{--</h3>--}}

                        {{--</slide>--}}

                        {{--<slide class="news-item">--}}

                            {{--<figure class="image is-16by9">--}}
                                {{--<a href="https://www.med.wayne.edu/news/2013/04/11/wsu-computer-science-students-open-source-software-benefits-school-of-medicine-mission-trips/" target="_blank">--}}
                                    {{--<img src="{{ asset( "/images/news/sarah.png" ) }}" alt="Doctors and students using fEMR" />--}}
                                {{--</a>--}}
                            {{--</figure>--}}
                            {{--<h3 class="headline">--}}
                                {{--<a href="https://www.med.wayne.edu/news/2013/04/11/wsu-computer-science-students-open-source-software-benefits-school-of-medicine-mission-trips/" target="_blank">--}}
                                    {{--Wayne State University SOM Prognosis E-news, "WSU computer science students'     open source software benefits School of Medicine mission trips"--}}
                                {{--</a>--}}
                            {{--</h3>--}}

                        {{--</slide>--}}

                    </carousel>

                </div>

            </div>

        </div>
    </div>
</section>