<template>
    <div class="profile-action text-right mt-2 d-flex">

        <a v-if="user_can"
                class="btn btn-outline-primary font-weight-bold text-primary br30"
                @click="editProfile()"
        >Edit Profile </a>

        <form
            v-if="!user_can"
            class="ml-2"
            @submit.prevent="followAction"
        >
            <button
                class="btn btn-outline-primary font-weight-bold text-primary br30"
            >
                {{ following ? 'Unfollow' : 'Follow' }}
            </button>

        </form>
        <form-edit-profile
            v-if="is_editting"
        ></form-edit-profile>
    </div>
</template>

<script>
    export default {
        name: "ProfileAction",
        props:['user_can', 'is_following'],
        data() {
            return {
                current_user: parseInt(window.__user_id__),
                following: this.is_following,
                is_editting: false
            }
        },
        methods: {
            followAction(){
                axios.post( '/'+this.data.user_name+'/follow')
                        .then((response) => {
                            this.following = response.data.isfollow
                        })
            },
            editProfile(){
                this.is_editting = !this.is_editting;
            }
        }
    }
</script>

<style scoped>
    .btn-outline-primary:hover {
        background: unset;
    }
</style>
