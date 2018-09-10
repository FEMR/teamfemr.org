<section class="hero has-text-centered publications-hero" id="publications" >
    <div class="hero-body">
        <div class="container">

            <div class="content docs">

                <h2 class="title">
                    Publications
                </h2>

                <ul>

                    @foreach( $publications as $publication )
                        <li class="doc">

                            <article class="media">
                                <figure class="media-left">
                                    <p>
                                        <a href="{{ Storage::url($publication->file) }}" target="_blank">
                                                <span class="icon">
                                                  <i class="fa fa-file-pdf-o"></i>
                                                </span>
                                        </a>
                                    </p>
                                </figure>
                                <div class="media-content">
                                    <div class="content">
                                        <p>
                                            <a href="{{ Storage::url($publication->file) }}" target="_blank">
                                                <strong>{{ $publication->name }}</strong>
                                                <br>
                                                {{ $publication->description }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </article>

                        </li>
                    @endforeach

                </ul>

            </div>

        </div>
    </div>
</section>