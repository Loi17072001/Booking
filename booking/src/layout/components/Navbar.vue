<template>
  <header class="header">
    <div class="header-top">
      <div class="container">
        <div class="row">
          <div class="col-xl-2 col-lg-2 align-self-center">
            <div class="logo logo-d-none">
              <a href="/"><img src="/assets/img/logo.png" alt="logo"></a>
            </div>
          </div>
          <div
            class="col-xl-7 col-lg-7 col-md-8 col-sm-6 col-2 align-self-center"
          >
            <div class="d-none d-lg-block">
              <div class="header-menu">
                <!--AkHAN THEKE MENU KAJ SURU-->
                <div class="header-horizontal-menu">
                  <ul class="menu-content">
                    <li>
                      <a href="/">Hệ thống đặt cơm</a>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- header menu -->
            </div>
            <!-- desktop nav -->
            <!--Mobile Nav Menu-->
            <div class="d-lg-none">
              <!--Bar-->
              <div class="logo mobile-bar-logo">
                <a href="index.html"><img src="/assets/img/logo.png" alt="logo"></a>
              </div>
              <!-- mobile logo -->
              <div class="mobile-toggle">
                <a class="mobile-menu-open" href="javascript:;">
                  <i class="fas fa-bars"></i></a>
              </div>
              <div class="mobile-off-canvas-menu">
                <div class="logo">
                  <a href="index.html"
                    ><img src="/assets/img/logo.png" alt="logo"
                  /></a>
                </div>
                <!-- mobile logo -->
                <div class="mobile-canvas-close close-mobile-menu">
                  <p>Menu <i class="fas fa-arrow-left"></i></p>
                </div>
                <div class="mobile-main-menu">
                  <ul class="menu-content">
                    <li class="menu-item-has-children active">
                      <a href="#">Home <i class="fal fa-chevron-down"></i></a>
                      <ul class="sub-menu">
                        <li><a href="index.html">Home 01</a></li>
                        <li><a href="index2.html">Home 02</a></li>
                      </ul>
                    </li>
                    <li><a href="about.html">About</a></li>
                    <li class="menu-item-has-children">
                      <a href="#">Pages<i class="fal fa-chevron-down"></i></a>
                      <ul class="mega-sub-menu">
                        <li class="menu-item-has-children">
                          <a class="menu-title" href="#">Shop Grid</a>
                          <ul class="submenu-item">
                            <li><a href="shop.html">Shop Grid Right</a></li>
                            <li>
                              <a href="shop_left.html">Shop Grid Left</a>
                            </li>
                          </ul>
                        </li>
                        <li class="menu-item-has-children">
                          <a class="menu-title" href="#">Service</a>
                          <ul class="submenu-item">
                            <li><a href="service.html">Service</a></li>
                            <li>
                              <a href="service_details.html">service Details</a>
                            </li>
                          </ul>
                        </li>
                        <li class="menu-item-has-children">
                          <a class="menu-title" href="#">Shop Single</a>
                          <ul class="submenu-item">
                            <li><a href="team.html">team</a></li>
                            <li><a href="cart.html">cart</a></li>
                            <li><a href="checkout.html">Checkout</a></li>
                            <li><a href="wishlist.html">Wishlist</a></li>
                            <li><a href="login.html">login</a></li>
                            <li><a href="register.html">Registrtion</a></li>
                          </ul>
                        </li>
                        <li class="menu-item-has-children">
                          <a class="menu-title" href="#">Gallery</a>
                          <ul class="submenu-item">
                            <li><a href="gallery.html">gallery</a></li>
                            <li>
                              <a href="gallery.html"> Gallery Details</a>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li class="menu-item-has-children">
                      <a href="blog.html"
                        >Blog <i class="fal fa-chevron-down"></i
                      ></a>
                      <ul class="sub-menu">
                        <li class="menu-item-has-children">
                          <a href="blog.html"
                            >Blog Grid <i class="fal fa-chevron-right"></i
                          ></a>
                          <ul class="sub-menu">
                            <li><a href="#">Blog Grid Left Slider</a></li>
                            <li><a href="#">Blog Grid Right Slider</a></li>
                          </ul>
                        </li>
                        <li class="menu-item-has-children">
                          <a href="#"
                            >Blog List <i class="fal fa-chevron-right"></i
                          ></a>
                          <ul class="sub-menu">
                            <li><a href="#">Blog List Left Slider</a></li>
                            <li><a href="#">Blog List Right Slider</a></li>
                          </ul>
                        </li>
                        <li class="menu-item-has-children">
                          <a href="#"
                            >Blog Single <i class="fal fa-chevron-right"></i
                          ></a>
                          <ul class="sub-menu">
                            <li><a href="#">Blog Single Left Slider</a></li>
                            <li><a href="#">Blog Single Right Slider</a></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li><a href="contact.html">Contact</a></li>
                  </ul>
                </div>
                <!-- mobile main menu -->
              </div>
              <!-- mobile off canvas menu -->

              <div class="overlay"></div>
            </div>
          </div>
          <div
            class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-10 align-self-center"
          >
            <div class="list-area-cart-user">
              <ul>
                <li>
                  <a href="javascript:void(0)" id="search-btn"
                    ><i class="fas fa-search"></i
                  ></a>
                </li>
                <li>
                  <a href="wishlist.html"
                    ><i class="far fa-heart"></i> <span>5</span></a
                  >
                </li>
                <li>
                  <a href="javascript:void(0)" id="cart-btn"
                    ><i class="fas fa-cart-arrow-down"></i> <span>5</span></a
                  >
                </li>
                <li>
                  <a href="javascript:void(0)" id="login-btn"
                    ><i class="fas fa-user"></i
                  ></a>
                </li>
              </ul>
            </div>

            <form action="#" class="search-form">
              <input
                type="search"
                class="form-control"
                id="search-box"
                placeholder="search here..."
              />
              <button class="fas fa-search"></button>
            </form>

            <div class="mini-cart-side">
              <div class="cart-header">
                <h4>Shopping Cart</h4>
                <div class="clse">
                  <a href="javascript:void(0)" id="close-btn"
                    ><i class="fas fa-times"></i
                  ></a>
                </div>
              </div>
              <div class="shopping-box">
                <img src="/assets/img/minicart/1.png" alt="png" />
                <div class="box-content">
                  <h5>Italian cuisine</h5>
                  <span>$600X2</span>
                </div>
                <div class="remove">
                  <a href="#"><i class="fas fa-times"></i></a>
                </div>
              </div>
              <div class="shopping-box">
                <img src="/assets/img/minicart/2.png" alt="png" />
                <div class="box-content">
                  <h5>Japani Pizza</h5>
                  <span>$600X2</span>
                </div>
                <div class="remove">
                  <a href="#"><i class="fas fa-times"></i></a>
                </div>
              </div>
              <div class="shopping-box">
                <img src="/assets/img/minicart/3.png" alt="png" />
                <div class="box-content">
                  <h5>Barcon Pizza</h5>
                  <span>$600X2</span>
                </div>
                <div class="remove">
                  <a href="#"><i class="fas fa-times"></i></a>
                </div>
              </div>
              <div class="min-price">
                <h4>subtotal:</h4>
                <span>$5550</span>
              </div>
              <div class="button-bar pt-20 text-center">
                <a href="#" class="btn btn-lg">
                  <span>View Cart</span>
                </a>
              </div>
            </div>
            <div class="login-form">
              <div class="form-container">
                <div class="close-lgn">
                  <a href="javascript:void(0)" id="close-login"
                    ><i class="fas fa-times"></i
                  ></a>
                </div>
                <div class="form-icon"><i class="fa fa-user"></i></div>
                <h3 class="title">Login</h3>
                <form class="form-horizontal">
                  <div class="form-group">
                    <label>email</label>
                    <input
                      class="form-control"
                      type="email"
                      placeholder="email address"
                    />
                  </div>
                  <div class="form-group">
                    <label>password</label>
                    <input
                      class="form-control"
                      type="password"
                      placeholder="password"
                    />
                  </div>
                  <button type="button" class="btn btn-default">Login</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  components: {},
  computed: {
    ...mapGetters(['sidebar', 'avatar', 'device']),
  },
  methods: {
    toggleSideBar() {
      this.$store.dispatch('app/toggleSideBar');
    },
    async logout() {
      await this.$store.dispatch('user/logout');
      this.$router.push(`/login?redirect=${this.$route.fullPath}`);
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
