<div class="tweet-form py-2 mt-2 mb-3 bg-dark-1">
    <div class="container">
        <div class="row">
            <div class="user-meta col-auto">
                <div class="g_thumb circle">
                    <img src="{{current_user()->avatar}}">
                </div>
            </div>
            <div class="tweet-box col w-auto pl-0">
                <form
                    method="post"
                    action="{{ route('tweet', ['id' => current_user()->id]) }}"
                >
                    @csrf
                    <textarea
                        name="content"
                        class="w-100 text-white"
                        placeholder="What's up ?"
                        required
                    ></textarea>
                    <div class="form-action align-items-center d-flex text-primary fs26">
                        <a class="px-3 pb-1 mr8 hover-bg br30_hover">
                            <svg><use xlink:href="#i-image"></use></svg>
                        </a>
                        <a class="px-3 pb-1 mr8 hover-bg br30_hover">
                            <svg><use xlink:href="#i-gift"></use></svg>
                        </a>
                        <a class="px-3 pb-1 mr8 hover-bg br30_hover">
                            <svg><use xlink:href="#i-icon"></use></svg>
                        </a>
                        <button
                            type="submit"
                            class="btn btn-primary px-3 py-1 br30 ml-auto text-white fs14"
                        >Tweet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
