<template>
  <section class="product-item-area section-padding">
    <div class="container">
      <div class="row" style="min-height: 250px;">
        <div class="col-lg-3 col-md-4">
          <div
            v-if="group"
            class="offer-single"
            :style="'background: url(' + group.images[0] + ')'"
          >
            <div class="offer-text">
              <h2>{{ group.name }}</h2>
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-8">
          <div class="row">
            <div v-for="product in products" :key="product.id" class="col-lg-4 col-md-4">
              <div class="single-prd-item">
                <span>
                  <div class="item-single">
                    <div class="item-img">
                      <a href="#"><img :src="product.product.images[0]" alt="1.jpg"></a>
                    </div>
                    <div class="item-text">
                      <a href="product-details.html">{{ product.product.name }}</a>
                      <ul class="mt-stars">
                        <li><i class="fa fa-star" /></li>
                        <li><i class="fa fa-star" /></li>
                        <li><i class="fa fa-star" /></li>
                        <li><i class="fa fa-star" /></li>
                        <li><i class="fa fa-star" /></li>
                      </ul>
                      <i class="fas fa-cart-arrow-down cart-button-add" />
                      <div class="item-price">
                        <del>{{ product.product.price | VMask(currencyMask) }}đ</del>
                        <span class="price">{{ (product.price - product.price_discount) | VMask(currencyMask) }}đ </span>
                      </div>
                    </div>
                  </div>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import createNumberMask from 'text-mask-addons/dist/createNumberMask';
const currencyMask = createNumberMask({
  prefix: '',
  suffix: '',
  allowDecimal: true,
  includeThousandsSeparator: true,
  allowNegative: false,
});
export default {
  name: 'Product',
  components: {},
  props: {
    products: {
      type: Array,
      default: () => {
        return [];
      },
    },
    group: {
      type: Object,
      default: () => {
        return {}
      }
    }
  },
  data() {
    return {
      currencyMask,
      query: {
        page: 1,
        limit: 10000,
      },
    }
  },
  watch: {
    products() {
    },
  },
  created() {
  },
  mounted() {},
  destroyed() {},
  methods: {

  }
}
</script>
