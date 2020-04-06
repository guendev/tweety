window._ = require('lodash');
import axios from 'axios';
import Vue from "vue";
import VueRouter from "vue-router";
import Form from "./support/Form";

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

window.axios = axios;
window.Vue = Vue;
window.Form = Form;

Vue.use(VueRouter);

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

