<template>
  <div class="productItemContainer">
    <LightBox
      v-if="expandThumb"
      :showThumbs="false"
      :showCaption="true"
      :media="image"
      v-on:onOpened="onOpened"
    />
    <img
      class="productItem"
      @click="showImage()"
      :src="product.image"
    /><br>
    <button
      class="snipcart-add-item addToCartButton"
      :data-item-id="product.id"
      :data-item-price="product.price"
      :data-item-url="'https://advance.jsbot.net/static/getInventoryPage.php?curPage=' + curPage"
      :data-item-description="product.description"
      :data-item-image="product.image"
      :data-item-name="product.name"
      alt="Add to cart"
    >
      Add to Cart
    </button>
  </div>
</template>
<script>
import LightBox from 'vue-image-lightbox'
require('vue-image-lightbox/dist/vue-image-lightbox.min.css')
export default {
  name: 'ProductItem',
  props: [ 'state', 'product', 'curPage' ],
  components: {
    LightBox
  },
  data () {
    return {
      expandThumb: false,
      image: []
    }
  },
  mounted () {
    this.image = [
      {
        thumb: this.product.image,
        src: this.product.image,
        caption: this.product.description
      }
    ]
  },
  methods: {
    showImage () {
      this.expandThumb = true
    },
    onOpened (val) {
      if (!val) this.expandThumb = false
    }
  }
}
</script>
<style scoped>
.addToCartButton{
  padding-left: 10px;
  padding-right: 10px;
}
.productItem{
  margin: 5px;
  border-radius: 10px;
  cursor: pointer;
  width: 200px;
}
.productItemContainer{
  display: inline-block;
  padding: 10px;
  border-radius: 10px;
  background: linear-gradient(#fff8, #766a);
  border: 1px solid #336;
  margin: 25px;
}
</style>
<style>
.vue-lb-info{
  font-size:24px !important;
  font-family: 'Oxanium' !important;
  background: #402 !important;
  height: auto !important;
  display: block !important;
  text-align: left !important;
  padding: 5px !important;
  width: auto !important;
  position: absolute !important;
  z-index: 1000 !important;
  transform: translateY(100%) !important;
}
.vue-lb-footer, .vue-lb-footer-count{
  font-family: calligraphic !important;
  background: #402 !important;
  color: #0000 !important;
}
</style>
