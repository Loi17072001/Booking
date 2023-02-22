<template>
  <div class="app-container">
    <div class="filter-container">
      <el-select
        v-model="query.school"
        :placeholder="$t('table.school')"
        clearable
        style="width: 200px"
        class="filter-item"
        @change="handleFilter"
      >
        <el-option
          v-for="item in schools"
          :key="item._id"
          :label="item.name | uppercaseFirst"
          :value="item._id"
        />
      </el-select>
      <el-select
        v-model="query.school"
        :placeholder="$t('table.camera')"
        clearable
        style="width: 200px"
        class="filter-item"
        @change="handleFilter"
      >
        <el-option
          v-for="item in schools"
          :key="item._id"
          :label="item.name | uppercaseFirst"
          :value="item._id"
        />
      </el-select>
      <el-select
        v-model="query.school"
        :placeholder="$t('table.target')"
        clearable
        style="width: 200px"
        class="filter-item"
        @change="handleFilter"
      >
        <el-option
          v-for="item in schools"
          :key="item._id"
          :label="item.name | uppercaseFirst"
          :value="item._id"
        />
      </el-select>
      <el-input
        v-model="query.keyword"
        :placeholder="$t('table.fromDate')"
        style="width: 200px"
        class="filter-item"
        @keyup.enter.native="handleFilter"
      />
      <el-input
        v-model="query.keyword"
        :placeholder="$t('table.toDate')"
        style="width: 200px"
        class="filter-item"
        @keyup.enter.native="handleFilter"
      />
      <el-input
        v-model="query.keyword"
        :placeholder="$t('table.keyword')"
        style="width: 200px"
        class="filter-item"
        @keyup.enter.native="handleFilter"
      />
      <el-button
        v-waves
        class="filter-item"
        type="primary"
        icon="el-icon-search"
        @click="handleFilter"
      >
        {{ $t('table.search') }}
      </el-button>

    </div>
    <el-row style="background: #fff; padding: 5px 5px 0;">
      <el-col
        :xs="{ span: 24 }"
        :sm="{ span: 24 }"
        :md="{ span: 12 }"
        :lg="{ span: 12 }"
        :xl="{ span: 12 }"
        style="padding-right: 8px;"
      >
        <teacher-bar-chart />
      </el-col>
      <el-col
        :xs="{ span: 24 }"
        :sm="{ span: 24 }"
        :md="{ span: 12 }"
        :lg="{ span: 12 }"
        :xl="{ span: 12 }"
        style="padding-right: 8px;"
      >
        <subject-bar-chart />
      </el-col>
    </el-row>
    <div>
      <attendance />
    </div>
  </div>

</template>

<script>
import attendance from './components/Attendance';
import TeacherBarChart from './components/TeacherBarChart';
import SubjectBarChart from './components/SubjectBarChart';

export default {
  name: 'ReportAttendance',
  components: { attendance, TeacherBarChart, SubjectBarChart },
  data() {
    return {
      query: {
        page: 1,
        limit: 15,
        keyword: '',
        role: '',
      },
    };
  },
  methods: {
    showCreatedTimes() {
      this.createdTimes = this.createdTimes + 1;
    },
  },
};
</script>

<style scoped>
.tab-container {
  margin: 30px;
}
</style>
