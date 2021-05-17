<template>
	<div>
		<label>
			<input type="radio" v-model="chartType" value="1">グラフ表示なし
		</label>
		<label>
			<input type="radio" v-model="chartType" value="2">グラフ表示
		</label>		
		<bar-chart :chartData="effortData" ref="apiChart" v-show="chartType === '2'"></bar-chart>
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
			effortData: {},
			chartType: "1",
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