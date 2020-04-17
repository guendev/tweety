<template>
    <div class="tweet-reply-box pt-2 position-relative bg-dark-2">
        <div class="d-flex bg-dark-1 py-2">
            <div class="user-meta col-auto mt-2">
                <div class="g_thumb circle">
                    <img
                        :src="current_user.avatar ? current_user.avatar : '/img/theme/avatar-default.jpg'"
                        :alt="current_user.name"
                    >
                </div>
            </div>
            <div class="tweet-box col w-auto pl-0 mt-2">
                <form
                    method="post"
                    class="submitReply"
                    @submit.prevent="submitReply($event)"
                >
                <textarea
                    name="content"
                    class="w-100 text-white"
                    v-model="form.content"
                    :placeholder="'Let\'s say ' + current_user.name +' !'"
                    required
                ></textarea>
                    <button
                        type="submit"
                        class="btn btn-primary position-relative px-2 py-1 br30 ml-auto text-white fs12 float-right clearfix"
                    >
                        <span>Reply</span>
                        <span class="d-block loading">
                                <span class="effect-1 effects"></span>
                                <span class="effect-2 effects"></span>
                                <span class="effect-3 effects"></span>
                            </span>
                        <span class="ra-center upsuccess">
                                <svg><use xlink:href="#i-check"></use></svg>
                            </span>
                        <span class="ra-center upfailed">
                                <svg><use xlink:href="#i-close"></use></svg>
                            </span>
                    </button>
                    <a
                        class="btn bg-dark px-2 py-1 br30 ml-auto text-white fs12 float-right clearfix mr-2"
                        @click="$emit('closeReplies')"
                    >Back</a>
                </form>
            </div>
        </div>

        <transition-group
            name="headerx"
            tag="div"
        >
            <div
                v-for="(reply, index) in replies"
                class="my-1"
                :key="index+1"
            >
                <div class="news-feed-item d-flex bg-dark-1 my-1 pt-2 py-2">
                    <div class="user-meta col-auto">
                        <div class="g_thumb circle">
                            <img
                                :alt="reply.author_name"
                                :src="reply.author_avatar"
                            >
                        </div>
                    </div>
                    <div class="tweet-box col w-auto pl-0">
                        <div class="tweet-title">
                            <h5>
                                <a
                                    :href="'/@' + reply.author_user_name "
                                    class="text-white fs16"
                                >{{ reply.author_name }}</a>
                                <a class="text-muted fs14 ml4">
                                    <i class="mr4 fs12">. {{ formatTime(reply.created_at) }} </i>
                                </a>
                            </h5>
                        </div>
                        <div class="tweet-content">
                            <div class="tweet-des text-white font-weight-light">{{ reply.content }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </transition-group>
    </div>
</template>

<script>
    import moment from "moment";
    import UploadUi from "../../utils/UploadUi";
    export default {
        name: "Reply",
        props:['tweet_id'],
        data() {
            return {
                replies: [],
                current_user: [],
                form: {
                    content: ''
                }
            }
        },
        created() {
            axios.get('/current_user').then(
                ({ data }) => {
                    this.current_user = data
                }
            );
            axios.get('/get-reply', {
                params: {
                    tweet_id: this.tweet_id
                }
            })
            .then(({ data }) => {
                this.replies.push(...data)
            })
        },
        methods: {
            formatTime($time){
                return moment($time).format("MM-DD-YYYY")
            },
            submitReply($event){
                console.log($event);
                let $el = UploadUi.addClassBeforeProcess('.'+$event.target.className);
                console.log($el);
                axios.post('/post-reply', {
                    content: this.form.content,
                    tweet_id: this.tweet_id
                }).then(({ data }) => {
                    UploadUi.uploadProcess(data.error, $el);
                    this.replies.unshift({
                        author_avatar: this.current_user.avatar,
                        author_name: this.current_user.name,
                        author_user_name: this.current_user.user_name,
                        content: this.form.content
                    });
                    this.form.content = '';
                    this.$emit('reply');
                })
            },
        }
    }
</script>

<style scoped>
    .btn[type="submit"]{
        height: 29px;
        min-width: 48.5px;
    }
    .loading {
        height: 20px;
        width: 20px;
    }
    .loading .effect-1, .loading .effect-2, .loading .effect-3 {
        border-left: 3px solid #ffffff;
    }
</style>
