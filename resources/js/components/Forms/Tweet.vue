<template>
    <div class="row">
        <div class="user-meta col-auto">
            <div class="g_thumb circle">
                <img :src="avatar ? avatar : '/img/theme/avatar-default.jpg'">
            </div>
        </div>
        <div class="tweet-box col w-auto pl-0">
            <form
                method="post"
                @submit.prevent="onSubmit"
            >
                <textarea
                    name="content"
                    class="w-100 text-white"
                    placeholder="What's up ?"
                    v-model="form.content"
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

</template>

<script>
    import { eventBus } from "../../app";

    export default {
        name: "Tweet",
        props: ['avatar'],
        data() {
            return {
                form: {
                    content: ''
                },
                newPost: ''
            }
        },

        methods: {
            onSubmit(){
                axios.post('tweet/'+window.__user_id__, {
                    content: this.form.content
                })
                    .then( ({ data }) => {
                        if (data.error){
                            eventBus.$emit('noti', {
                                title: data.msg,
                                content: 'Please try again !'
                            })
                        } else {
                            eventBus.$emit('add-tweet', data.data[0]);
                            eventBus.$emit('noti', {
                                title: data.msg,
                                content: 'Your tweet has been post !'
                            });
                            this.form.content = ''
                        }
                    })
            }
        }
    }
</script>

<style scoped>

</style>
