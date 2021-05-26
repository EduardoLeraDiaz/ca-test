import Vue from 'vue';
import axios from 'axios';
import Vuex from "vuex";
import MockAdapter from "axios-mock-adapter";
import {mount} from "@vue/test-utils";
import store from "../../../../../vue/vuex/store";
import App from "../App"


Vue.use(Vuex);

// mock calls
let mock = new MockAdapter(axios);
let responseData = '{"result":"ok","data":[{"review-count":13,"date-group":"20210404","average-score":3.0769},{"review-count":17,"date-group":"20210405","average-score":2.8235},{"review-count":12,"date-group":"20210406","average-score":2.5833},{"review-count":10,"date-group":"20210407","average-score":2.7},{"review-count":13,"date-group":"20210408","average-score":2.6154},{"review-count":11,"date-group":"20210409","average-score":3.7273},{"review-count":19,"date-group":"20210410","average-score":2.5263},{"review-count":10,"date-group":"20210411","average-score":2.1},{"review-count":12,"date-group":"20210412","average-score":2.6667},{"review-count":10,"date-group":"20210413","average-score":2.7},{"review-count":12,"date-group":"20210414","average-score":2.0833},{"review-count":11,"date-group":"20210415","average-score":3},{"review-count":15,"date-group":"20210416","average-score":2.9333},{"review-count":17,"date-group":"20210417","average-score":2.5882},{"review-count":13,"date-group":"20210418","average-score":2.6154},{"review-count":13,"date-group":"20210419","average-score":2.8462},{"review-count":22,"date-group":"20210420","average-score":2.8182},{"review-count":14,"date-group":"20210421","average-score":3},{"review-count":21,"date-group":"20210422","average-score":2.3333},{"review-count":9,"date-group":"20210423","average-score":2.1111},{"review-count":7,"date-group":"20210424","average-score":1.5714},{"review-count":7,"date-group":"20210425","average-score":2.5714},{"review-count":15,"date-group":"20210426","average-score":2.2},{"review-count":15,"date-group":"20210427","average-score":3.0667},{"review-count":15,"date-group":"20210428","average-score":2.7333},{"review-count":13,"date-group":"20210429","average-score":1.6923},{"review-count":14,"date-group":"20210430","average-score":2.2857}]}';
mock.onGet('/api/reviews/1/100/200').reply(200, JSON.stringify(responseData));

describe('App.test.js', () => {
    it('has the expected html structure after loading', async () => {
        const wrapper = mount(App, {
            localVue,
            store: store
        });

        await store.dispatch('fetchChartData');
        expect(wrapper.vm.$el).toMatchSnapshot();
    });
});