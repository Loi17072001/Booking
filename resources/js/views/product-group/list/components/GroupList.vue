<template>
  <div class="app-container">
    <div class="filter-container">
      <el-input
        v-model="query.keyword"
        :placeholder="'Tìm kiếm'"
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
        Tìm kiếm
      </el-button>
      <el-button
        class="filter-item"
        style="margin-left: 10px"
        type="success"
        icon="el-icon-plus"
        @click="handleCreateGroup"
      >
        Thêm mới
      </el-button>
    </div>

    <el-table
      v-loading="loading"
      :data="list"
      border
      fit
      highlight-current-row
      stripe
      style="width: 100%"
    >
      <el-table-column align="center" label="STT" width="60">
        <template slot-scope="scope">
          <span>{{ scope.row.index }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="Hình ảnh" width="120">
        <template slot-scope="scope">
          <el-avatar v-if="scope.row.images && scope.row.images.length > 0" shape="square" :size="100" :fit="'contain'" :src="scope.row.images[0]" />
        </template>
      </el-table-column>
      <el-table-column align="center" label="Tên">
        <template slot-scope="scope">
          <span>{{ scope.row.name }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="Số lượng món ăn">
        <template slot-scope="scope">
          <span>{{ scope.row.products.length }}</span>
        </template>
      </el-table-column>
      <el-table-column
        :label="'Thao tác'"
        align="center"
        width="230"
        class-name="small-padding fixed-width"
      >
        <template slot-scope="{ row }">
          <el-button type="primary" size="mini" @click="handleUpdateGroup(row)">
            {{ $t('table.edit') }}
          </el-button>
          <el-button
            v-if="row.status != 'deleted'"
            size="mini"
            type="danger"
            @click="handleDeleteGroup(row)"
          >
            {{ $t('table.delete') }}
          </el-button>
        </template>
      </el-table-column>
    </el-table>

    <pagination
      v-show="total > 0"
      :total="total"
      :page.sync="query.page"
      :limit.sync="query.limit"
      @pagination="getList"
    />
    <el-dialog
      width="50%"
      :title="'Tạo mới nhóm'"
      :top="'5vh'"
      :visible.sync="dialogCreateGroupVisible"
      :destroy-on-close="true"
      :show-close="true"
      :close-on-click-modal="false"
    >
      <div v-loading="groupCreating" class="form-container">
        <el-form
          ref="groupForm"
          :rules="groupRules"
          :model="groupModel"
          label-width="150px"
        >
          <el-form-item label="Hình ảnh" prop="img">
            <el-upload
              action="#"
              list-type="picture-card"
              :auto-upload="false"
              :limit="1"
              :on-change="handleUpload"
              :on-remove="handleImgGroupRemove"
              :file-list="groupModel.images_display"
            >
              <i slot="default" class="el-icon-plus" />
            </el-upload>
          </el-form-item>
          <el-form-item label="Tên" prop="name">
            <el-input v-model="groupModel.name" />
          </el-form-item>
          <el-form-item label="Mô tả" prop="description">
            <el-input v-model="groupModel.description" type="textarea" :autosize="{ minRows: 2, maxRows: 4}" />
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer" style="text-align: right">
          <el-button type="primary" @click="createGroup"> Lưu </el-button>
          <el-button @click="dialogCreateGroupVisible = false;"> Hủy </el-button>
        </div>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import waves from '@/directive/waves'; // Waves directive
import elDragDialog from '@/directive/el-drag-dialog';
import GroupResource from '@/api/group';
const groupResource = new GroupResource();
export default {
  name: 'GroupList',
  components: { Pagination },
  directives: { waves, elDragDialog },
  data() {
    return {
      list: null,
      groupModel: {
        name: '',
        description: '',
      },
      total: 0,
      loading: true,
      downloading: false,
      groupRules: {
        name: [
          {
            required: true,
            message: 'Hãy nhập têm nhóm',
            trigger: 'change',
          },
        ],
      },
      query: {
        page: 1,
        limit: 10,
        keyword: '',
      },
      groupCreating: false,
      dialogCreateGroupVisible: false,
    };
  },
  computed: {},
  created() {
    this.getList();
  },
  methods: {
    convertBlobToBase64(blob) {
      var convertPromise = new Promise(function(resolve, reject) {
        var fileReader = new FileReader();
        fileReader.onload = function() {
          var dataUrl = this.result;
          resolve(dataUrl);
        };

        fileReader.readAsDataURL(blob);
      });

      return convertPromise;
    },
    resetData() {
      this.groupModel = {
        name: '',
        description: '',
      };
    },
    async getList() {
      const { limit, page } = this.query;
      this.loading = true;
      const { data, meta } = await groupResource.search(this.query);
      this.list = data;
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
      });
      this.total = meta.total;
      this.loading = false;
    },
    handleFilter() {
      this.query.page = 1;
      this.getList();
    },
    async handleUpload(file, filelist) {
      if (!this.groupModel.imagesData) {
        this.groupModel.imagesData = [];
      }
      const base64 = await this.convertBlobToBase64(file.raw);
      file.base64 = base64;
      this.groupModel.imagesData.push({ uid: file.uid, base64: base64 });
    },
    handleUpdateGroup(row) {
      this.resetData();
      this.groupModel = { ...row };
      this.groupModel.images_display = [];
      const host = window.location.host;
      if (this.groupModel.images) {
        for (let index = 0; index < this.groupModel.images.length; index++) {
          this.groupModel.images_display.push({ name: index + '.jpg', url: 'http://' + host + this.groupModel.images[index] });
        }
      }
      this.groupModel.isUpdate = true;
      this.dialogCreateGroupVisible = true;
      this.$nextTick(() => {
        this.$refs['groupForm'].clearValidate();
      });
    },
    handleCreateGroup() {
      this.resetData();
      this.dialogCreateGroupVisible = true;
      this.$nextTick(() => {
        this.$refs['groupForm'].clearValidate();
      });
    },
    createGroup() {
      this.$refs['groupForm'].validate((valid) => {
        if (valid) {
          this.groupCreating = true;
          groupResource
            .store(this.groupModel)
            .then((response) => {
              const message = this.groupModel.isUpdate
                ? 'Nhóm ' +
                  this.groupModel.name +
                  ' thay đổi thành công'
                : 'Nhóm ' +
                  this.groupModel.name +
                  ' tạo mới thành công.';
              this.$message({
                message: message,
                type: 'success',
                duration: 3 * 1000,
              });
              this.resetData();
              this.groupCreating = false;
              this.dialogCreateGroupVisible = false;
              this.handleFilter();
            })
            .catch((error) => {
              console.log(error);
            })
            .finally(() => {
              this.groupCreating = false;
            });
        } else {
          return false;
        }
      });
    },
    handleDeleteGroup(row) {
      this.$confirm(
        'Điều này sẽ xóa vĩnh viễn dữ liệu này . Bạn có muốn tiếp tục?',
        'Cảnh báo',
        {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'warning',
        }
      )
        .then(() => {
          groupResource
            .destroy(row.id)
            .then((response) => {
              this.$message({
                type: 'success',
                message: 'Xóa thành công',
              });
              this.handleFilter();
            })
            .catch((error) => {
              console.log(error);
            });
        })
        .catch(() => {
          this.$message({
            type: 'info',
            message: 'Hủy bỏ xóa',
          });
        });
    },
    handleImgGroupRemove(file) {
      let index = null;
      this.groupModel.imagesData.forEach((ele, i) => {
        if (ele.uid === file.uid) {
          index = i;
          return;
        }
      });
      this.groupModel.imagesData.splice(index, 1);
    },
  },
};
</script>

<style lang="scss">
.el-upload-list {
    background-color: #29282800;
}
.el-upload--picture-card {
  width: 148px !important;
}
</style>
