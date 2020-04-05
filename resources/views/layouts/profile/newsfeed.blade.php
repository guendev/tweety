<div class="tweet-form">
    @foreach($user->tweets as $tweet)
    <div class="news-feed-item d-flex bg-dark-1 my-2 pt-2">
            <div class="user-meta col-auto">
                <div class="g_thumb circle">
                    <a href="{{ route('profile', $user) }}"><img src="{{ $user->avatar }}"></a>
                </div>
            </div>
            <div class="tweet-box col w-auto pl-0">
                <div class="tweet-title">
                    <h5><a class="text-white fs16" href="{{ route('profile', $user) }}">{{$user->name}}</a><a class="text-muted fs14 ml4"><i class="mr4">.</i>{{$tweet->created_at->format('d-m-Y')}}</a></h5>
                </div>
                <div class="tweet-content">
                    <div class="tweet-des text-white">
                        {{$tweet->content}}
                    </div>

                    @include('layouts.home.tweet_box.tag_list')

                    @if($tweet->attr)
                        <div class="tweet-attr mt-2">
                            <div class="tweet-img">
                                <div class="g_thumb w-100 br10">
                                    <img src="/img/tweet/img-1.jpeg">
                                </div>
                            </div>
                        </div>
                    @endif
                    @include('layouts.home.tweet_box.tweet_action')
                </div>
            </div>
    </div>
    @endforeach
</div>
