import NotFound from './components/NotFound';
import Home from './components/Home';
import Seedling from './components/Seedling';
import GardenBeds from './components/GardenBeds';
import Inventory from './components/Inventory';
import Stats from './components/Stats';
import Logout from './components/Logout';

export default {
    mode: 'history',

    linkActiveClass: 'font-bold',

    routes: [
        {
            path: '*',
            component: NotFound
        },
        {
            path: '/home',
            component: Home
        },
        {
            path: '/seedling',
            component: Seedling,
            name: 'seedling'
        },
        {
            path: '/garden-beds',
            component: GardenBeds
        },
        {
            path: '/inventory',
            component: Inventory
        },
        {
            path: '/stats',
            component: Stats
        },
        {
            path: '/logout',
            component: Logout
        },
    ]
};