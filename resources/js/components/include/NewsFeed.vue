<template>
    <div class="tweet-box position-relative">
        <div
            v-for="(tweet, index) in tweetsData"
            class="news-feed-item d-flex bg-dark-1 my-2 pt-2"
            :class=" tweet.repling ? '_replying' : '' + ' tweet-' + tweet.id + ' author-' + tweet.author_id "
        >
            <div class="user-meta col-auto">
                <div class="g_thumb circle">
                    <img
                        :alt="tweet.author_name"
                        :src="tweet.author_avatar ? tweet.author_avatar : '/img/theme/avatar-default.jpg'"
                    >
                </div>
            </div>
            <div class="tweet-box col w-auto pl-0">
                <div class="tweet-title">
                    <h5>
                        <a class="text-white fs16" :href="'/@'+tweet.author_user_name">{{ tweet.author_name }}</a>
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
                                <a href="#" class="hashtag-link text-primary mr4">#{{ tag.tag }}</a>
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

                    <div class="tweet-action-group fs16 mt-2 d-flex pb-1">
                        <div class="count_cmt w-25 d-flex align-items-center text-muted">
                            <a
                                href="javascript:void(0)"
                                class="tweet-action-link mr4 text-muted br20_hover"
                                @click="replies(tweet, index)"
                                ref="openReplies"
                            >
                                <svg>
                                    <use xlink:href="#i-comment"></use>
                                </svg>
                            </a>
                            <span class="count fs14 mr-auto">{{ tweet.count_comment }}</span>
                        </div>
                        <div class="count-retweet w-25 d-flex align-items-center text-muted">
                            <a href="javascript:void(0)" class="tweet-action-link mr4 text-muted br20_hover">
                                <svg>
                                    <use xlink:href="#i-retweet"></use>
                                </svg>
                            </a>
                            <span class="count fs14">{{ tweet.count_retweet }}</span>
                        </div>
                        <div class="count-like w-25 d-flex align-items-center text-muted">
                            <a
                                href="javascript:void(0)"
                                class="tweet-action-link mr4 text-muted position-relative"
                                @click="like(tweet)"
                            >
                                <div class="heart position-absolute"
                                     :class="(tweet.is_like && tweet.like_status) ? '_liked _like_Animation' : tweet.is_like ? '_liked' : '' "
                                ></div>
                            </a>
                            <span class="count fs14 ml-2">{{ tweet.count_like }}</span>
                        </div>
                        <div class="count-share w-25 d-flex align-items-center text-muted">
                            <a href="javascript:void(0)" class="tweet-action-link mr4 text-muted br20_hover">
                                <svg>
                                    <use xlink:href="#i-share"></use>
                                </svg>
                            </a>
                            <span class="count fs14">{{ tweet.count_share }}</span>
                        </div>
                    </div>
                    <reply
                        v-if="tweet.repling"
                        :tweet_id="tweet.id"
                        @closeReplies="tweet.repling = false"
                    ></reply>
                </div>
            </div>
        </div>
        <infinite-loading
            @infinite="infiniteHandler"
            ref="infiniteLoading">
        </infinite-loading>
    </div>
</template>
<script>
    import moment from 'moment';
    import InfiniteLoading from 'vue-infinite-loading';
    import routes from "../../routes";
    import { eventBus } from "../../app";

    export default {
       name: "NewsFeed",
        props:['tweets'],
        components: {
            InfiniteLoading
        },
        data() {
            return {
                tweetsData: JSON.parse(this.tweets),
                page: 1
            }
        },
        methods: {
           formatTime($time){
               return moment($time).format("MM-DD-YYYY")
           },
            infiniteHandler($state) {
                let url = '';
                let user = '';
               if (this.$route.fullPath === '/'){
                   url = '/getmore'
               } else {
                   url = '/tweets/loadmore';
                   try {
                       user =  this.tweetsData[0].id;
                   } catch (e) {
                       user = -1;
                   }
               }
                axios.get( url, {
                    params: {
                        user_id: user,
                        page: this.page,
                    },
                }).then(({ data }) => {
                    if (data.length > 0) {
                        this.page += 1;
                        this.tweetsData.push(...data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                });
            },
            replies(tweet, index){
                $('html, body').animate({
                    scrollTop: $(this.$refs.openReplies[index]).closest('.news-feed-item').offset().top - 55
                }, 500);
               tweet.repling = true;
            },
            like(tweet){
                axios.get('/tweet/like-tweet', {
                    params: {
                        tweet_id: tweet.id
                    }
                }).then(({ data }) => {
                    tweet.is_like = tweet.like_status = data.data;
                    if (tweet.is_like){
                        tweet.count_like += 1;
                    } else {
                        tweet.count_like -= 1;
                    }
                })
            }
        },
        created() {
           eventBus.$on('add-tweet', ($data) => {
               this.tweetsData.unshift($data)
           })
        }
    }
</script>

<style scoped>

</style>
