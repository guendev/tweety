<template>
    <div class="profile-action text-right mt-2 d-flex">
        <a v-if="user_can"
           :href="$route.path+'/edit'"
        >
            <button
                class="btn btn-outline-primary font-weight-bold text-primary br30"
            >Edit Profile</button>

        </a>
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
    </div>
</template>

<script>
    export default {
        name: "ProfileAction",
        props:['profile_data','user_can', 'is_following'],
        data() {
            return {
                data: JSON.parse(this.profile_data),
                is_edit: false,
                current_user: parseInt(window.__user_id__),
                following: this.is_following
            }
        },
        methods: {
            followAction(){
                axios.post( '/'+this.data.name+'/follow')
                        .then((response) => {
                            this.following = response.data.isfollow
                        })
            }
        }
    }
</script>

<style scoped>
    .btn-outline-primary:hover {
        background: unset;
    }
</style>
