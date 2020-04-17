import 'jquery'
import './bootstrap';

import router from "./routes";
import Vue from "vue";
export const eventBus = new Vue();

Vue.component('tweet-form', require('./components/Forms/Tweet').default);
Vue.component('profile-action', require('./components/Profile/ProfileAction').default);
Vue.component('new-feeds', require('./components/include/NewsFeed').default);
Vue.component('profile-detail', require('./components/Profile/ProfileDetail').default);
Vue.component('form-edit-profile', require('./components/Profile/EditProfile').default);
Vue.component('your-friends', require('./components/include/YourFriends').default);
Vue.component('header-bar', require('./components/include/Header').default);
Vue.component('discovery', require('./components/discovery/Discovery').default);
Vue.component('app-noti', require('../js/components/include/Noti').default);
Vue.component('tweet-actions', require('../js/components/include/TweetActions').default);
Vue.component('reply', require('../js/components/include/Reply').default);
Vue.component('auth-user', require('../js/components/include/Auth/Login').default);
Vue.component('');
const app = new Vue({
    el: '#app-frontend',
    router
});
