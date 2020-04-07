<template>
    <div class="tweet-box position-relative">
        <div
            class="news-feed-item d-flex bg-dark-1 my-2 pt-2"
             :class="'tweet-id-'+tweet.id+' author-id-'+tweet.author_id"
            v-for="(tweet, index) in tweetsData"
        >
                <div class="user-meta col-auto">
                    <div class="g_thumb circle">
                        <img :src="tweet.author_avatar">
                    </div>
                </div>

                <div class="tweet-box col w-auto pl-0">
                    <div class="tweet-title">
                        <h5>
                            <a class="text-white fs16" :href="'tweets/'+tweet.author_name">{{ tweet.author_name }}</a>
                            <a class="text-muted fs14 ml4"><i class="mr4 fs12">. {{ formatTime(tweet.created_at) }} </i></a>
                        </h5>
                    </div>

                    <div class="tweet-content">
                        <div class="tweet-des text-white">
                            {{ tweet.content }}
                        </div>
                        <div class="tweet-hashtag">
                            <ul class="list-hashtag nav">
                                <li v-for="( tag , index) in tweet.tags" :key="index">
                                    <a href="#" class="hashtag-link mr4">#{{ tag.tag.tag }}</a>
                                </li>
                            </ul>
                        </div>

                       <!-- <div class="tweet-attr mt-2">
                            <div class="tweet-img">
                                <div class="g_thumb w-100 br10">
                                    <img src="/img/tweet/img-1.jpeg">
                                </div>
                            </div>
                        </div>-->

                        <div class="tweet-action-group fs16 mt-2 d-flex">
                            <div class="w-25">
                                <a href="" class="tweet-action-link br20_hover text-muted">
                                    <svg>
                                        <use xlink:href="#i-comment"></use>
                                    </svg>
                                    <span class="count fs14">{{ tweet.count_comment }}</span>
                                </a>
                            </div>
                            <div class="w-25">
                                <a href="" class="tweet-action-link br20_hover text-muted">
                                    <svg>
                                        <use xlink:href="#i-retweet"></use>
                                    </svg>
                                    <span class="count fs14">{{ tweet.count_retweet }}</span>
                                </a>
                            </div>
                            <div class="w-25">
                                <a href="" class="tweet-action-link br20_hover text-muted">
                                    <svg>
                                        <use xlink:href="#i-love"></use>
                                    </svg>
                                    <span class="count fs14">{{ tweet.count_like }}</span>
                                </a>
                            </div>
                            <div class="w-25">
                                <a href="" class="tweet-action-link br20_hover text-muted">
                                    <svg>
                                        <use xlink:href="#i-share"></use>
                                    </svg>
                                    <span class="count fs14">{{ tweet.count_share }}</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
        <infinite-loading
            v-if="is_loading"
            @infinite="infiniteHandler"
            ref="infiniteLoading">
        </infinite-loading>
        <div v-else
             class="news-feed-item d-flex bg-dark-1 my-2 py-3"
        >
            <p class="text-muted mx-auto">Nothing Here :))</p>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import InfiniteLoading from 'vue-infinite-loading';
    export default {
       name: "NewsFeed",
        props:['tweets'],
        components: {
            InfiniteLoading
        },
        data() {
            return {
                tweetsData: JSON.parse(this.tweets),
                tweets_data: '',
                author: {
                    name: '',
                    avatar: '',
                },
                page: 1,
                is_loading: true
            }
        },
        methods: {
           formatTime($time){
               return moment($time).format("MM-DD-YYYY")
           },
            infiniteHandler($state) {
                axios.get('/getmore', {
                    params: {
                        page: this.page,
                    },
                }).then(({ data }) => {
                    if (data.data.length > 0) {
                        this.page += 1;
                        this.tweetsData.push(...data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                        this.is_loading = false;
                    }
                });
            },
        }
    }
</script>

<style scoped>

</style>
