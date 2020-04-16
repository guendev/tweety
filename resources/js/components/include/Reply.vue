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
                    @submit.prevent="submitReply()"
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
                        class="btn btn-primary px-2 py-1 br30 ml-auto text-white fs12 float-right clearfix"
                    >Reply</button>
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
            submitReply(){
                axios.post('/post-reply', {
                    content: this.form.content,
                    tweet_id: this.tweet_id
                }).then(() => {
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

</style>
