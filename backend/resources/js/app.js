/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'
import Vue from 'vue'
import EffortLike from './components/EffortLike'
import FollowButton from './components/FollowButton'
import BarChart from './components/BarChart'

// document.querySelector('.image-picker input')
//       .addEventListener('change', (e) => {
//           const input = e.target;
//           const reader = new FileReader();
//           reader.onload = (e) => {
//               input.closest('.image-picker').querySelector('img').src = e.target.result
//           };
//           reader.readAsDataURL(input.files[0]);
//       });

const app = new Vue({
	el: '#app',
	components: {
		EffortLike,
		FollowButton,
		BarChart,
	}
})

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
