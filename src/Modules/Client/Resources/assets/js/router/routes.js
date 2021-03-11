import MainPage from '../pages/clients'
import Error404 from '../pages/errors/404'

export default [
    {
        path: '',
        name: 'index',
        component: MainPage
    },
    { path: '*', component: Error404 }
]
