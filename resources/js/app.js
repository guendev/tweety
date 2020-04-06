import 'jquery'
import './bootstrap';

import router from "./routes";
import Vue from "vue";

Vue.component('tweet-form', require('./components/Forms/Tweet').default);
Vue.component('profile-action', require('./components/Profile/ProfileAction').default);
Vue.component('search', require('./components/include/search').default);
Vue.component('tweet-detail', require('./components/Tweet/TweetDetail').default);
Vue.component('new-feeds', require('./components/Home/NewsFeed').default);
const app = new Vue({
    el: '#app-frontend',
    router
});
