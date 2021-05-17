<template>
	<div>
		<bar-chart :chartData="effortData" ref="apiChart"></bar-chart>
	</div>
</template>

<script>
import BarChart from './BarChart'
export default {
	components: {
		BarChart
	},
	data() {
		return {
			apiEffortData: {},
			effortData: {}
		};
	},
	mounted() {
		this.$http.get("/effortgraph").then(responce => {
			this.apiEffortData = responce.data;
			this.setChart();
		});
	},
	methods: {
		setChart() {
			this.effortData = Object.assign({}, this.effortData, {
				labels: this.apiEffortData.apiEffortCreate,
				datasets: [
					{
						label: "積み上げ時間",
						backgroundColor: "rgba(0, 170, 248, 0.47)",
						data: this.apiEffortData.apiEffortTime
					}
				]
			});
			this.$nextTick(() => {
				this.$refs.apiChart.renderBarChart();
			})
		}
	}
};

</script>