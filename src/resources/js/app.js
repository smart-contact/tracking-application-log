require('./bootstrap');
import Vue from 'vue';
import Routes from './routes';
import VueRouter from 'vue-router';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faEye, faArrowLeft, faSearch, faSpinner, faDownload, faUndoAlt, faTable } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import VueTailwind from 'vue-tailwind'
import Card from './components/Card';
import Loading from './components/Loading';
import Badge from './components/Badge';
import ScIcon from './components/ScIcon';
import DataNotFound from './components/DataNotFound';
Vue.use(VueRouter)
const settings = {
  TPagination: {
    classes: {
      wrapper: 'table border-collapse text-center bg-white mx-auto mt-2',
      element: 'w-8 h-8 border table-cell',
      disabledElement: 'w-8 h-8 border table-cell',
      ellipsisElement: 'w-8 h-8 border table-cell',
      activeButton: 'bg-gray-300 w-full h-full',
      disabledButton: 'opacity-25 w-full h-full cursor-not-allowed',
      button: 'hover:bg-gray-200 w-full h-full',
      ellipsis: ''
    },
    variants: {
      rounded: {
        wrapper: 'flex',
        element: 'w-8 h-8 mx-1',
        disabledElement: 'w-8 h-8 mx-1',
        ellipsisElement: 'w-8 h-8 mx-1',
        activeButton: 'bg-blue-500 w-full h-full text-white rounded-full ',
        disabledButton: 'opacity-25 w-full h-full cursor-not-allowed rounded-full',
        button: 'hover:bg-blue-100 w-full h-full text-blue-500 rounded-full ',
        ellipsis: 'text-gray-500'
      }
    }
  }
}

Vue.use(VueTailwind, settings);

library.add(faEye, faArrowLeft, faSearch, faSpinner, faDownload, faUndoAlt, faTable )

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('card', Card)
Vue.component('loading', Loading)
Vue.component('badge', Badge)
Vue.component('ScIcon', ScIcon)
Vue.component('DataNotFound', DataNotFound)
Vue.prototype.openNav = function() {
  if(this.$refs.LeftDrawer.active){
      this.$refs.LeftDrawer.close();
  }else{
      this.$refs.LeftDrawer.open();
  }

};
Vue.prototype.closeNav = function() {
  this.$refs.LeftDrawer.close();
};

const router = new VueRouter({
    routes: Routes,
    mode: 'hash',
    base: '/',
});

var app = new Vue({
    el: '#tracking-application-log',
    router,
    data: {
      message: 'Hello Vue!'
    },
  })