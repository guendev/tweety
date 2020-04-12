<template>
    <div class="row">
        <div class="user-meta col-auto">
            <div class="g_thumb circle">
                <img :src="avatar">
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
    import Form from "../../support/Form";
    export default {
        name: "Tweet",
        props: ['avatar'],
        data() {
            return {
                form: new Form({ content: '' }),
                newPost: ''
            }
        },

        methods: {
            onSubmit(){
                this.form.post('tweet/'+window.__user_id__)

                    .then((response) => {
                        this.newPost = response;
                        this.$emit('completed', status)
                    })
            }
        }
    }
</script>

<style scoped>

</style>
