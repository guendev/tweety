<template>
    <transition v-if="!is_editting && user_can" name="profilex">
        <form-edit-profile
            :userid="user_data.id"
            :is_edit="is_editting"
            @back="updatedProfile"
        ></form-edit-profile>
    </transition>
    <transition v-else name="profilex">
        <div
            class="profile-info"
        >
            <div class="profile-cover">
                <div class="container bg-black overflow-hidden px-0">
                    <div class="g_thumb">
                        <img :alt="user_data.name" :src="user_data.cover ? user_data.cover : '/img/theme/tweety.jpg'">
                    </div>
                </div>
            </div>
            <div class="profile-meta">
                <div class="container">
                    <div class="row">
                        <div class="col-4 position-relative">
                            <div class="profile-avatar rounded-circle overflow-hidden">
                                <a href="">
                                    <img class="img_100" :alt="user_data.name" :src="user_data.avatar ? user_data.avatar : '/img/theme/avatar-default.jpg'">
                                </a>
                            </div>
                        </div>

                        <div class="col">
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
                            </div>
                        </div>


                        <div class="col-12 mt-2">
                            <div class="profile-info">
                                <div class="profile-info-item">
                                    <h4 class="font-weight-bold fs26 text-white mb-0">{{ user_data.name }}</h4>
                                    <p class="text-muted">ID: {{ user_data.id }}</p>
                                </div>
                                <div class="profile-info-item">
                                    <p class="text-white">{{ user_data.story }}</p>
                                </div>
                                <div class="profile-info-item my-2 d-flex">
                                    <div class="w-50 text-muted">
                                        <svg class="fs20">
                                            <use xlink:href="#i-location"></use>
                                        </svg>
                                        <span>{{ user_data.local }}</span>
                                    </div>
                                    <div class="w-50 text-muted">
                                        <svg class="fs20">
                                            <use xlink:href="#i-time"></use>
                                        </svg>
                                        <span>Đã tham gia từ {{ formatTime(user_data.created_at) }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-item my-2 text-white d-inline-flex">
                                    <div class="mr-3">
                                        <span>{{ follow_data.count_following }}</span>
                                        <span class="text-muted">Following</span>
                                    </div>
                                    <div>
                                        <span>{{ follow_data.count_follower }}</span>
                                        <span class="text-muted">Follower</span>
                                    </div>
                                </div>
                                <div
                                    class="profile-info-item text-muted d-flex align-items-center"
                                    v-if="follow_data.samefollow.length > 0"
                                >
                                <span
                                    v-for="(follow, index) in follow_data.samefollow" :key="index"
                                    class="follower-item overflow-hidden rounded-circle mr-n2"
                                >
                                    <img
                                        class="img_reponsive"
                                        alt=""
                                        :src="follow.avatar"
                                    >
                                </span>
                                <span class="fs12 ml-3">

                                    <span
                                        class="our-follow-name"
                                        v-for="(follow, index) in follow_data.follow" :key="index"
                                    > {{ follow.name }} </span>

                                    <span>{{ follow_data.samefollow.length > 3 ? 'và ' + follow_data.samefollow.length - 3 + ' người khác' : '' }} được 2 bạn heo dõi </span>

                                 </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>


<script>
    import moment from "moment";
    import { eventBus } from "../../app";

    export default {
        name: "ProfileDetail",
        props: ['user', 'follow', 'user_can', 'is_following', 'count'],
        data() {
            return {
                user_data: JSON.parse(this.user),
                follow_data: JSON.parse(this.follow),
                current_user: parseInt(window.__user_id__),
                following: this.is_following,
                is_editting: false
            }
        },
        methods: {
            formatTime($time){
                return moment($time).format('d-m-Y')
            },
            followAction(){
                axios.post( '/'+this.user_data.user_name+'/follow')
                    .then((response) => {
                        this.following = response.data.isfollow;
                        eventBus.$emit('noti', {
                            title: ( this.following ? 'Follow' : 'Unfollow' ) + ' Success',
                            content: 'You was ' + (this.following ? 'followed ' : 'unfollowed ') + this.user_data.name
                        });
                        if (this.following){
                            eventBus.$emit('add-friend', this.user_data)
                        } else {
                            eventBus.$emit('unfriend', this.user_data.id)
                        }
                    })
            },
            editProfile(){
                this.is_editting = !this.is_editting;
            },
            updatedProfile(data){
                this.user_data = data;
                this.editProfile();
            }
        },
        created() {
            eventBus.$emit('header-data', {
                'title': this.user_data.name,
                subHeader: this.count + ' Tweets'
            });
        }
    }
</script>

<style scoped>
    .btn-outline-primary:hover {
        background: unset;
    }
</style>
