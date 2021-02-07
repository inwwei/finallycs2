export default [
  {
    title: 'Page Home',
    route: 'home',
    icon: 'MapIcon',
  },
  {
    header: 'System',
  },
  {
    title: 'Customer System',
    icon: 'UserIcon',
    children: [
      {
        title: 'All Customer Data',
        route: 'customerIndex',
      },
      {
        title: 'Customer Report',
        route: null,
      },
    ],
  },
]
