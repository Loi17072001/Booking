<template>
  <div :id="id" :class="className" :style="{ height: '70vh', width: '100%' }" />
</template>

<script>
import echarts from 'echarts';
import resize from './mixins/resize';

export default {
  mixins: [resize],
  props: {
    className: {
      type: String,
      default: 'chart',
    },
    id: {
      type: String,
      default: 'chart',
    },
    width: {
      type: String,
      default: '200px',
    },
    height: {
      type: String,
      default: '200px',
    },
    data: {
      type: Array,
      default: function() {
        return [];
      },
    },
  },
  data() {
    return {
      chart: null,
      dataSerial: this.data,
    };
  },
  watch: {
    data(newValue) {
      this.dataSerial = newValue;
      this.initChart();
    },
  },
  mounted() {
    this.initChart();
  },
  created() {
    this.initChart();
  },
  beforeDestroy() {
    if (!this.chart) {
      return;
    }
    this.chart.dispose();
    this.chart = null;
  },
  methods: {
    initChart() {
      this.chart = echarts.init(document.getElementById(this.id));
      this.chart.setOption({
        darkMode: true,
        tooltip: {
          trigger: 'item',
          triggerOn: 'mousemove',
        },
        lineStyle: {
          color: '#fff',
          width: 1.5,
          curveness: 0.5,
        },
        itemStyle: {
          color: '#fff',
          fontSize: '17px',
        },
        title: {
          text: 'Lịch trình di chuyển',
          x: '20',
          top: '20',
          textStyle: {
            color: '#fff',
            fontSize: '22',
          },
          subtextStyle: {
            color: '#90979c',
            fontSize: '16',
          },
        },
        series: [
          {
            type: 'tree',
            data: this.dataSerial,
            top: '1%',
            left: '10%',
            bottom: '1%',
            right: '20%',
            symbolSize: 7,
            label: {
              position: 'top',
              verticalAlign: 'middle',
              align: 'right',
              fontSize: 15,
              color: '#fff',
            },
            leaves: {
              label: {
                position: 'right',
                verticalAlign: 'middle',
                align: 'left',
              },
            },
            emphasis: {
              focus: 'descendant',
            },
            expandAndCollapse: true,
            animationDuration: 550,
            animationDurationUpdate: 750,
          },
        ],
      });
    },
  },
};
</script>
