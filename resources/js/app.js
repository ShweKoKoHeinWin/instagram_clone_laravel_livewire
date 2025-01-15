import './bootstrap';

import { livewire_hot_reload } from 'virtual:livewire-hot-reload'
livewire_hot_reload();

// import Alpine from 'alpinejs';
// when video is out of viewpoint it stop
import intersect from '@alpinejs/intersect'

import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/pagination';

window.Swiper = Swiper;
window.Navigation = Navigation;
window.Pagination = Pagination;

Alpine.plugin(intersect)
// window.Alpine = Alpine;

// Alpine.start();



