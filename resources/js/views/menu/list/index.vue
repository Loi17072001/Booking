<template>
  <div class="tab-container">
    <div>
      <menu-list :action="true" />
    </div>
  </div>

</template>

<script>
import menuList from './components/MenuList';
export default {
  name: 'MenuList',
  components: { menuList },
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
