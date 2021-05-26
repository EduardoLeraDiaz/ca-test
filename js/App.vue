<template>
  <div id="app" class="container">
    <h1 class="banner">CA Test</h1>
    <div class="filter">
      <span class="filter__logo">Filter</span>
      <form>
        <div class="row">
          <div class="filter__hotel col-md">
            <select v-model="hotelId">
              <option v-for="hotel in hotels" :key="hotel.id" :value="hotel.id">{{hotel.name}}</option>
            </select>
          </div>
          <div class="filter__from col-md">
            <span>From</span>
            <input type="date" v-model="dateFrom"/>
          </div>
          <div class="filter__to col-md">
            <span>To</span>
            <input type="date" v-model="dateTo"/>
          </div>
        </div>
      </form>
    </div>
    <div class="error-wrapper">
      <div class="error-wrapper__error-element--wrong-date alert alert-danger" v-if="wrongDate">To date must be  after from date</div>
    </div>
    <h2 class="banner">Average Score Over Time</h2>
    <div class="chart-wrapper">
      <chart class="chart-wrapper__chart" v-if="chartData" :key="chartWidth" :width="chartWidth" type="line" :options="options" :series="series"/>
    </div>
  </div>
</template>

<script>
import VueApexCharts from "vue-apexcharts";

export default {
  components: {
    chart: VueApexCharts
  },
  data() {
    return {
      hotelId: null,
      dateFrom: null,
      dateTo: null
    }
  },
  computed: {
    hotels() {
      return this.$store.getters.hotels
    },
    chartOptions() {
      return {
        hotelId: this.hotelId,
        from: (new Date(this.dateFrom)).getTime() / 1000,
        to: (new Date(this.dateTo)).getTime() / 1000
      }
    },
    chartData() {
       return this.$store.getters.chartData;
    },
    options() {
      return {
        chart: {
          id: 'ca-test'
        },
        xaxis: {
          categories: this.chartData.map(a => a['date-group'])
        }
      }
    },
    chartWidth() {
        switch (this.$mq){
          case 'sm':
            return 300;
          case 'md':
            return 500;
          case 'lg':
            return  600;
        }
        return 800;
    },
    series() {
      return [{
        name: 'Score',
        data: this.chartData.map(a => a['average-score'])
      }]
    },
    wrongDate() {
      return this.dateFrom && this.dateTo && this.dateFrom > this.dateTo;
    }
  },
  watch: {
    hotelId() {
      this.handleChanges();
    },
    dateFrom() {
      this.handleChanges();
    },
    dateTo() {
      this.handleChanges();
    }
  },
  methods: {
    handleChanges() {
      if (!this.hotelId || !this.dateFrom || !this.dateTo || this.wrongDate) {
        return
      }

      this.$store.dispatch('fetchChartData',this.chartOptions)
    }
  }
}
</script>
