<template>
  <ul>
    <div>
      <div 
        class="item"
        :class="{ 'folder': isFolder }" 
        @click="itemClicked(item)"
      >
        <span v-if="isFolder" class="toggle" @click="toggle">{{ isOpen ? "-" : "+" }}</span>
        {{ item.name }}
      </div>
      <ul v-show="isOpen" v-if="isFolder">
        <tree-item
          v-for="(child, index) in item.children"
          :key="index"
          :isExpandAll="isExpandAll"
          :item="child"
          @item-click="itemClicked"
        ></tree-item>
      </ul>
    </div>
  </ul>
</template>
<script>
export default {
  name: "TreeItem",
  model: {
    event: 'item-click'
  },
  props: {
    item: Object,
    isExpandAll: Boolean,
  },
  watch: {
    isExpandAll() {
      if (this.isExpandAll) {
        this.expandAll();
      }
    }
  },
  computed: {
    isFolder() {
      return this.item.children && this.item.children.length > 0;
    }
  },
  created() {
    if (this.isExpandAll) {
      this.expandAll();
    }
  },
  data() {
    return {
      isOpen: false,
    };
  },
  methods: {
    toggle() {
      if (this.isFolder) {
        this.isOpen = !this.isOpen;
      }
    },
    expandAll() {
      this.isOpen = true;
    },
    itemClicked(item) {
      this.$emit("item-click", item);
    },
  },
};
</script>

<style lang="scss" scoped>

.item {
  padding: 10px;
  cursor: pointer;
}

.item:hover {
  background-color: #ffffff88;
}

.folder {
  font-weight: bold;
  margin-left: -13px;
}

.toggle {
  padding: 5px;
}

ul {
  padding-left: 1em;
  line-height: 1.5em;
  list-style-type: dot;
}
</style>