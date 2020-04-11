import 'jquery'
import './bootstrap';

import router from "./routes";
import Vue from "vue";
export const eventBus = new Vue();

Vue.component('tweet-form', require('./components/Forms/Tweet').default);
Vue.component('profile-action', require('./components/Profile/ProfileAction').default);
Vue.component('search', require('./components/include/search').default);
Vue.component('tweet-detail', require('./components/Profile/TweetDetail').default);
Vue.component('new-feeds', require('./components/Home/NewsFeed').default);
Vue.component('profile-detail', require('./components/Profile/ProfileDetail').default);
Vue.component('form-edit-profile', require('./components/Profile/EditProfile').default);
Vue.component('your-friends', require('./components/include/YourFriends').default);
Vue.component('header-bar', require('./components/include/Header').default);
Vue.component('discovery', require('./components/discovery/Discovery').default);
Vue.component('app-noti', require('../js/components/include/Noti').default);
const app = new Vue({
    el: '#app-frontend',
    router
});
