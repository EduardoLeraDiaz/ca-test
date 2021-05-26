import appData from '../utils/configReader.js'

const moduleConfig = {
    strict: true,
    state: {
        app: appData,
    },
    getters: {
        hotels: state => {
            return state.app.hotels;
        },
    }
}

export default moduleConfig;