<template>
  <div class="tab-container">
    <div>
      <group-list :action="true" />
    </div>
  </div>

</template>

<script>
import groupList from './components/GroupList';
export default {
  name: 'GroupList',
  components: { groupList },
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
