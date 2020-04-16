<template>
    <div
        class="site-header"
        :style="{ width: width + 'px' , left: left + 'px', height: users.length+tweets.length > 0 ? '100%' : ''}"
    >
        <transition-group
            name="headerx"
            tag="div"
            class="position-relative"
        >
            <div :key="isSearch" class="container position-absolute" v-if="!isSearch">
                <div
                    class="row bg-dark-1 h50 fs18 justify-content-between align-items-center"
                >
                    <div
                        class="col-auto"
                        v-if="$route.fullPath !== '/'"
                    >
                        <a
                            href="javascript:void(0)"
                            class="text-light"
                            @click="back()"
                        >
                            <svg class="fs24"><use xlink:href="#i-back"></use></svg>
                        </a>
                    </div>
                    <div class="text-light mr-auto col-auto d-flex flex-column">
                        <div class="site-name">{{ $route.fullPath === '/' ? 'Trang Chủ' : title === '' ? 'Back' : title }}</div>
                        <small
                            class="text-muted fs12 mb-2"
                            v-if="$route.fullPath !== '/' && title !== '' "
                        >{{ subHeader }}</small>
                    </div>

                    <div
                        class="col-auto ml-auto d-flex"
                    >
                        <a
                            href="javascript:void(0)"
                            class="text-primary mr-3"
                            @click="isSearch = !isSearch"
                        >
                            <svg class="fs22"><use xlink:href="#i-search"></use></svg>
                        </a>
                        <a
                            href="javascript:void(0)"
                            v-if="$route.fullPath === '/'"
                            class="text-primary"
                        >
                            <svg class="fs24"><use xlink:href="#i-reload"></use></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div :key="isSearch" v-else class="box_search position-absolute w-100">
                <div class="h50 bg-dark-1 search_form d-flex fs18 text-white align-items-center py-1 px-3 br10">
                    <svg class="fs22"><use xlink:href="#i-search"></use></svg>
                    <input v-model="search" class="w-100 ml20 text-white" placeholder="Tìm kiếm Twitter">
                    <a
                        href="javascript:void(0)"
                        class="text-primary ml-auto"
                        @click="isSearch = !isSearch"
                    >
                        <svg class="fs22"><svg><use xlink:href="#i-back"></use></svg></svg>
                    </a>
                </div>
                <div
                    class="result-box bg-dark-2 pt-2"
                >
                    <transition name="profilex">
                        <div
                            class="container pt-3 pb-2 bg-dark-1"
                            v-if="users.length > 0"
                        >
                            <div class="row list-friend">
                                <div
                                    v-for="friend in users"
                                    class=" col-3 col-md-2 justify-content-center align-items-center"
                                >
                                    <div class="g_thumb rounded-circle">
                                        <img :src="friend.avatar" :alt="friend.name">
                                    </div>
                                    <small class="text-muted mt-1">@{{friend.user_name}}</small>
                                </div>
                            </div>
                        </div>
                    </transition>
                    <transition name="profilex">
                        <div class="search-result mt-3"
                             v-if="tweets.length > 0"
                        >
                            <div
                                v-for="(tweet, index) in tweets"
                                class="news-feed-item d-flex bg-dark-1 mt-3 pt-2"
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
                        </div>
                    </transition>
                    <div class="search-overlay">
                    </div>
                </div>
            </div>
        </transition-group>
    </div>
</template>

<script>
    import { eventBus } from "../../app";
    import moment from "moment";
    export default {
        name: "Header",
        data() {
            return {
                title: '',
                subHeader: '',
                profile_url: new RegExp('^(/@)([a-zA-Z0-9])*$', 'i'),
                discover_url: new RegExp('^(/)(discovery)*$', 'i'),
                isSearch: false,
                width: '',
                left: '',
                search: '',
                users: [],
                tweets: [],
                wait: null,
                test: false
            }
        },
        methods: {
            formatTime($time){
                return moment($time).format("MM-DD-YYYY")
            },
            back(){
                if (history.back() !== undefined){
                    history.back()
                } else {
                    const current_url = this.$route.fullPath;
                    if (this.profile_url.test(current_url) || this.discover_url.test(current_url)){
                        window.location.href = '/';
                    }
                }
            },
            searchAction(){
                axios.get('/search', {
                    params: {
                        input: this.search
                    }
                }).then(({ data }) => {
                    if(data.error){
                        eventBus.$emit('noti', {
                            title: 'Search failed!'
                        })
                    } else {
                        this.users = data.data.user;
                        this.tweets = data.data.tweets;
                    }
                })
            }
        },
        created() {
            eventBus.$on('header-data', ($data) => {
                this.title = $data.title;
                this.subHeader = $data.subHeader
            });
            let el = $('.site-content');
            this.width = el.width();
            this.left = el.offset().left;
        },
        watch: {
            search(){
                if (this.search.split('').length > 1){
                    clearTimeout(this.wait);
                    this.wait = setTimeout(() => {
                        this.searchAction()
                    }, 500)
                } else {
                    this.users = this.tweets = [];
                }

            }
        }
    }
</script>

<style scoped>
    .box_search input::-webkit-input-placeholder, .box_search input{
        color: #ffffff;
        font-size: 15px;
        font-weight: 300;
    }
    .list-friend{
        min-height: 73px;
    }
    .search-result{
        min-height: 319px;
    }
    .bg-search .search-result {
        background: url(/img/theme/social.png) center no-repeat;
        background-size: contain;
    }
    .result-box>*+.search-overlay {
        position: absolute;
        width: 100%;
        height: -webkit-fill-available;
        background: #192734;
        opacity: 1;
        visibility: visible;
    }
    .search-overlay{
        opacity: 0;
        visibility: hidden;
    }
</style>
