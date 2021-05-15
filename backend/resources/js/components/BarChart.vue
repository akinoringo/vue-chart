<script>
import { Line } from 'vue-chartjs'

export default {
    name: 'LineChart',
    extends: Line,
    data() {
        return {
            chartData: {
                labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                datasets: [{
                    label: 'sample',
                    borderColor: '#0000ff',
                    data: [100, 90, 60, 70, 50, 30, 40, 50, 60, 100],
                    fill: false
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Line chart'
                },
                legend: {
                    display: false
                },
            }
        }
    },
    mounted: function() {
        this.renderChart(this.chartData, this.options)
    }
}

</script>