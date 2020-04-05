<div class="tweet-hastag">
    <ul class="list-hastag nav">
        @foreach($tweet->tags as $tag)
            <li class="hastag"><a href="#" class="hastag-link mr4">#{{ $tag->tag->tag }}</a></li>
        @endforeach
    </ul>
</div>
