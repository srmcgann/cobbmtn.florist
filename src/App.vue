<template>
  <div id="app" ref="app">
    <video
      v-if="1"
      muted
      autoPlay
      loop
      :src="backgroundVid"
      class="bgVid"
      ref="bgVid"
    ></video>
    <Header :state="state" />
    <Storefront :state="state" />
    <Footer :state="state" />
  </div>
</template>

<script>
import Header from './components/Header'
import Storefront from './components/Storefront'
import Footer from './components/Footer'
require('vue-image-lightbox/dist/vue-image-lightbox.min.css')

export default {
  name: 'App',
  components: {
    Header,
    Storefront,
    Footer
  },
  data () {
    return {
      backgroundVid: 'https://jsbot.cantelope.org/uploads/' + [
        '23mFub',
        '1uU1gB',
        '1JCKqo',
        '1v6y5J',
        '8wE6n',
        '2dZdUK',
        '1eKqeW',
        '1CMU',
        '1MGDlY',
        '1h6t3k',
        '1H5GK9',
        '15K4kB',
        '1xjEmZ',
        //'SK9Ks',
        'Ofbwa'
      ][Math.random()*14|0] + '.mp4',
      state: [
        {
          siteEntered: false,
          vidLoaded: false,
          baseURL: 'https://cobbmtn.florist',
          video: ''
        }
      ]
    }
  },
  watch: {
    "state.siteEntered"(val){
      if(val){
        //document.body.className += ' applyBG'
        this.$refs.bgVid.className += ' show'
      }
    }
  },
  methods: {
  },
  mounted() {
    this.state.body = document.body
  }
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Crafty+Girls&family=Swanky+and+Moo+Moo&display=swap');
.show{
  opacity: 1 !important;
}
.bgVid{
  opacity: 0;
  position: fixed;
  min-width: 100%;
  min-height: 100%;
  left:50%;
  top:50%;
  transform: translate(-50%,-50%);
  transition: opacity 1s;
  pointer-events: none;
}
#app{
  position: fixed;
  text-align: center;
  width: 100vw;
  height: 100vh;
  overflow-y: scroll;
  overflow-x: hidden;
  padding-right: 17px;
  box-sizing: content-box;
}
.applyBG{
  background-image: url(https://jsbot.cantelope.org/uploads/1Jiczn.jpg);
  background-position: center;
  background-repeat: repeat;
}
.contentWrap{
  display: flex;
  padding-bottom: 75px;
  width: 100%;
  justify-content: center;
}
body, html {
  position: absolute;
  margin: 0;
  width: 100vw;
  overflow: hidden;
  height: 100vh;
  background: #57a;
  font-family: 'Crafty Girls';
}
.headerLogo{
  position: relative;
  top: 45vh;
  transform: translateY(-50%);
  width: 35%;
}
.snipcart-modal__container{
  z-index: 200;
}
input{
  font-family: 'Oxanium';
}
button{
  cursor: pointer;
  margin: 5px;
  padding: 2px;
  border-radius: 10px;
  background: #fff;
  border: 4px solid #f28c;
  font-weight: 900;
  color: #204;
  font-size: 30px;
  height: 55px;
  font-family: 'Oxanium';
}
button:focus {
  outline: 0;
}
</style>
