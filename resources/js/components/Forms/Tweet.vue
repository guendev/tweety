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
                id="tweet-form"
                @submit.prevent="onSubmit($event.target.id)"
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
                        class="btn btn-primary px-3 py-1 br30 ml-auto text-white position-relative fs14"
                    >
                        <span>Tweet</span>
                        <span class="d-block loading">
                                <span class="effect-1 effects"></span>
                                <span class="effect-2 effects"></span>
                                <span class="effect-3 effects"></span>
                            </span>
                        <span class="ra-center upsuccess d-flex justify-content-center align-items-center">
                                <svg><use xlink:href="#i-check"></use></svg>
                            </span>
                        <span class="ra-center upfailed d-flex justify-content-center align-items-center">
                                <svg><use xlink:href="#i-close"></use></svg>
                            </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</template>

<script>
    import { eventBus } from "../../app";
    import UploadUi from "../../utils/UploadUi";
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
            onSubmit($id){
                let $el = UploadUi.addClassBeforeProcess('#'+$id);
                axios.post('tweet/'+window.__user_id__, {
                    content: this.form.content
                })
                    .then( ({ data }) => {
                        UploadUi.uploadProcess(data.error, $el);
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
    span.loading {
        width: 30px;
        height: 30px;
    }
    .loading .effect-1, .loading .effect-2, .loading .effect-3 {
        border-left: 3px solid #ffffff;
    }
</style>
