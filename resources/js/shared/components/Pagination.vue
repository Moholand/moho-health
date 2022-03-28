<template>
  <div class="d-flex justify-content-center mt-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li 
            class="nav-item" 
            v-for="(link, index) in links" 
            :key="`link-${index}`"
            :disabled="!link.url"
          >
            <a 
              class="nav-link active" 
              href="#" 
              @click="changeOnPage($event, link)"
              :class="[link.active ? 'bg-warning' : '',]"
              v-html="link.label"
            ></a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  props: {
    links: Object
  },
  methods: {
    changeOnPage(event, link) {
      event.preventDefault();
      
      this.$emit('getForPage', link);
    }
  }
}
</script>