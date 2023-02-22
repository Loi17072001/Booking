<template>
  <div>
    <section class="banner-slider-area">
      <div class="slider-area-full owl-carousel owl-theme">
        <div
          class="silder-single silder-single-img"
          style="background: url('assets/img/banner/sl3.jpg')"
        >
          <div class="container">
            <div class="row">
              <div class="col-lg-7 col-md-12 col-sm-12">
                <div class="slider-single-full">
                  <h4>Organic products for your</h4>
                  <h2>Hamburger Pasta & Italian cuisine <span>Pizza</span></h2>
                  <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  </p>
                  <div class="button-bar pt-20">
                    <a href="#" class="btn btn-lg btn-1">
                      <span>Shop Now</span>
                    </a>
                    <a href="#" class="btn btn-lg">
                      <span>Shop Now</span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-md-12">
                <div class="hero-slider-img">
                  <img
                    class="image-1"
                    src="assets/img/banner/hr1.jpg"
                    alt="hr"
                  >
                  <img
                    class="image-2"
                    src="assets/img/banner/hr5.jpg"
                    alt="htr"
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          class="silder-single silder-single-img"
          style="background: url('assets/img/banner/sl2.jpg')"
        >
          <div class="container">
            <div class="row">
              <div class="col-lg-7 col-md-12 col-sm-12">
                <div class="slider-single-full">
                  <h4>Organic products for your</h4>
                  <h2>Mouthwatering Pizza And Barcon <span>Burger</span></h2>
                  <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  </p>
                  <div class="button-bar pt-20">
                    <a href="#" class="btn btn-lg btn-1">
                      <span>Shop Now</span>
                    </a>
                    <a href="#" class="btn btn-lg">
                      <span>Shop Now</span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-md-12">
                <div class="hero-slider-img">
                  <img
                    class="image-1"
                    src="assets/img/banner/hr1.jpg"
                    alt="hr"
                  >
                  <img
                    class="image-2"
                    src="assets/img/banner/hr3.jpg"
                    alt="htr"
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          class="silder-single silder-single-img"
          style="background: url('assets/img/banner/sr4.jpg')"
        >
          <div class="container">
            <div class="row">
              <div class="col-lg-7 col-md-12 col-sm-12">
                <div class="slider-single-full">
                  <h4>Organic products for your</h4>
                  <h2>Pasta Italian cuisine <span>Franche Fries</span></h2>
                  <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  </p>
                  <div class="button-bar pt-20">
                    <a href="#" class="btn btn-lg btn-1">
                      <span>Shop Now</span>
                    </a>
                    <a href="#" class="btn btn-lg">
                      <span>Shop Now</span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-md-12">
                <div class="hero-slider-img">
                  <img
                    class="image-1"
                    src="assets/img/banner/hr2.jpg"
                    alt="hr"
                  >
                  <img
                    class="image-2"
                    src="assets/img/banner/hr3.jpg"
                    alt="htr"
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- categorys -->
    <span v-for="(products, index) in menus" :key="index">
      <product :products="products" :group="products[0].group" />
    </span>
    <!-- phone-contact -->
    <section
      class="phone-contact"
      style="background: url('assets/img/about/time.jpg')"
    >
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="call-now">
              <h4>Any Have a Quesitons</h4>
              <h3>+0972053951 kkkdasd</h3>
              <div class="button-bar pt-20">
                <a href="#" class="btn btn-lg btn-1">
                  <span>Make A Call</span>
                </a>
                <a href="#" class="btn btn-lg">
                  <span>Contact Us</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- newsletters -->
    <section
      class="Newsletter-area"
      style="background: url('assets/img/blog/news.jpg')"
    >
      <div class="container">
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="subcribe-content">
              <h3>Subscribe to our weakly Newsletter</h3>
              <p>Lorem ipsum dolor sit amet, consectetur, adipisicing elit.</p>
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-6 align-self-center">
            <div class="subscribe">
              <input type="search" placeholder="Enter Email">
              <input type="submit" value="subscribe">
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<!-- <script>
import Product from './components/product.vue'
import ProductResource from '@/api/product.js'
import MenuResource from '@/api/menu.js'
import _ from 'lodash';
const productResource = new ProductResource();
const menuResource = new MenuResource();
export default {
  name: 'Home',
  components: { Product },
  data() {
    return {
      menus: [],
      group: []
    }
  },
  watch: {},
  async created() {
    await this.getListMenu();
  },
  mounted() {},
  destroyed() {},
  methods: {
    async getListProduct() {
      const { data } = await productResource.list(this.query);
      console.log(data);
    },
    async getListMenu() {
      const { data } = await menuResource.list(this.query);
      this.menus = [];
      let m = null;
      const array = [];
      data.forEach(d => {
        m = { ...d };
        m.group_id = d.product.group_data._id;
        m.group = d.product.group_data;
        array.push(m);
      });
      this.menus = _.groupBy(array, 'group_id')
      console.log(this.menus);
    }
  }
}
</script> -->
