<template>
  <div class="app-container">
    <div class="filter-container">
      <el-input
        v-model="query.keyword"
        :placeholder="'Tìm kiếm'"
        style="width: 200px"
        class="filter-item"
        clearable
        @keyup.enter.native="handleFilter"
      />
      <el-date-picker
        v-model="query.dateSelected"
        class="filter-item"
        type="date"
        :clearable="false"
        placeholder="Chọn ngày"
        :picker-options="pickerOptions"
        @change="handleFilter"
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
        @click="handleCreateMenu"
      >
        Thêm mới
      </el-button>
      <el-button
        class="filter-item"
        style="margin-left: 10px"
        type="primary"
        icon="el-icon-edit"
        @click="handleEditMenu"
      >
        Sửa menu
      </el-button>
      <el-button
        class="filter-item"
        style="margin-left: 10px"
        type="danger"
        icon="el-icon-delete"
        @click="handleDeleteMenu"
      >
        Xóa menu
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
      <el-table-column align="center" label="Hình ảnh" width="130">
        <template slot-scope="scope">
          <el-avatar v-if="scope.row.product.images && scope.row.product.images.length > 0" shape="square" :size="100" :fit="'contain'" :src="scope.row.product.images[0]" />
        </template>
      </el-table-column>
      <el-table-column align="center" label="Tên">
        <template slot-scope="scope">
          <span>{{ scope.row.product.name }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="Nhóm">
        <template slot-scope="scope">
          <span v-if="scope.row.product.group_data.name">{{ scope.row.product.group_data.name }}</span>
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
    </el-table>

    <pagination
      v-show="total > 0"
      :total="total"
      :page.sync="query.page"
      :limit.sync="query.limit"
      @pagination="getList"
    />
    <el-dialog
      width="95%"
      :title="'Tạo mới menu'"
      :top="'0vh'"
      :visible.sync="dialogCreateMenuVisible"
      :destroy-on-close="true"
      :show-close="true"
      :close-on-click-modal="false"
    >
      <div v-loading="menuCreating" class="form-container">
        <el-form
          ref="menuForm"
          :rules="menuModel.isUpdate ? menuEditRules : menuRules"
          :model="menuModel"
          label-width="150px"
        >
          <el-form-item label="Ngày áp dụng" prop="date">
            <div class="d-flex justify-content-between">
              <el-date-picker
                v-if="!menuModel.isUpdate"
                v-model="menuModel.date"
                type="daterange"
                align="right"
                unlink-panels
                range-separator="-"
                start-placeholder="Ngày bắt đầu"
                end-placeholder="Ngày kết thúc"
                :picker-options="pickerOptionsRange"
              />
              <el-date-picker
                v-if="menuModel.isUpdate"
                v-model="query.dateSelected"
                type="date"
                align="right"
                :disabled="true"
                :picker-options="pickerOptions"
              />
              <div>
                <el-button type="primary" @click="createMenu"> Lưu </el-button>
                <el-button @click="dialogCreateMenuVisible = false;"> Hủy </el-button>
              </div>
            </div>
          </el-form-item>
          <div class="w-100" style="marign: auto;">
            <div v-for="(gr, index) in groups" :key="gr.id" class="block-menu">
              <el-divider>
                <div style="font-size: 25px; color: chartreuse;">
                  <i class="el-icon-star-on" />
                  <i class="el-icon-star-on" />
                  <i class="el-icon-star-on" />
                  <i class="el-icon-star-on" />
                  {{ gr.name }}
                  <i class="el-icon-star-on" />
                  <i class="el-icon-star-on" />
                  <i class="el-icon-star-on" />
                  <i class="el-icon-star-on" />
                </div>
              </el-divider>
              <el-transfer
                v-if="reloadDataEdit"
                v-model="groups[index].productSelected"
                :data="gr.products"
                :props="{
                  key: '_id',
                  label: 'name',
                  price_discount: 'price_discount'
                }"
                filterable
                :titles="[gr.name, 'Menu - ' + gr.name]"
                :button-texts="['', '']"
                :format="{
                  noChecked: 'Tổng số: ${total}',
                  hasChecked: 'Đã chọn ${checked}/${total}'
                }"
                style="text-align: left; display: inline-block; margin-bottom: 20px;"
                @change="handleChangeMenu"
              >
                <span slot-scope="{ option }">
                  <div class="d-start">
                    <el-avatar
                      v-if="option.images && option.images.length > 0"
                      shape="square"
                      :size="50"
                      :fit="'contain'"
                      :src="option.images[0]"
                    />
                    <span class="d-start" style="padding-left: 5px; height: 50px; width: 50%;">
                      {{ option.name }}
                    </span>
                    <el-input v-model="option.price_discount" v-mask="currencyMask" style="width: 30%;" />
                  </div>
                </span>
              </el-transfer>
            </div>
          </div>
        </el-form>
        <div slot="footer" class="dialog-footer" style="text-align: right">
          <el-button type="primary" @click="createMenu"> Lưu </el-button>
          <el-button @click="dialogCreateMenuVisible = false;"> Hủy </el-button>
        </div>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import waves from '@/directive/waves'; // Waves directive
import MenuResource from '@/api/menu';
import GroupResource from '@/api/group';
import createNumberMask from 'text-mask-addons/dist/createNumberMask';
import { toThousandFilter } from '../../../../utils/index';
import moment from 'moment';
const groupResource = new GroupResource();
const menuResource = new MenuResource();
const currencyMask = createNumberMask({
  prefix: '',
  suffix: '',
  allowDecimal: true,
  includeThousandsSeparator: true,
  allowNegative: false,
});

export default {
  name: 'MenuList',
  components: { Pagination },
  directives: { waves },
  data() {
    return {
      currencyMask,
      list: null,
      menuModel: {
        price: 0,
        price_discount: 0,
      },
      total: 0,
      loading: true,
      pickerOptionsRange: {
        shortcuts: [{
          text: 'Tuần tới',
          onClick(picker) {
            const end = new Date();
            const start = new Date();
            end.setTime(start.getTime() + 3600 * 1000 * 24 * 7);
            picker.$emit('pick', [start, end]);
          },
        }, {
          text: 'Tháng tới',
          onClick(picker) {
            const end = new Date();
            const start = new Date();
            end.setTime(start.getTime() + 3600 * 1000 * 24 * 30);
            picker.$emit('pick', [start, end]);
          },
        }, {
          text: '3 tháng',
          onClick(picker) {
            const end = new Date();
            const start = new Date();
            end.setTime(start.getTime() + 3600 * 1000 * 24 * 90);
            picker.$emit('pick', [start, end]);
          },
        }],
      },
      pickerOptions: {
        disabledDate(time) {
          return time.getTime() <= moment().subtract(1, 'days').endOf('day');
        },
        shortcuts: [{
          text: 'Hôm nay',
          onClick(picker) {
            picker.$emit('pick', new Date());
          },
        }, {
          text: 'Ngày mai',
          onClick(picker) {
            const date = new Date();
            date.setTime(date.getTime() + 3600 * 1000 * 24);
            picker.$emit('pick', date);
          },
        }, {
          text: 'Tuần tới',
          onClick(picker) {
            const date = new Date();
            date.setTime(date.getTime() + 3600 * 1000 * 24 * 7);
            picker.$emit('pick', date);
          },
        }],
      },
      menuRules: {
        date: [
          {
            required: true,
            message: 'Hãy nhập thời gian áp dụng menu',
            trigger: 'change',
          },
        ],
      },
      menuEditRules: {
      },
      query: {
        dateSelected: new Date(),
        page: 1,
        limit: 10,
        keyword: '',
      },
      groups: [
        {
          productSelected: [],
        },
      ],
      menuCreating: false,
      dialogCreateMenuVisible: false,
      reloadDataEdit: true,
    };
  },
  computed: {},
  created() {
    this.getList();
    this.getGroups();
  },
  methods: {
    handleChangeMenu() {
      this.$nextTick(() => {
        this.reloadDataEdit = false;
        this.reloadDataEdit = true;
      });
    },
    async getGroups() {
      const { data } = await groupResource.search({});
      this.groups = data;
      this.groups.forEach(gr => {
        gr.productSelected = [];
        gr.products.forEach(prod => {
          prod.price_discount = toThousandFilter(prod.price_discount);
        });
      });
    },
    async getList() {
      const { limit, page } = this.query;
      this.loading = true;
      if (this.query.dateSelected) {
        this.query.date = this.query.dateSelected.toLocaleDateString('vi');
      }
      const { data, meta } = await menuResource.search(this.query);
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
      this.menuModel = {
        price: 0,
        price_discount: 0,
      };
    },
    async handleCreateMenu() {
      this.resetData();
      await this.getGroups();
      this.dialogCreateMenuVisible = true;
      this.$nextTick(() => {
        this.$refs['menuForm'].clearValidate();
      });
    },
    async handleEditMenu() {
      this.resetData();
      await this.getGroups();
      this.dialogCreateMenuVisible = true;
      this.menuModel.isUpdate = true;
      if (this.list.length > 0) {
        this.groups.forEach(gr => {
          if (!gr.productSelected) {
            gr.productSelected = [];
          }
          gr.products.forEach(grPrd => {
            this.list.forEach(prod => {
              if (prod.product_id === grPrd._id) {
                gr.productSelected.push(prod.product_id);
              }
            });
          });
        });
      }
      this.$nextTick(() => {
        this.$refs['menuForm'].clearValidate();
      });
    },
    enumerateDaysBetweenDates(startDate, endDate) {
      var dates = [];
      var currDate = moment(startDate).endOf('day');
      var lastDate = moment(endDate).endOf('day');
      dates.push(currDate.clone().toDate());
      while (currDate.add(1, 'days').diff(lastDate) <= 0) {
        dates.push(currDate.clone().toDate());
      }
      return dates;
    },
    createMenu() {
      console.log(this.groups);
      this.$refs['menuForm'].validate((valid) => {
        if (valid) {
          // convert data
          const dataMenu = [];
          this.groups.forEach(gr => {
            if (gr.productSelected) {
              gr.productSelected.forEach(prodSelected => {
                const prd = gr.products.find(({ _id }) => _id === prodSelected);
                dataMenu.push(
                  {
                    product_id: prodSelected,
                    price: prd.price ? prd.price.replaceAll(',', '') : 0,
                    price_discount: prd.price_discount ? prd.price_discount.replaceAll(',', '') : 0,
                    qty: 9999,
                  }
                );
              });
            }
          });
          let range;
          if (this.menuModel.isUpdate) {
            range = this.query.dateSelected.toLocaleDateString('vi');
          } else {
            range = this.enumerateDaysBetweenDates(this.menuModel.date[0], this.menuModel.date[1]);
          }
          const dataRegister = { date: range, data: dataMenu, isUpdate: this.menuModel.isUpdate };
          this.menuCreating = true;
          menuResource
            .store(dataRegister)
            .then((response) => {
              const message = this.menuModel.isUpdate ? 'Chỉnh sửa' : 'Tạo mới' + ' thực đơn thành công.';
              this.$message({
                message: message,
                type: 'success',
                duration: 3 * 1000,
              });
              this.resetData();
              this.menuCreating = false;
              this.dialogCreateMenuVisible = false;
              this.handleFilter();
              this.getGroups();
            })
            .catch((error) => {
              console.log(error);
            })
            .finally(() => {
              this.menuCreating = false;
            });
        } else {
          return false;
        }
      });
    },
    handleDeleteMenu() {
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
          const data = { date: this.query.dateSelected.toLocaleDateString('vi') };
          menuResource
            .destroyByDate(data)
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
.block-menu {
  width: 100%;
  margin-bottom: 30px;
  border: 1px solid #656464;
}
.el-transfer-panel__item {
  height: 60px !important;
  margin-right: 5px !important;
}
.el-transfer-panel__item .el-checkbox__input {
  display: none;
}
.el-transfer-panel .el-transfer-panel__header {
    background: #9b672b59;
    color: #f31f1f;
}
.el-transfer {
  width: 100%;
}
.el-transfer-panel {
    width: calc(50% - 69px);
    border: 1px solid #656464;
}
.el-transfer__buttons {
    padding: 0px 5px;
}
.el-upload-list {
    background-color: #29282800;
}
.el-upload--picture-card {
  width: 148px !important;
}
</style>
