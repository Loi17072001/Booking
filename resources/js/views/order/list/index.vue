<template>
  <div class="tab-container">
    <div>
      <order-list :action="true" />
    </div>
  </div>

</template>

<script>
import orderList from './components/OrderList';
export default {
  name: 'OrderList',
  components: { orderList },
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
