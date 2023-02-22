<template>
  <el-row :gutter="40" class="panel-group">
    <el-col :xs="24" :sm="24" :md="8" :lg="6" class="card-panel-col">
      <div class="card-panel" @click="handleShowDataType('school')">
        <div class="card-panel-icon-wrapper icon-class">
          <svg-icon icon-class="shopping" class-name="card-panel-icon" />
        </div>
        <div class="card-panel-description">
          <div class="card-panel-text">Số lượng khách đặt</div>
          <count-to
            :start-val="0"
            :end-val="systemData.total_dia_diem_luu_tru"
            :duration="1000"
            class="card-panel-num"
          />
        </div>
      </div>
    </el-col>
    <el-col :xs="24" :sm="24" :md="8" :lg="6" class="card-panel-col">
      <div class="card-panel" @click="handleShowDataType('class')">
        <div class="card-panel-icon-wrapper icon-class">
          <svg-icon icon-class="shopping" class-name="card-panel-icon" />
        </div>
        <div class="card-panel-description">
          <div class="card-panel-text">Số lượng đơn hàng</div>
          <count-to
            :start-val="0"
            :end-val="systemData.total_luu_tru"
            :duration="1000"
            class="card-panel-num"
          />
        </div>
      </div>
    </el-col>
    <el-col :xs="24" :sm="24" :md="8" :lg="6" class="card-panel-col">
      <div class="card-panel" @click="handleShowDataType('student')">
        <div class="card-panel-icon-wrapper icon-people">
          <svg-icon icon-class="shopping" class-name="card-panel-icon" />
        </div>
        <div class="card-panel-description">
          <div class="card-panel-text">Số lượng đơn còn lại</div>
          <count-to
            :start-val="0"
            :end-val="systemData.total_truy_na"
            :duration="1000"
            class="card-panel-num"
          />
        </div>
      </div>
    </el-col>
    <el-col :xs="24" :sm="24" :md="8" :lg="6" class="card-panel-col">
      <div class="card-panel" @click="handleShowDataType('teacher')">
        <div class="card-panel-icon-wrapper icon-shopping">
          <svg-icon icon-class="shopping" class-name="card-panel-icon" />
        </div>
        <div class="card-panel-description">
          <div class="card-panel-text">Số lượng đơn hoàn thành</div>
          <count-to
            :start-val="0"
            :end-val="systemData.total_phat_hien_truy_na"
            :duration="1000"
            class="card-panel-num"
          />
        </div>
      </div>
    </el-col>
    <el-col :xs="24" :sm="24" :md="8" :lg="6" class="card-panel-col">
      <div class="card-panel" @click="handleShowDataType('teacher')">
        <div class="card-panel-icon-wrapper icon-shopping">
          <svg-icon icon-class="shopping" class-name="card-panel-icon" />
        </div>
        <div class="card-panel-description">
          <div class="card-panel-text">Thực đơn</div>
          <count-to
            :start-val="0"
            :end-val="systemData.total_phat_hien_truy_na"
            :duration="1000"
            class="card-panel-num"
          />
        </div>
      </div>
    </el-col>
    <el-col :xs="24" :sm="24" :md="8" :lg="6" class="card-panel-col">
      <div class="card-panel" @click="handleShowDataType('teacher')">
        <div class="card-panel-icon-wrapper icon-shopping">
          <svg-icon icon-class="shopping" class-name="card-panel-icon" />
        </div>
        <div class="card-panel-description">
          <div class="card-panel-text">Thực đơn còn hàng</div>
          <count-to
            :start-val="0"
            :end-val="systemData.total_phat_hien_truy_na"
            :duration="1000"
            class="card-panel-num"
          />
        </div>
      </div>
    </el-col>
    <el-col :xs="24" :sm="24" :md="8" :lg="6" class="card-panel-col">
      <div class="card-panel" @click="handleShowDataType('teacher')">
        <div class="card-panel-icon-wrapper icon-shopping">
          <svg-icon icon-class="shopping" class-name="card-panel-icon" />
        </div>
        <div class="card-panel-description">
          <div class="card-panel-text">Thực đơn hết hàng</div>
          <count-to
            :start-val="0"
            :end-val="systemData.total_phat_hien_truy_na"
            :duration="1000"
            class="card-panel-num"
          />
        </div>
      </div>
    </el-col>
    <el-col :xs="24" :sm="24" :md="8" :lg="6" class="card-panel-col">
      <div class="card-panel" @click="handleShowDataType('teacher')">
        <div class="card-panel-icon-wrapper icon-shopping">
          <svg-icon icon-class="shopping" class-name="card-panel-icon" />
        </div>
        <div class="card-panel-description">
          <div class="card-panel-text">Booking</div>
          <count-to
            :start-val="0"
            :end-val="systemData.total_phat_hien_truy_na"
            :duration="1000"
            class="card-panel-num"
          />
        </div>
      </div>
    </el-col>
  </el-row>
</template>

<script>
import CountTo from 'vue-count-to';
import { fetchInfo } from '@/api/dashboard';

export default {
  components: {
    CountTo,
  },
  data() {
    return {
      systemData: {},
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    handleShowDataType(type) {
      this.$emit('handleShowDataType', type);
    },
    async fetchData() {
      this.systemData = await fetchInfo();
    },
  },
};
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
.indicator.online {
  background: #28b62c;
  display: inline-block;
  width: 1em;
  height: 1em;
  border-radius: 50%;
  -webkit-animation: pulse-animation 2s infinite linear;
}

@-webkit-keyframes pulse-animation {
  0% {
    -webkit-transform: scale(1);
  }
  25% {
    -webkit-transform: scale(1);
  }
  50% {
    -webkit-transform: scale(1.2);
  }
  75% {
    -webkit-transform: scale(1);
  }
  100% {
    -webkit-transform: scale(1);
  }
}

.indicator.offline {
  background: #ff4136;
  display: inline-block;
  width: 1em;
  height: 1em;
}
.panel-group {
  margin-top: 18px;
  .card-panel-col {
    margin-bottom: 32px;
  }
  .card-panel {
    height: 90px;
    cursor: pointer;
    font-size: 12px;
    position: relative;
    overflow: hidden;
    color: #fff;
    background-color: #1f1f1f;
    background-image: linear-gradient(357deg, #393939 0%, #79787899);
    box-shadow: 4px 4px 40px rgba(0, 0, 0, 0.05);
    border-color: rgba(0, 0, 0, 0.05);
    &:hover {
      .card-panel-icon-wrapper {
        color: #fff;
      }
      .icon-people {
        background: #40c9c6;
      }
      .icon-class {
        background: #36a3f7;
      }
      .icon-money {
        background: #f4516c;
      }
      .icon-shopping {
        background: #34bfa3;
      }
    }
    .icon-people {
      color: #40c9c6;
    }
    .icon-class {
      color: #36a3f7;
    }
    .icon-money {
      color: #f4516c;
    }
    .icon-shopping {
      color: #34bfa3;
    }
    .card-panel-icon-wrapper {
      float: left;
      margin: 14px 0 0 0px;
      padding: 5px;
      transition: all 0.38s ease-out;
      border-radius: 6px;
    }
    .card-panel-icon {
      float: left;
      font-size: 48px;
    }
    .card-panel-description {
      float: right;
      font-weight: bold;
      margin-left: 0px;
      margin-top: 24px;
      margin-right: 10px;
      .card-panel-text {
        line-height: 18px;
        color: rgb(255, 255, 255);
        font-size: 16px;
        margin-bottom: 12px;
      }
      .card-panel-num {
        font-size: 20px;
        float: right;
      }
    }
  }
}
</style>
