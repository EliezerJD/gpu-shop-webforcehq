<template>
  <div>
    <nav class="row justify-content-start" v-for="item in information" :key="item.id" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link to="/">Home</router-link>
        </li>
        <li class="breadcrumb-item"><router-link to="/products">Products</router-link></li>
        <li class="breadcrumb-item active">{{ item.name }}</li>
      </ol>
    </nav>
  </div>
</template>

<script>
export default {
  props: ['information'],
  name: 'Title'
}
</script>

<style scoped>
.breadcrumb{
  background: inherit;
}

.breadcrumb>li>a {
  text-decoration: none;
  color: #2c3539 !important;
  font-size: 18px;
}
.breadcrumb>li>a:hover {
  text-decoration: underline;
}
.breadcrumb-item {
  font-size: 16.5px;
}

.breadcrumb-item.active {
  text-decoration: none !important;
  color: #f2be00 !important;
  font-size: 16.5px;
}
</style>
