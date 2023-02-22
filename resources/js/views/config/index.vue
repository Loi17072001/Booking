<template>
  <div class="app-container">
    <el-form ref="form" :model="form" label-width="350px">
      <el-form-item label="Thời gian tự động sao lưu dữ liệu">
        <el-time-picker v-model="form.date2" placeholder="Chọn thời điểm lưu trữ tự động" style="width: 100%;" />
        <el-link type="primary">Danh sách lưu trữ</el-link>
      </el-form-item>
      <el-form-item label="Số điện thoại nhận cảnh báo">
        <el-select
          v-model="form.sdts"
          multiple
          filterable
          allow-create
          default-first-option
          placeholder="Nhập số điện thoại"
          style="width: 100%;"
        >
          <el-option
            v-for="item in sdts"
            :key="item.value"
            :label="item.label"
            :value="item.value"
          />
        </el-select>
      </el-form-item>
      <el-form-item label="Gửi tin nhắn">
        <el-radio-group v-model="form.resource">
          <el-radio label="Gửi tin nhắn khi có đơn" />
          <el-radio label="Không gửi tin nhắn" />
        </el-radio-group>
      </el-form-item>
      <!-- <el-form-item label="Gửi email khi được phát hiện truy nã">
        <el-switch v-model="form.send_email" />
      </el-form-item>
      <el-form-item label="Gửi tin nhắn Slack khi được phát hiện truy nã">
        <el-switch v-model="form.send_slack" />
      </el-form-item>
      <el-form-item label="Download dữ liệu">
        <el-button type="success">Danh sách lưu trú</el-button>
        <el-button type="success">Danh sách truy nã</el-button>
      </el-form-item>
      <el-form-item label="Token API">
        Link API lưu trú: http://localhost:8011/api/nguoiluutru
        <el-input v-model="form.token" type="textarea" />
      </el-form-item>
      <el-form-item label="Token API">
        Link API bên thứ 3
        <el-input v-model="form.urls" type="text" />
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="onSubmit">Lưu</el-button>
        <el-button>Khôi phục lại</el-button>
      </el-form-item> -->
    </el-form>
  </div>
</template>

<script>

export default {
  name: 'Config',
  components: { },
  data() {
    return {
      sdts: [],
      form: {
        name: '',
        region: '',
        date1: '',
        date2: '',
        delivery: false,
        type: [],
        resource: '1',
        desc: '',
      },
    };
  },
  methods: {
  },
};
</script>
