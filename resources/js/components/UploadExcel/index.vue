<template>
  <div>
    <el-upload
      :action="action"
      :before-upload="handleUpload"
      :accept="'xlsx, xls'"
      :headers="headers"
      :drag="true"
      :auto-upload="true"
      multiple
      :file-list="fileList"
    >
      <i class="el-icon-upload" />
      <div class="drop">
        <span style="color: white">Click vào đây để tải lên </span>
      </div>
      <div slot="tip" class="el-upload__tip">
        Tệp excel có kích thước nhỏ hơn 5Mb
      </div>
    </el-upload>
  </div>
</template>

<script>
import Cookies from 'js-cookie';
export default {
  props: {
    action: String, // eslint-disable-line
  },
  data() {
    return {
      loading: false,
      fileList: [],
      headers: {
        // 'Content-Type': 'multipart/form-data',
        'X-Requested-With': 'XMLHttpRequest',
        'X-XSRF-TOKEN': Cookies.get('XSRF-TOKEN'),
      },
      excelData: {
        header: null,
        results: null,
      },
    };
  },
  methods: {
    handleUpload(file) {
      let isError = false;
      if (!this.isExcel(file)) {
        isError = true;
      }
      if (isError) {
        return false;
      }
      return true;
    },
    isExcel(file) {
      return /\.(xlsx|xls|csv)$/.test(file.name);
    },
  },
};
</script>

<style scoped>
.excel-upload-input {
  display: none;
  z-index: -9999;
}
.drop {
  border: 2px dashed #bbb;
  white-space: pre-wrap;
  /* width: 600px; */
  height: 100px;
  /* line-height: 100px; */
  margin: 0 auto;
  font-size: 24px;
  border-radius: 5px;
  text-align: center;
  color: rgb(10, 10, 10);
  position: relative;
}
</style>
