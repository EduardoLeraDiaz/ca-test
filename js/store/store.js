import Vue from 'vue'
import Vuex from 'vuex'
import moduleConfig from './ConfigStore'
import moduleChart from './ChartStore'

Vue.use(Vuex)

export default new Vuex.Store({
    strict: true,
    modules: {
        moduleConfig,
        moduleChart
    }
});



