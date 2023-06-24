import Home from './components/Home.vue';
import Example from './components/ExampleComponent.vue';
export const routes = [
    { path: '/', component: Home, name: 'Home' },
    { path: '/example', component: Example, name: 'Example' }
];