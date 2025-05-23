import { authStore } from "../store/auth";

const AuthenticatedLayout = () => import('../layouts/Authenticated.vue')
const AuthenticatedUserLayout = () => import('../layouts/AuthenticatedUser.vue')
const GuestLayout = ()  => import('../layouts/Guest.vue');

async function requireLogin(to, from, next) {
    const auth = authStore();
    let isLogin = !!auth.authenticated;

    if (isLogin) {
        next()
    } else {
        next('/login')
    }
}

function hasAdmin(roles) {
    for (let rol of roles) {
        if (rol.name && rol.name.toLowerCase().includes('admin')) {
            return true;
        }
    }
    return false;
}
async function guest(to, from, next) {
    const auth = authStore()

    let isLogin = !!auth.authenticated;

    if (isLogin) {
        next('/')
    } else {
        next()
    }
}

async function requireAdmin(to, from, next) {

    const auth = authStore();
    let isLogin = !!auth.authenticated;
    let user = auth.user;

    if (isLogin) {
        if( hasAdmin(user.roles)){
            next()
        }else{
            next('/panelusuario')
        }
    } else {
        next('/login')
    }
}

export default [
    {
        path: '/',
        // redirect: { name: 'login' },
        component: GuestLayout,
        children: [

            {
                path: '/',
                name: 'home',
                component: () => import('../views/home/index.vue'),
            },
            {
                path: 'login',
                name: 'auth.login',
                component: () => import('../views/login/Login.vue'),
                beforeEnter: guest,
            },
            {
                path: 'register',
                name: 'auth.register',
                component: () => import('../views/register/index.vue'),
                beforeEnter: guest,
            },
            {
                path: 'register/empresa',
                name: 'auth.register.empresa',
                component: () => import('../views/register/indexempresa.vue'),
                beforeEnter: guest,
            },
            {
                path: 'forgot-password',
                name: 'auth.forgot-password',
                component: () => import('../views/auth/passwords/Email.vue'),
                beforeEnter: guest,
            },
            {
                path: 'reset-password/:token',
                name: 'auth.reset-password',
                component: () => import('../views/auth/passwords/Reset.vue'),
                beforeEnter: guest,
            },
          {
                path: 'inmuebles',
                name: 'list-inmubles',
                component: () => import('../views/inmuebles/showHomes.vue'),   
            },
            {
                path: 'panelusuario',
                name: 'user.panel',
                component: () => import('../views/user/panelusuario.vue'),
                beforeEnter: requireLogin,
                meta: { breadCrumb: 'Panel Usuario' },
            },
            {
                path: 'preciocasa',
                name: 'preciocasa',
                component: () => import('../views/calculadoras/preciocasa.vue'),
            },
            {
                path: 'hipoteca',
                name: 'hipoteca',
                component: () => import('../views/calculadoras/hipoteca.vue'),
            },
            {
                path: 'inmuebles',
                path: 'inmuebles',
                name: 'list-inmubles',
                component: () => import('../views/inmuebles/showHomes.vue'),   
            },
            {
                path: 'inmobiliaria/:id',
                name: 'inmobiliaria',
                component: () => import('../views/inmuebles/inmobiliaria.vue'),
                meta: { breadCrumb: 'Inmobiliaria' },
            },
            {
                path: 'vivienda/:id',
                name: 'vivienda.details',
                component: () => import('../components/DetallesVivienda.vue'),
                meta: { breadCrumb: 'Detalles Vivienda' }
            },
              
            {
                path: 'misPropiedades',
                name: 'user.misPropiedades',
                component: () => import('../views/user/misPropiedades.vue'),
                beforeEnter: requireLogin,
                meta: { breadCrumb: 'Mis Propiedades' }
            },

            {
                path: 'favoritos',
                name: 'user.favoritos',
                component: () => import('../views/user/favoritos.vue'),
                beforeEnter: requireLogin,
                meta: { breadCrumb: 'Mis Propiedades' }
            },

            {
                path: 'notificaciones',
                name: 'user.notificaciones',
                component: () => import('../views/user/notificaciones.vue'),
                beforeEnter: requireLogin,
                meta: { breadCrumb: 'Notificaciones' }
            },
        ]
    },

    {
        path: '/app',
        component: AuthenticatedUserLayout,
        // redirect: {
        //     name: 'admin.index'
        // },
        name: 'app',
        beforeEnter: requireLogin,
        meta: { breadCrumb: 'Dashboard' }
    },


    {
        path: '/admin',
        component: AuthenticatedLayout,
        // redirect: {
        //     name: 'admin.index'
        // },
        beforeEnter: requireAdmin,
        meta: { breadCrumb: 'Dashboard' },
        children: [
            {
                name: 'admin.index',
                path: '',
                component: () => import('../views/admin/index.vue'),
                meta: { breadCrumb: 'Admin' }
            },
            {
                name: 'viviendas',
                path: 'viviendas',
                meta: { breadCrumb: 'Viviendas' },
                children: [
                    {
                        name: 'viviendas.index',
                        path: '',
                        component: () => import('../views/admin/viviendas/index.vue'),
                        meta: { breadCrumb: 'Listado de Viviendas' }
                    },
                    {
                        name: 'viviendas.create',
                        path: 'create',
                        component: () => import('../views/admin/viviendas/create.vue'),
                        meta: { breadCrumb: 'Crear Vivienda' }
                    },
                    {
                        name: 'viviendas.edit',
                        path: 'edit/:id',
                        component: () => import('../views/admin/viviendas/edit.vue'),
                        meta: { breadCrumb: 'Editar Vivienda' }
                    }
                ]
            },
            {
                name: 'profile.index',
                path: 'profile',
                component: () => import('../views/admin/profile/index.vue'),
                meta: { breadCrumb: 'Profile' }
            },
            {
                name: 'permissions',
                path: 'permissions',
                meta: { breadCrumb: 'Permisos'},
                children: [
                    {
                        name: 'permissions.index',
                        path: '',
                        component: () => import('../views/admin/permissions/Index.vue'),
                        meta: { breadCrumb: 'Permissions' }
                    },
                    {
                        name: 'permissions.create',
                        path: 'create',
                        component: () => import('../views/admin/permissions/Create.vue'),
                        meta: {
                            breadCrumb: 'Create Permission',
                            linked: false,
                        }
                    },
                    {
                        name: 'permissions.edit',
                        path: 'edit/:id',
                        component: () => import('../views/admin/permissions/Edit.vue'),
                        meta: {
                            breadCrumb: 'Permission Edit',
                            linked: false,
                        }
                    }
                ]
            },
            {
                name: 'users',
                path: 'users',
                meta: { breadCrumb: 'Usuarios'},
                children: [
                    {
                        name: 'users.index',
                        path: '',
                        component: () => import('../views/admin/users/Index.vue'),
                        meta: { breadCrumb: 'Usuarios' }
                    },
                    {
                        name: 'users.create',
                        path: 'create',
                        component: () => import('../views/admin/users/Create.vue'),
                        meta: {
                            breadCrumb: 'Crear Usuario',
                            linked: false
                        }
                    },
                    {
                        name: 'users.edit',
                        path: 'edit/:id',
                        component: () => import('../views/admin/users/Edit.vue'),
                        meta: {
                            breadCrumb: 'Editar Usuario',
                            linked: false
                        }
                    }
                ]
            },
            //TODO Organizar rutas
            {
                name: 'roles.index',
                path: 'roles',
                component: () => import('../views/admin/roles/Index.vue'),
                meta: { breadCrumb: 'Roles' }
            },
            {
                name: 'roles.create',
                path: 'roles/create',
                component: () => import('../views/admin/roles/Create.vue'),
                meta: { breadCrumb: 'Create Role' }
            },
            {
                name: 'roles.edit',
                path: 'roles/edit/:id',
                component: () => import('../views/admin/roles/Edit.vue'),
                meta: { breadCrumb: 'Role Edit' }
            },

        ]
    },
    {
        path: "/:pathMatch(.*)*",
        name: 'NotFound',
        component: () => import("../views/errors/404.vue"),
    },
];
