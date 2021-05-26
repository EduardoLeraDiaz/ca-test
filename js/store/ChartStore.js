import axios from 'axios';

const moduleChart = {
    strict: true,
    state: {
        chartData: null,
    },
    mutations: {
        setChartData(state, data) {
            state.chartData = data;
        }
    },
    actions: {
        fetchChartData({ commit, dispatch }, payload) {
            let url = '/api/reviews/' + payload.hotelId + '/' + payload.from + '/' + payload.to;
            axios.get(url).then((response) => {
                commit('setChartData', response.data.data);
            })
        }
    },
    getters: {
        chartData: state => {
            return state.chartData;
        },        
    }
}

export default moduleChart;