<template>
	<div>
		<label>
			<input type="radio" v-model="chartType" value="1">グラフ表示なし
		</label>
		<label>
			<input type="radio" v-model="chartType" value="2">グラフ表示
		</label>		
		<bar-chart 
			:chartData="effortData" ref="apiChart" v-show="chartType === '2' ">
		</bar-chart>
	</div>
</template>

<script>
import BarChart from './BarChart'
export default {
	components: {
		BarChart
	},
	props: {
    userid: ''
	},
	data() {
		return {
			apiEffortData: {},
			effortData: {},
			chartType: "1",
			id: this.userid,
		};
	},
	mounted() {
		this.$http.get(`/${this.id}/effortgraph`).then(responce => {
			this.apiEffortData = responce.data;
			this.setChart();
		});
	},
	methods: {
		setChart() {
			this.effortData = Object.assign({}, this.effortData, {
				labels: this.apiEffortData.week,
				datasets: [
					{
						label: "目標1",
						backgroundColor: "red",
						data: this.apiEffortData.effortsTimeTotalOfWeek[0]
					},
					{
						label: "目標2",
						backgroundColor: "blue",
						data: this.apiEffortData.effortsTimeTotalOfWeek[1]
					},
					{
						label: "目標3",
						backgroundColor: "green",
						data: this.apiEffortData.effortsTimeTotalOfWeek[2]
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