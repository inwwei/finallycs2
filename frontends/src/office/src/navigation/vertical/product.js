export default [
  {
    title: 'Page Home',
    route: 'home',
    icon: 'HomeIcon',
  },
  {
    title: 'Company registered',
    route: 'CompanyRegistered',
    icon: 'ClipboardIcon',

  },
  {
    title: 'Ministry of Commerce information',
    route: 'MinistryOfCommerceInformation',
    icon: 'FileTextIcon',

  },
  {
    title: 'Ranking',
    route: 'Ranking',
    icon: 'TrendingUpIcon',

  },
  {
    title: 'Price chart',
    route: 'Pricechart',
    icon: 'TrendingUpIcon',

  },
  {
    title: 'Tender Notice',
    route: 'TenderNotice',
    icon: 'ShoppingCartIcon',

  },

  {
    title: 'Manage shop',
    route: 'ManageShop',

    children: [
    //   {
    //     title: 'Menu',
    //     route: 'Menu',
    //     icon: 'FileTextIcon',
    //   },
      {
        title: 'Profiles',
        route: 'Profiles',
        icon: 'ShoppingBagIcon',
      },
    ],
  },
]
