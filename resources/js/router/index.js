import HomePage from '../views/Home'
import AboutPage from '../views/About'

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomePage
    },
    {
        path: '/about',
        name: 'about',
        component: AboutPage
    },
]



export default routes;