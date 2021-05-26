import Vue from "vue";
import App from "./App.vue";
import store from "./store/store"
import VueMq from 'vue-mq'

Vue.use(VueMq, {
    breakpoints: { 
        sm: 576,
        md: 768,
        lg: 992,
        xl: 1200,
        xxl: 1400,
    },
    defaultBreakpoint: 'xl'
});

new Vue({
    store,
    render: (h) => h(App)
}).$mount("#app");