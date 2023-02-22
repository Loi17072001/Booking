<template>
  <div class="dashboard-editor-container">
    <panel @handleShowDataType="handleShowDataType" />
    <!-- <el-row style="padding: 16px 16px 0; margin-bottom: 32px">
      <el-col
        :xs="{ span: 24 }"
        :sm="{ span: 24 }"
        :md="{ span: 24 }"
        :lg="{ span: 24 }"
        :xl="{ span: 24 }"
        style="padding-right: 8px; margin-bottom: 30px"
      >
        <bar-chart />
      </el-col>
    </el-row> -->
  </div>
</template>

<script>
import Panel from './components/PanelGroup';
// import RaddarChart from './components/RaddarChart';
// import BarChart from './components/BarChart';

export default {
  name: 'DashboardAdmin',
  components: {
    Panel,
    // BarChart,
    // RaddarChart,
    // Camera,
  },
  data() {
    return {
      dataType: 'school',
    };
  },
  methods: {
    handleShowDataType(type) {
      this.dataType = type;
    },
  },
};
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
.dashboard-editor-container {
  padding: 10px;
  .chart-wrapper {
    background: #000;
    padding: 16px 16px 0;
    margin-bottom: 32px;
  }
}
</style>
