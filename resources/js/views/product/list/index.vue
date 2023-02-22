<template>
  <div class="tab-container">
    <div>
      <product-list :action="true" />
    </div>
  </div>

</template>

<script>
import productList from './components/ProductList';
export default {
  name: 'ProductList',
  components: { productList },
  data() {
    return {
    };
  },
  methods: {
  },
};
</script>

<style scoped>
</style>
