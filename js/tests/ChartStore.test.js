import ChartStore from '../store/ChartStore';
import axios from 'axios';

jest.mock('axios');

describe('ChartStore.test.js', () => {
    // Mutators
    it('has to mutate the Chart Data', async () => {
        let payload = [
            {'mocked': 'payload'}
        ];
        let state = {};
        ChartStore.mutations.setChartData(state, payload);
        expect(state.chartData).toEqual(payload);
    });

    // Fetchers
    it('has to fetch the chart data', async () => {
        let payload = {
            hotelId :1,
            from: 100,
            to: 200
        };
        const data = {data:{pay: 'load'}};
        axios.get.mockImplementationOnce(() => new Promise.resolve(data));
        await ChartStore.actions.fetchChartData({ commit }, payload);
        expect(commit).toBeCalledWith('setChartData', data);
        expect(axios.get).toHaveBeenCalledWith('/api/reviews/1/100/200');
    });
    // Getters
    it('has to call data getter properly', async () => {
        const state = {chartData:{pay: 'load'}};
        expect(ChartStore.getters.chartData(state)).toBe(state.chartData);
    });
});