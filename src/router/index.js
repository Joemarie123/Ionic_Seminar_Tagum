/* eslint-disable */ 
import { createRouter, createWebHistory } from '@ionic/vue-router';
import LandingPage from '../views/LandingPage';
import AboutPage from '../views/AboutPage';
import SignupPage from '../views/SignupPage';
import PostsPage from '../views/PostsPage';
import TabsPage from '../views/TabsPage';
import FirstPage from '../views/subviews/FirstPage';
import SecondPage from '../views/subviews/SecondPage';
import ThirdPage from '../views/subviews/ThirdPage';
import VuexPostsPage from '../views/VuexPostPage';
import VuexEditPage from '../views/VuexEditPage';
import Login from '../views/authentication/Login';
import Registration from '../views/authentication/Registration';
import Dashboard from '../views/authentication/Dashboard';
import UsersPage from '../views/crud/UsersPage';
import CreateGradePage from '../views/crud/CreateGradePage';
import AllUsers from '../views/crud/AllUsers';
import Dashboardv2 from '../views/authentication/Dashboardv2';
import MessagesPage from '../views/dashboard-v2/Messages';
import OutdoorsPage from '../views/dashboard-v2/Outdoors';
import ReportsPage from '../views/dashboard-v2/Reports';
import SchedulePage from '../views/dashboard-v2/Schedule';

const routes = [
  {
    path: '/',
    redirect: '/landing',
  },
  {
    path: '/dashboard-v2',
    name: 'Dashboardv2',
    component: Dashboardv2,
    children: [
      {
        path: '/dashboard-v2/',
        redirect: '/dashboard-v2/reports'
      },
      {
        path: '/dashboard-v2/reports',
        name: 'ReportsPage',
        component: ReportsPage,
      },
      {
        path: '/dashboard-v2/outdoors',
        name: 'OutdoorsPage',
        component: OutdoorsPage,
      },
      {
        path: '/dashboard-v2/messages',
        name: 'MessagesPage',
        component: MessagesPage,
      },
      {
        path: '/dashboard-v2/schedule',
        name: 'SchedulePage',
        component: SchedulePage,
      },
    ]
  },
  {
    path: '/all-users',
    name: 'AllUsers',
    component: AllUsers
  },
  {
    path: '/landing',
    name: 'Landing',
    component: LandingPage
  },
  {
    path: '/users',
    name: 'UsersPage',
    component: UsersPage
  },
  {
    path: '/new-grade/:user_id/:grade_id?',
    name: 'NewGradePage',
    component: CreateGradePage
  },
  {
    path:'/dashboard',
    name: 'Dashboard',
    component: Dashboard,
  },
  {
    path: '/register',
    name: 'RegistrationPage',
    component: Registration,
  },
  {
    path: '/login',
    name: 'Loginpage',
    component: Login
  },
  {
    path: '/about/:id?',
    name: 'About',
    component: AboutPage
  },
  {
    path: '/sign-up',
    name: 'SignUp',
    component: SignupPage
  },
  {
    path: '/posts',
    name: 'Posts',
    component: PostsPage
  },
  {
    path: '/vuex-posts',
    name: 'VuexPost',
    component: VuexPostsPage
  },
  {
    path: '/vuex-edit-page/:id',
    name: 'VuexEditPage',
    component: VuexEditPage
  },
  // {
  //   path: '/tabs',
  //   component: TabsPage,
  //   children: [
  //     { path: '/', redirect: '/tabs' },
  //     {
  //       path: '/tabs/first',
  //       name: 'tabs_first',
  //       component: FirstPage,
  //     },
  //     {
  //       path: '/tabs/second',
  //       name: 'tabs_second',
  //       component: SecondPage,
  //     },
  //     {
  //       path: '/tabs/third',
  //       name: 'tabs_third',
  //       component: ThirdPage,
  //     },

  //   ],
  // }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {

  if (to.name == 'Dashboard' && localStorage.getItem('auth') == null)
    next({ name: 'Loginpage'});
  else if (localStorage.getItem('auth') != null && (to.name == 'RegistrationPage' || to.name == 'Loginpage'))
    next({ name: 'Dashboard' });
  else
    next();
    
});

export default router
