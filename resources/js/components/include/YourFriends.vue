<template>
    <div class="trending-area bg-dark-2 mt20 py-3 br30">
        <h5 class="text-white bbr-dark2 pr-3 ml-3">Your Friends</h5>
        <div
            v-for="friend in FriendsData"
            class="trending-item hover-bg row alc mx-0 bbs-dark2 py-2 pl-3"
        >
            <div class="g_thumb circle mr4">
                <a
                    :href="'/@'+friend.user_name"
                ><img
                    :src="friend.avatar"
                ></a>
            </div>
            <div class="user-meta text-white mr4 ml4 w-auto oh d-lg-inline-block d-none">
                <h5><a
                    class="fs16 text-white"
                    :href="'/@'+friend.user_name"
                >{{ friend.name }}</a></h5>
            </div>
        </div>
        <a class="ml-3 mt-3 text-primary">Show more</a>
    </div>
</template>

<script>
    export default {
        name: "YourFriends",
        data() {
            return {
                FriendsData: []
            }
        },
        created() {
            axios.get('/get-recommend')
            .then(({ data }) => {
                this.FriendsData = data.data;
            })
        }
    }
</script>

<style scoped>

</style>
