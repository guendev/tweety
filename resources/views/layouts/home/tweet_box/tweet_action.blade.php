

<div class="tweet-action-group fs16 mt-2 d-flex">
    <div class="w-25">
        <a href="" class="tweet-action-link br20_hover text-muted">
            <svg>
                <use xlink:href="#i-comment"></use>
            </svg>
            <span class="count fs14">{{ $tweet->reply->count() }}</span>
        </a>
    </div>
    <div class="w-25">
        <a href="" class="tweet-action-link br20_hover text-muted">
            <svg>
                <use xlink:href="#i-retweet"></use>
            </svg>
            <span class="count fs14">{{$tweet->count_retweet}}</span>
        </a>
    </div>
    <div class="w-25">
        <a href="" class="tweet-action-link br20_hover text-muted">
            <svg>
                <use xlink:href="#i-love"></use>
            </svg>
            <span class="count fs14">{{$tweet->count_like}}</span>
        </a>
    </div>
    <div class="w-25">
        <a href="" class="tweet-action-link br20_hover text-muted">
            <svg>
                <use xlink:href="#i-share"></use>
            </svg>
            <span class="count fs14">{{$tweet->count_share}}</span>
        </a>
    </div>
</div>
