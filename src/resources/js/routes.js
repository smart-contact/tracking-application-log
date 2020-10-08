export default [
    { path: '/', redirect: '/logs' },

    {
        path: '/logs',
        name: 'logs-preview',
        component: require('./screens/logs/preview').default,
    },
    {
        path: '/:id/logs',
        name: 'logs-show',
        component: require('./screens/logs/show').default,
    },
    {
        path: '/export-log',
        name: 'export-logs',
        component: require('./screens/export/preview').default,
    },
];
