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
      <el-select
        v-model="query.group"
        clearable
        :placeholder="'Nhóm'"
        class="filter-item"
      >
        <el-option
          v-for="item in groups"
          :key="item.id"
          :label="item.name | uppercaseFirst"
          :value="item.id"
        />
      </el-select>
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
        @click="handleCreateProduct"
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
      <el-table-column align="center" label="Nhóm">
        <template slot-scope="scope">
          <span v-if="scope.row.groupData">{{ scope.row.groupData.name }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="Giá">
        <template slot-scope="scope">
          <span>{{ scope.row.price | VMask(currencyMask) }} đ</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="Giá giảm">
        <template slot-scope="scope">
          <span>{{ scope.row.price_discount | VMask(currencyMask) }} đ</span>
        </template>
      </el-table-column>
      <el-table-column
        :label="'Thao tác'"
        align="center"
        width="230"
        class-name="small-padding fixed-width"
      >
        <template slot-scope="{ row }">
          <el-button type="primary" size="mini" @click="handleUpdateProudct(row)">
            Sửa
          </el-button>
          <el-button
            v-if="row.status != 'deleted'"
            size="mini"
            type="danger"
            @click="handleDeleteProudct(row)"
          >
            Xóa
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
      :title="'Tạo mới sản phẩm'"
      :top="'5vh'"
      :visible.sync="dialogCreateProudctVisible"
      :destroy-on-close="true"
      :show-close="true"
      :close-on-click-modal="false"
    >
      <div v-loading="productCreating" class="form-container">
        <el-form
          ref="productForm"
          :rules="productRules"
          :model="productModel"
          label-width="150px"
        >
          <el-form-item label="Hình ảnh" prop="img">
            <el-upload
              action="#"
              list-type="picture-card"
              :auto-upload="false"
              :limit="1"
              :on-change="handleUpload"
              :on-remove="handleImgProductRemove"
              :file-list="productModel.images_display"
            >
              <i slot="default" class="el-icon-plus" />
            </el-upload>
          </el-form-item>
          <el-form-item label="Tên" prop="name">
            <el-input v-model="productModel.name" />
          </el-form-item>
          <el-form-item label="Giá" prop="price">
            <el-input v-if="dialogCreateProudctVisible" v-model="productModel.price" v-mask="currencyMask" />
          </el-form-item>
          <el-form-item label="Giá giảm" prop="price_discount">
            <el-input v-if="dialogCreateProudctVisible" v-model="productModel.price_discount" v-mask="currencyMask" />
          </el-form-item>
          <el-form-item label="Nhóm" prop="group">
            <el-select
              v-model="productModel.group"
              clearable
              :placeholder="'Nhóm'"
              class="filter-item"
            >
              <el-option
                v-for="item in groups"
                :key="item.id"
                :label="item.name | uppercaseFirst"
                :value="item.id"
              />
            </el-select>
          </el-form-item>
          <el-form-item label="Mô tả" prop="description">
            <el-input v-model="productModel.description" type="textarea" :autosize="{ minRows: 2, maxRows: 4}" />
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer" style="text-align: right">
          <el-button type="primary" @click="createProduct"> Lưu </el-button>
          <el-button @click="dialogCreateProudctVisible = false;"> Hủy </el-button>
        </div>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import waves from '@/directive/waves'; // Waves directive
import ProductResource from '@/api/product';
import GroupResource from '@/api/group';
import createNumberMask from 'text-mask-addons/dist/createNumberMask';
import { toThousandFilter } from '../../../../utils/index';
const productResource = new ProductResource();
const groupResource = new GroupResource();
const currencyMask = createNumberMask({
  prefix: '',
  suffix: '',
  allowDecimal: true,
  includeThousandsSeparator: true,
  allowNegative: false,
});

export default {
  name: 'ProductList',
  components: { Pagination },
  directives: { waves },
  data() {
    return {
      currencyMask,
      list: null,
      productModel: {
        price: 0,
        price_discount: 0,
      },
      total: 0,
      loading: true,
      downloading: false,
      productRules: {
        name: [
          {
            required: true,
            message: 'Hãy nhập têm nhóm',
            trigger: 'change',
          },
        ],
        price: [
          {
            required: true,
            message: 'Hãy nhập giá',
            trigger: 'change',
          },
        ],
        price_discount: [
          {
            required: true,
            message: 'Hãy nhập giá giảm',
            trigger: 'change',
          },
        ],
        group: [
          {
            required: true,
            message: 'Hãy nhập nhóm',
            trigger: 'change',
          },
        ],
      },
      query: {
        page: 1,
        limit: 10,
        keyword: '',
      },
      groups: [],
      productCreating: false,
      dialogCreateProudctVisible: false,
    };
  },
  computed: {},
  created() {
    this.getList();
    this.getGroups();
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
    async handleUpload(file, filelist) {
      if (!this.productModel.imagesData) {
        this.productModel.imagesData = [];
      }
      const base64 = await this.convertBlobToBase64(file.raw);
      file.base64 = base64;
      this.productModel.imagesData.push({ uid: file.uid, base64: base64 });
    },
    async getGroups() {
      const { data } = await groupResource.search({});
      this.groups = data;
    },
    async getList() {
      const { limit, page } = this.query;
      this.loading = true;
      const { data, meta } = await productResource.search(this.query);
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
    resetData() {
      this.productModel = {
        price: 0,
        price_discount: 0,
      };
    },
    async handleUpdateProudct(row) {
      this.resetData();
      this.dialogCreateProudctVisible = true;
      this.productModel = { ...row };
      this.productModel.images_display = [];
      const host = window.location.host;
      for (let index = 0; index < this.productModel.images.length; index++) {
        this.productModel.images_display.push({ name: index + '.jpg', url: 'http://' + host + this.productModel.images[index] });
      }
      console.log(this.productModel);
      this.productModel.price = toThousandFilter(this.productModel.price);
      this.productModel.price_discount = toThousandFilter(this.productModel.price_discount);
      this.productModel.isUpdate = true;
      this.$nextTick(() => {
        this.$refs['productForm'].clearValidate();
      });
    },
    handleCreateProduct() {
      this.resetData();
      this.dialogCreateProudctVisible = true;
      this.$nextTick(() => {
        this.$refs['productForm'].clearValidate();
      });
    },
    createProduct() {
      this.$refs['productForm'].validate((valid) => {
        if (valid) {
          this.productCreating = true;
          const dataInput = { ...this.productModel };
          dataInput.price = dataInput.price.replaceAll(',', '');
          if (dataInput.price_discount) {
            dataInput.price_discount = dataInput.price_discount.replaceAll(',', '');
          }
          console.log(dataInput);
          productResource
            .store(dataInput)
            .then((response) => {
              const message = this.productModel.isUpdate
                ? 'Sản phẩm ' +
                  this.productModel.name +
                  ' thay đổi thành công'
                : 'Sản phẩm ' +
                  this.productModel.name +
                  ' tạo mới thành công.';
              this.$message({
                message: message,
                type: 'success',
                duration: 3 * 1000,
              });
              this.resetData();
              this.productCreating = false;
              this.dialogCreateProudctVisible = false;
              this.handleFilter();
            })
            .catch((error) => {
              console.log(error);
            })
            .finally(() => {
              this.productCreating = false;
            });
        } else {
          return false;
        }
      });
    },
    handleImgProductRemove(file) {
      let index = null;
      this.productModel.imagesData.forEach((ele, i) => {
        if (ele.uid === file.uid) {
          index = i;
          return;
        }
      });
      this.productModel.imagesData.splice(index, 1);
    },
    handleDeleteProudct(row) {
      this.$confirm(
        'Điều này sẽ xóa vĩnh viễn dữ liệu này . Bạn có muốn tiếp tục?',
        'Cảnh báo',
        {
          confirmButtonText: 'Đồng ý',
          cancelButtonText: 'Hủy',
          type: 'warning',
        }
      )
        .then(() => {
          productResource
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
