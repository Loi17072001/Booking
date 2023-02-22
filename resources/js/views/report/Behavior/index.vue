<template>
  <div class="tab-container">
    <behavior />
  </div>
</template>

<script>
import behavior from './components/Behavior';

export default {
  name: 'ReportBehavior',
  components: { behavior },
  data() {
    return {
    };
  },
  methods: {
    showCreatedTimes() {
      this.createdTimes = this.createdTimes + 1;
    },
  },
};
</script>

<style scoped>
.tab-container {
  margin: 30px;
}
</style>
