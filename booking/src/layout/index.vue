<template>
  <div>
    <navbar />
    <app-main />
    <footer />
    <footer-template />
  </div>
</template>

<script>
import { AppMain, Navbar, FooterTemplate } from './components';
import ResizeMixin from './mixin/ResizeHandler';
export default {
  name: 'Layout',
  components: {
    AppMain,
    FooterTemplate,
    Navbar
  },
  mixins: [ResizeMixin],
  computed: {
  },
  created() {
  },
  methods: {
  }
}
</script>
