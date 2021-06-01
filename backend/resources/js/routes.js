import NotFound from './components/NotFound';
import AdminMain from './components/admin/AdminMain';
import AdminUsersIndex from "./components/admin/AdminUsers/AdminUsersIndex";
import AdminFamiliesIndex from "./components/admin/AdminFamily/AdminFamiliesIndex";
import AdminFamiliesCreate from "./components/admin/AdminFamily/AdminFamiliesCreate";
import AdminFamiliesEdit from "./components/admin/AdminFamily/AdminFamiliesEdit";
import AdminFamiliesShow from "./components/admin/AdminFamily/AdminFamiliesShow";
import AdminManufacturersIndex from "./components/admin/AdminManufakturer/AdminManufacturersIndex";
import AdminManufacturersCreate from "./components/admin/AdminManufakturer/AdminManufacturersCreate";
import AdminManufacturersEdit from "./components/admin/AdminManufakturer/AdminManufacturersEdit";
import AdminManufacturersShow from "./components/admin/AdminManufakturer/AdminManufacturersShow";
import AdminPlantsIndex from "./components/admin/AdminPlants/AdminPlantsIndex";
import AdminFeedbackIndex from "./components/admin/AdminFeedback/AdminFeedbackIndex";
import AdminSpeciesIndex from "./components/admin/AdminSpecies/AdminSpeciesIndex";
import AdminCompanionsIndex from "./components/admin/AdminCompanion/AdminCompanionsIndex";
import AdminMarketingIndex from "./components/admin/AdminMarketing/AdminMarketingIndex";
import AdminStatisticsIndex from "./components/admin/AdminStatistics/AdminStatisticsIndex";
import AdminSeeds from "./components/admin/AdminSeeds/AdminSeedsIndex";
import AdminSeedsEdit from "./components/admin/AdminSeeds/AdminSeedsEdit";
import AdminSeedsShow from "./components/admin/AdminSeeds/AdminSeedsShow";
import AdminSeedsCreate from "./components/admin/AdminSeeds/AdminSeedsCreate";




export default {
    mode: 'history',

    //linkActiveClass: 'font-bold',

    routes: [
        {
            path: '*',
            component: NotFound
        },
        {
            path: '/admin/seeds',
            name: "adminSeeds",
            component: AdminSeeds
        },
        {
            path: '/admin/seeds/:id/edit',
            name: "adminSeedsEdit",
            component: AdminSeedsEdit
        },
        {
            path: '/admin/seeds/:id/show',
            name: "adminSeedsShow",
            component: AdminSeedsShow
        },
        {
            path: '/admin/seeds/create',
            name: "adminSeedsCreate",
            component: AdminSeedsCreate
        },
        {
            path: '/admin',
            name: "admin",
            component: AdminMain
        },
        {
            path: '/admin/users',
            name: "adminUsers",
            component: AdminUsersIndex
        },
        {
            path: '/admin/families',
            name: "adminFamilies",
            component: AdminFamiliesIndex
        },
        {
            path: '/admin/families/create',
            name: "adminFamiliesCreate",
            component: AdminFamiliesCreate
        },
        {
            path: '/admin/families/:id/edit',
            name: "adminFamiliesEdit",
            component: AdminFamiliesEdit
        },
        {
            path: '/admin/families/:id/show',
            name: "adminFamiliesShow",
            component: AdminFamiliesShow
        },
        {
            path: '/admin/plants',
            name: "adminPlants",
            component: AdminPlantsIndex
        },
        {
            path: '/admin/manufacturers',
            name: "adminManufacturers",
            component: AdminManufacturersIndex
        },
        {
            path: '/admin/manufacturers/create',
            name: "adminManufacturersCreate",
            component: AdminManufacturersCreate
        },
        {
            path: '/admin/manufacturers/:id/show',
            name: "adminManufacturersShow",
            component: AdminManufacturersShow
        },
        {
            path: '/admin/manufacturers/:id/edit',
            name: "adminManufacturersEdit",
            component: AdminManufacturersEdit
        },
        {
            path: '/admin/companions',
            name: "adminCompanions",
            component: AdminCompanionsIndex
        },
        {
            path: '/admin/feedback',
            name: "adminFeedback",
            component: AdminFeedbackIndex
        },
        {
            path: '/admin/spices',
            name: "adminSpices",
            component: AdminSpeciesIndex
        },
        {
            path: '/admin/marketing',
            name: "adminMarketing",
            component: AdminMarketingIndex
        },
        {
            path: '/admin/statistics',
            name: "adminStatistics",
            component: AdminStatisticsIndex
        }
    ]
};
