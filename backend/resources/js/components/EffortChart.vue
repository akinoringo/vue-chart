<template>
	<div>
		<bar-chart :chartData="weekData" ref="weekChart"></bar-chart>
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
			weekData: {
				labels: [1,2],
				datasets: [
					{
						label: "積み上げ時間",
						backgroundColor: "rgba(0, 170, 248, 0.47)",
						data: [5,5]
					}
				]
			}
		};
	},
	mounted() {
		this.$refs.weekChart.renderBarChart();
	},
};

</script>