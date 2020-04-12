<template>
    <section class="discovery-box mt-2">
        <div class="container">
            <div class="row">
                <div
                    v-for="(user, index) in users"
                    class="col-12 bg-dark-1"
                    :class="index !== 0 ? 'mt-2 author-id-'+user.id : 'author-id-'+user.id"
                >
                    <div class="trending-item row alc mx-0 bbs-dark2 py-3">
                        <div class="g_thumb circle mr4">
                            <a
                                :href="'/@'+user.user_name"
                                :alt="user.name"
                            >
                                <img
                                    :src="user.avatar"
                                    :alt="user.name"
                                >
                            </a>
                        </div>
                        <div class="user-meta text-white mr4 ml4 col oh d-flex">
                            <div class="user-meta-info col-auto">
                                <h5>
                                    <a
                                        class="text-light fs16"
                                        :href="'/@'+user.user_name"
                                        :alt="user.name"
                                    >{{ user.name }}</a>
                                </h5>
                                <div class="user-counter d-inline-flex text-muted">
                                    <span class="user-couter-item mr-2">
                                        <small class="mr4">Follow</small>
                                        <small>{{ user.count_follow }}</small>
                                    </span>
                                    <div class="user-counter-item">
                                        <small class="mr4">Tweets</small>
                                        <small>{{ user.count_tweets }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="user-action col-auto d-flex ml-auto justify-content-center align-items-center">
                                <a
                                    class="btn btn-outline-primary font-weight-bold fs12 text-primary br30"
                                    @click.prevent="followAction(user)"
                                >{{ user.isFollowing ? 'Unfollow' : 'Follow' }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <infinite-loading
                    @infinite="infiniteHandler"
                    ref="infiniteLoading"
                    spinner="waveDots"
                    class="col-12"
                >
                    <div slot="no-more" class="h50 d-flex justify-content-center align-items-center">
                        <p class="text-light">No More Data</p>
                    </div>
                </infinite-loading>
            </div>
        </div>
    </section>
</template>

<script>
    import { eventBus } from "../../app";
    import InfiniteLoading from 'vue-infinite-loading';
    export default {
        name: "discovery",
        props: ['count'],
        data() {
            return {
                users: [],
                page: 0
            }
        },
        methods: {
            infiniteHandler($state) {
                axios.get('/get-discovery', {
                    params: {
                        page: this.page
                    },
                }).then(({ data }) => {
                    if (data.length > 0) {
                        this.page += 1;
                        this.users.push(...data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                });
            },


            followAction(user){
                axios.post( '/'+user.user_name+'/follow')
                    .then((response) => {
                        user.isFollowing = response.data.isfollow;
                        user.count_follow = user.isFollowing ? user.count_follow + 1 : user.count_follow - 1;
                        eventBus.$emit('noti', {
                            title: ( user.isFollowing ? 'Follow' : 'Unfollow' ) + ' Success',
                            content: 'You was ' + (user.isFollowing ? 'followed ' : 'unfollowed ') + user.name
                        })
                    })
            }


        },
        created() {
            axios.get('/get-discovery', {
                params: {
                    page: this.page
                }
            })
            .then(({ data }) => {
                this.page += 1;
                this.users.push(...data);
            });
            eventBus.$emit('header-data', {
                title: 'Discovery',
                subHeader: this.count + ' Friends',
            })
        }
    }
</script>

<style scoped>

</style>
