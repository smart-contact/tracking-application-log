export default [
    { path: '/', redirect: '/logs' },

    {
        path: '/logs',
        name: 'logs-preview',
        component: require('./screens/logs/preview').default,
    },
];
